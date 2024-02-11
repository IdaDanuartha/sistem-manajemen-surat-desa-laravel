<?php

namespace App\Http\Controllers\Letters;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Letter\MaritalStatus\StoreSkMaritalStatusRequest;
use App\Http\Requests\Letter\MaritalStatus\UpdateSkMaritalStatusRequest;
use App\Models\Sk;
use App\Models\SkMaritalStatusLetter;
use App\Repositories\Letters\SkMaritalStatusRepository;
use App\Utils\ResponseMessage;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;

class SkMaritalStatusController extends Controller
{
    public function __construct(
        protected readonly SkMaritalStatusRepository $skMaritalStatus,
        protected readonly ResponseMessage $responseMessage
    ) {}

    public function index(Request $request)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);     
        if(auth()->user()->role === Role::VILLAGE_HEAD) {
            $letters = $this->skMaritalStatus->findLetterByVillageHead();
        } else if(auth()->user()->role === Role::SECTION_HEAD) {
            $letters = $this->skMaritalStatus->findLetterBySectionHead();
        } else if(auth()->user()->role === Role::CITIZENT) {
            $letters = $this->skMaritalStatus->findLetterByCitizent();
        } else {
            $letters = $this->skMaritalStatus->findLetterByStatus(0);
        }
        return view('dashboard.letters.sk-birth.index', compact('letters'));
    }

    public function create()
    { 
        if(auth()->user()->role === Role::ADMIN) abort(404);                                          
        return auth()->user()->role === Role::CITIZENT ? 
               view('dashboard.letters.sk-birth.crud.create') : 
               abort(404);
    }

    public function show(SkMaritalStatusLetter $sk_marital_status)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);                                                   
        $get_letter = $this->skMaritalStatus->findById($sk_marital_status);
        return view('dashboard.letters.sk-birth.crud.detail', compact('get_letter'));
    }

    public function edit(SkMaritalStatusLetter $sk_marital_status)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);  
        $get_letter = $this->skMaritalStatus->findById($sk_marital_status);                                         
        return view('dashboard.letters.sk-birth.crud.edit', compact('get_letter'));
    }

    public function store(StoreSkMaritalStatusRequest $request)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);            
        if(auth()->user()->role === Role::CITIZENT) {
            try {            
                $store = $this->skMaritalStatus->store($request->validated());            
    
                if($store instanceof Sk) return redirect(route("letters.sk-birth.index"))
                                    ->with("success", $this->responseMessage->response('Surat keterangan status nikah'));
    
                throw new Exception;
            } catch (\Exception $e) {  
                logger($e->getMessage());
    
                return redirect(route("letters.sk-birth.create"))->with("error", $this->responseMessage->response('surat keterangan status nikah', false));
            }
        } else {
            abort(404);
        }
    }

    public function update(UpdateSkMaritalStatusRequest $request, SkMaritalStatusLetter $sk_marital_status)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skMaritalStatus->update($request->validated(), $sk_marital_status);
            if($update == true) {
                return redirect(route('letters.sk-birth.index'))
                                ->with('success', $this->responseMessage->response('Surat keterangan status nikah', true, 'update'));
            }
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-birth.edit', $sk_marital_status->id)->with('error', $this->responseMessage->response('surat keterangan status nikah', false, 'update'));
        }
    }

    public function approveLetter(Request $request, SkMaritalStatusLetter $sk_marital_status)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skMaritalStatus->confirmationLetter($sk_marital_status, true);

            if($update) return redirect(route('letters.sk-birth.show', $sk_marital_status->id))
                                ->with('success', "Surat berhasil disetujui");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-birth.show', $sk_marital_status->id)->with('error', "Surat gagal disetujui");
        }
    }

    public function rejectLetter(Request $request, SkMaritalStatusLetter $sk_marital_status)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skMaritalStatus->confirmationLetter($sk_marital_status, false);

            if($update) return redirect(route('letters.sk-birth.show', $sk_marital_status->id))
                                ->with('success', "Surat berhasil ditolak");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-birth.show', $sk_marital_status->id)->with('error', "Surat gagal ditolak");
        }
    }

    public function preview(SkMaritalStatusLetter $sk_marital_status)
    {
        $sk_marital_status = $this->skMaritalStatus->findById($sk_marital_status);

        if(auth()->user()->role === Role::ADMIN) abort(404);
        $generated = Pdf::loadView('dashboard.letters.sk-birth.letter-template', ['letter' => $sk_marital_status, "user" => auth()->user()]);        

        return $generated->stream("SK Lahir " . $sk_marital_status->sk->citizent->name . ".pdf");
    }
    
    public function download(SkMaritalStatusLetter $sk_marital_status, $type = "pdf")
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        $generated = Pdf::loadView('dashboard.letters.sk-birth.letter-template', ['letter' => $sk_marital_status]);        

        return $generated->download("SK Lahir " . $sk_marital_status->sk->citizent->name . ".$type");
    }

    public function destroy(SkMaritalStatusLetter $sk_marital_status)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {
            $delete = $this->skMaritalStatus->delete($sk_marital_status);  

            if(!isset($delete["status"])) {
                return redirect()->route('letters.sk-birth.index')->with('success', $this->responseMessage->response('Surat keterangan status nikah', true, 'delete'));
            } else if(isset($delete["status"])) {
                return redirect()->route('letters.sk-birth.index')->with('error', $delete["message"]);
            }

            throw new Exception;
        } catch (\Exception $e) {            
            return redirect()->route('letters.sk-birth.index')->with('error', $this->responseMessage->response('surat keterangan status nikah', false, 'delete'));
        }
    }
}
