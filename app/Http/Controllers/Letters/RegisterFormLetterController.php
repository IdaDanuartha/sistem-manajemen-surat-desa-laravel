<?php

namespace App\Http\Controllers\Letters;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Letter\RegistrationForm\StoreRegistrationFormRequest;
use App\Http\Requests\Letter\RegistrationForm\UpdateRegistrationFormRequest;
use App\Models\RegistrationFormLetter;
use App\Models\Sk;
use App\Repositories\CitizentRepository;
use App\Repositories\Letters\RegistrationFormRepository;
use App\Repositories\UserRepository;
use App\Utils\ResponseMessage;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;

class RegisterFormLetterController extends Controller
{
    public function __construct(
        protected readonly RegistrationFormRepository $registrationForm,
        protected readonly CitizentRepository $citizent,
        protected readonly ResponseMessage $responseMessage
    ) {}

    public function index(Request $request)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);     
        if(auth()->user()->role === Role::VILLAGE_HEAD) {
            $letters = $this->registrationForm->findLetterByVillageHead();
        } else if(auth()->user()->role === Role::SECTION_HEAD) {
            $letters = $this->registrationForm->findLetterBySectionHead();
        } else if(auth()->user()->role === Role::CITIZENT) {
            $letters = $this->registrationForm->findLetterByCitizent();
        } else if(auth()->user()->role === Role::ENVIRONMENTAL_HEAD) {
            $letters = $this->registrationForm->findLetterByStatus(0);
        } else {
            $letters = $this->registrationForm->findAll();
        }

        return view('dashboard.letters.registration-form.index', compact('letters'));
    }

    public function create()
    { 
        if(auth()->user()->role === Role::ADMIN) abort(404);                                          
        return auth()->user()->role === Role::CITIZENT || auth()->user()->role === Role::SUPER_ADMIN ? 
               view('dashboard.letters.registration-form.crud.create', [
                "citizents" => $this->citizent->findAll()
               ]) : 
               abort(404);
    }

    public function show(RegistrationFormLetter $registrationForm)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);                                                   
        $get_letter = $this->registrationForm->findById($registrationForm);
        return view('dashboard.letters.registration-form.crud.detail', compact('get_letter'));
    }

    public function edit(RegistrationFormLetter $registrationForm)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);  
        $get_letter = $this->registrationForm->findById($registrationForm);                                         
        return view('dashboard.letters.registration-form.crud.edit', [
            "get_letter" => $get_letter,
            "citizents" => $this->citizent->findAll()
        ]);
    }

    public function store(StoreRegistrationFormRequest $request)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);            
        if(auth()->user()->role === Role::CITIZENT || auth()->user()->role === Role::SUPER_ADMIN) {
            try {            
                $store = $this->registrationForm->store($request->validated());            
    
                if($store instanceof Sk) return redirect(route("letters.registration-form.index"))
                                    ->with("success", $this->responseMessage->response('Surat pendaftaran atau pembatalan penduduk nonpermanen'));
    
                throw new Exception("");
            } catch (\Exception $e) {  
                logger($e->getMessage());
    
                return redirect(route("letters.registration-form.create"))->with("error", $this->responseMessage->response('surat pendaftaran atau pembatalan penduduk nonpermanen', false));
            }
        } else {
            abort(404);
        }
    }

    public function update(UpdateRegistrationFormRequest $request, RegistrationFormLetter $registrationForm)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->registrationForm->update($request->validated(), $registrationForm);
            if($update == true) {
                return redirect(route('letters.registration-form.index'))
                                ->with('success', $this->responseMessage->response('Surat pendaftaran atau pembatalan penduduk nonpermanen', true, 'update'));
            }
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.registration-form.edit', $registrationForm->id)->with('error', $this->responseMessage->response('surat pendaftaran atau pembatalan penduduk nonpermanen', false, 'update'));
        }
    }

    public function approveLetter(Request $request, RegistrationFormLetter $registrationForm)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->registrationForm->confirmationLetter($registrationForm, true);

            if($update) return redirect(route('letters.registration-form.show', $registrationForm->id))
                                ->with('success', "Surat berhasil disetujui");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.registration-form.show', $registrationForm->id)->with('error', "Surat gagal disetujui");
        }
    }

    public function rejectLetter(Request $request, RegistrationFormLetter $registrationForm)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->registrationForm->confirmationLetter($registrationForm, false, $request->reject_reason);

            if($update) return redirect(route('letters.registration-form.show', $registrationForm->id))
                                ->with('success', "Surat berhasil ditolak");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.registration-form.show', $registrationForm->id)->with('error', "Surat gagal ditolak");
        }
    }

    public function preview(RegistrationFormLetter $registrationForm)
    {
        $registrationForm = $this->registrationForm->findById($registrationForm);

        if(auth()->user()->role === Role::ADMIN) abort(404);
        $generated = Pdf::loadView('dashboard.letters.registration-form.letter-template', ['letter' => $registrationForm, "user" => auth()->user()]);        

        return $generated->stream("surat-pendaftaran-atau-pembatalan-penduduk-nonpermanen-" . $registrationForm->sk->citizent->name . ".pdf");
    }
    
    public function download(RegistrationFormLetter $registrationForm, $type = "pdf")
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        $generated = Pdf::loadView('dashboard.letters.registration-form.letter-template', ['letter' => $registrationForm]);        

        return $generated->download("surat-pendaftaran-atau-pembatalan-penduduk-nonpermanen-" . $registrationForm->sk->citizent->name . ".$type");
    }

    public function destroy(RegistrationFormLetter $registrationForm)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {
            $delete = $this->registrationForm->delete($registrationForm);  

            if(!isset($delete["status"])) {
                return redirect()->route('letters.registration-form.index')->with('success', $this->responseMessage->response('Surat pendaftaran atau pembatalan penduduk nonpermanen', true, 'delete'));
            } else if(isset($delete["status"])) {
                return redirect()->route('letters.registration-form.index')->with('error', $delete["message"]);
            }

            throw new Exception;
        } catch (\Exception $e) {            
            return redirect()->route('letters.registration-form.index')->with('error', $this->responseMessage->response('surat pendaftaran atau pembatalan penduduk nonpermanen', false, 'delete'));
        }
    }
}
