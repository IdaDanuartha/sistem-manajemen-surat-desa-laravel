<?php

namespace App\Http\Controllers\Letters;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Letter\SkBirth\StoreSkBirthRequest;
use App\Http\Requests\Letter\SkBirth\UpdateSkBirthRequest;
use App\Models\EnvironmentalHead;
use App\Models\Sk;
use App\Models\SkBirthLetter;
use App\Repositories\CitizentRepository;
use App\Repositories\Letters\SkBirthRepository;
use App\Utils\GenerateReferenceNumber;
use App\Utils\ResponseMessage;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;

class SkBirthController extends Controller
{
    public function __construct(
        protected readonly SkBirthRepository $skBirth,
        protected readonly CitizentRepository $citizent,
        protected readonly ResponseMessage $responseMessage,
    ) {}

    public function index(Request $request)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);     
        if(auth()->user()->role === Role::VILLAGE_HEAD || auth()->user()->role === Role::SECTION_HEAD) {
            $letters = $this->skBirth->findLetterBySectionHead();
        } else if(auth()->user()->role === Role::CITIZENT) {
            $letters = $this->skBirth->findLetterByCitizent();
        } else if(auth()->user()->role === Role::ENVIRONMENTAL_HEAD) {
            $letters = $this->skBirth->findLetterByStatus(0);
        } else {
            $letters = $this->skBirth->findAll();
        }

        return view('dashboard.letters.sk-birth.index', compact('letters'));
    }

    public function create()
    { 
        $reference_number = new GenerateReferenceNumber();
        $cover_letter_number = new GenerateReferenceNumber("", 1, "", "", "", auth()->user()->authenticatable->environmental->code ?? "---");

        if(auth()->user()->role === Role::ADMIN) abort(404);                                          
        return auth()->user()->role === Role::CITIZENT || auth()->user()->role === Role::SUPER_ADMIN ? 
               view('dashboard.letters.sk-birth.crud.create', [
                    "citizents" => $this->citizent->findAll(),
                    "reference_number" => $reference_number->generate(),
                    "cover_letter_number" => $cover_letter_number->generateCoverLetter(),
               ]) : 
               abort(404);
    }

    public function show(SkBirthLetter $sk_birth)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);                                                   
        $get_letter = $this->skBirth->findById($sk_birth);
        $environmentalHead = EnvironmentalHead::with("environmental")->whereRelation("environmental", "code", "=", $get_letter->sk->citizent->environmental->code)->first();
        return view('dashboard.letters.sk-birth.crud.detail', compact('get_letter', 'environmentalHead'));
    }

    public function edit(SkBirthLetter $sk_birth)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);  
        $get_letter = $this->skBirth->findById($sk_birth);                                         
        return view('dashboard.letters.sk-birth.crud.edit', [
            "get_letter" => $get_letter,
            "citizents" => $this->citizent->findAll()
        ]);
    }

    public function store(StoreSkBirthRequest $request)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);            
        if(auth()->user()->role === Role::CITIZENT || auth()->user()->role === Role::SUPER_ADMIN) {
            try {            
                $store = $this->skBirth->store($request->validated());            
    
                if($store instanceof Sk) return redirect(route("letters.sk-birth.index"))
                                    ->with("success", $this->responseMessage->response('Surat keterangan lahir'));
    
                throw new Exception;
            } catch (\Exception $e) {  
                logger($e->getMessage());
    
                return redirect(route("letters.sk-birth.create"))->with("error", $this->responseMessage->response('surat keterangan lahir', false));
            }
        } else {
            abort(404);
        }
    }

    public function update(UpdateSkBirthRequest $request, SkBirthLetter $sk_birth)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {   
            $update = $this->skBirth->update($request->validated(), $sk_birth);
            if($update == true) {
                return redirect(route('letters.sk-birth.index'))
                                ->with('success', $this->responseMessage->response('Surat keterangan lahir', true, 'update'));
            }
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-birth.edit', $sk_birth->id)->with('error', $this->responseMessage->response('surat keterangan lahir', false, 'update'));
        }
    }

    public function approveLetter(Request $request, SkBirthLetter $sk_birth)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skBirth->confirmationLetter($sk_birth, true);

            if($update) return redirect(route('letters.sk-birth.show', $sk_birth->id))
                                ->with('success', "Surat berhasil disetujui");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-birth.show', $sk_birth->id)->with('error', "Surat gagal disetujui");
        }
    }

    public function rejectLetter(Request $request, SkBirthLetter $sk_birth)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skBirth->confirmationLetter($sk_birth, false, $request->reject_reason);

            if($update) return redirect(route('letters.sk-birth.show', $sk_birth->id))
                                ->with('success', "Surat berhasil ditolak");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-birth.show', $sk_birth->id)->with('error', "Surat gagal ditolak");
        }
    }

    public function preview(SkBirthLetter $sk_birth)
    {
        $sk_birth = $this->skBirth->findById($sk_birth);

        if(auth()->user()->role === Role::ADMIN) abort(404);
        $generated = Pdf::loadView('dashboard.letters.sk-birth.letter-template', ['letter' => $sk_birth, "user" => auth()->user()]);        

        return $generated->stream("surat-keterangan-lahir- " . $sk_birth->sk->citizent->name . ".pdf");
    }
    
    public function download(SkBirthLetter $sk_birth, $type = "pdf")
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        $generated = Pdf::loadView('dashboard.letters.sk-birth.letter-template', ['letter' => $sk_birth]);        

        return $generated->download("surat-keterangan-lahir- " . $sk_birth->sk->citizent->name . ".$type");
    }

    public function destroy(SkBirthLetter $sk_birth)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {
            $delete = $this->skBirth->delete($sk_birth);  

            if(!isset($delete["status"])) {
                return redirect()->route('letters.sk-birth.index')->with('success', $this->responseMessage->response('Surat keterangan lahir', true, 'delete'));
            } else if(isset($delete["status"])) {
                return redirect()->route('letters.sk-birth.index')->with('error', $delete["message"]);
            }

            throw new Exception;
        } catch (\Exception $e) {            
            return redirect()->route('letters.sk-birth.index')->with('error', $this->responseMessage->response('surat keterangan lahir', false, 'delete'));
        }
    }
}
