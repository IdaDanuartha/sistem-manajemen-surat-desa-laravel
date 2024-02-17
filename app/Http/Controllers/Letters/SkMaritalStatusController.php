<?php

namespace App\Http\Controllers\Letters;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Letter\SkMaritalStatus\StoreSkMaritalStatusRequest;
use App\Http\Requests\Letter\SkMaritalStatus\UpdateSkMaritalStatusRequest;
use App\Models\Sk;
use App\Models\SkMaritalStatusLetter;
use App\Repositories\Letters\SkMaritalStatusRepository;
use App\Repositories\UserRepository;
use App\Utils\GenerateReferenceNumber;
use App\Utils\ResponseMessage;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;

class SkMaritalStatusController extends Controller
{
    public function __construct(
        protected readonly SkMaritalStatusRepository $skMaritalStatus,
        protected readonly SkMaritalStatusLetter $letter,
        protected readonly UserRepository $user,
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
        } else if(auth()->user()->role === Role::ENVIRONMENTAL_HEAD) {
            $letters = $this->skMaritalStatus->findLetterByStatus(0);
        } else {
            $letters = $this->skMaritalStatus->findAll();
        }

        return view('dashboard.letters.sk-marital-status.index', compact('letters'));
    }

    public function create()
    { 
        $reference_number_1 = new GenerateReferenceNumber($this->letter->where("status", 3)->latest()->first(), "", 3); // cerai
        $reference_number_2 = new GenerateReferenceNumber($this->letter->where("status", "!=", 3)->latest()->first(), "", 4, "", "S.ket"); // janda or duda

        if(auth()->user()->role === Role::ADMIN) abort(404);                                          
        return auth()->user()->role === Role::CITIZENT || auth()->user()->role === Role::SUPER_ADMIN ? 
               view('dashboard.letters.sk-marital-status.crud.create', [
                "citizents" => $this->user->findAllCitizent(),
                "reference_number_1" => $reference_number_1->generate(),
                "reference_number_2" => $reference_number_2->generate(),
               ]) : 
               abort(404);
    }

    public function show(SkMaritalStatusLetter $sk_marital_status)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);                                                   
        $get_letter = $this->skMaritalStatus->findById($sk_marital_status);
        return view('dashboard.letters.sk-marital-status.crud.detail', compact('get_letter'));
    }

    public function edit(SkMaritalStatusLetter $sk_marital_status)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);  
        $get_letter = $this->skMaritalStatus->findById($sk_marital_status); 
        $citizents = $this->user->findAllCitizent();                                        
        return view('dashboard.letters.sk-marital-status.crud.edit', compact('get_letter', "citizents"));
    }

    public function store(StoreSkMaritalStatusRequest $request)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);            
        if(auth()->user()->role === Role::CITIZENT || auth()->user()->role === Role::SUPER_ADMIN) {
            try {            
                $store = $this->skMaritalStatus->store($request->validated());            
    
                if($store instanceof Sk) return redirect(route("letters.sk-marital-status.index"))
                                    ->with("success", $this->responseMessage->response('Surat keterangan status nikah'));
    
                throw new Exception;
            } catch (\Exception $e) {  
                logger($e->getMessage());
    
                return redirect(route("letters.sk-marital-status.create"))->with("error", $this->responseMessage->response('surat keterangan status nikah', false));
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
                return redirect(route('letters.sk-marital-status.index'))
                                ->with('success', $this->responseMessage->response('Surat keterangan status nikah', true, 'update'));
            }
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-marital-status.edit', $sk_marital_status->id)->with('error', $this->responseMessage->response('surat keterangan status nikah', false, 'update'));
        }
    }

    public function approveLetter(Request $request, SkMaritalStatusLetter $sk_marital_status)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skMaritalStatus->confirmationLetter($sk_marital_status, true);

            if($update) return redirect(route('letters.sk-marital-status.show', $sk_marital_status->id))
                                ->with('success', "Surat berhasil disetujui");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-marital-status.show', $sk_marital_status->id)->with('error', "Surat gagal disetujui");
        }
    }

    public function rejectLetter(Request $request, SkMaritalStatusLetter $sk_marital_status)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skMaritalStatus->confirmationLetter($sk_marital_status, false);

            if($update) return redirect(route('letters.sk-marital-status.show', $sk_marital_status->id))
                                ->with('success', "Surat berhasil ditolak");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-marital-status.show', $sk_marital_status->id)->with('error', "Surat gagal ditolak");
        }
    }

    public function preview(SkMaritalStatusLetter $sk_marital_status)
    {
        $sk_marital_status = $this->skMaritalStatus->findById($sk_marital_status);

        if(auth()->user()->role === Role::ADMIN) abort(404);
        $generated = Pdf::loadView('dashboard.letters.sk-marital-status.letter-template', ['letter' => $sk_marital_status, "user" => auth()->user()]);        

        if($sk_marital_status === 1) {
            $status = "duda";
        } else if($sk_marital_status === 2) {
            $status = "janda";
        } else {
            $status = "cerai";
        }
        return $generated->stream("surat-keterangan-" . $status . "-" . $sk_marital_status->sk->citizent->name . ".pdf");
    }
    
    public function download(SkMaritalStatusLetter $sk_marital_status, $type = "pdf")
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        $generated = Pdf::loadView('dashboard.letters.sk-marital-status.letter-template', ['letter' => $sk_marital_status]);        

        if($sk_marital_status === 1) {
            $status = "duda";
        } else if($sk_marital_status === 2) {
            $status = "janda";
        } else {
            $status = "cerai";
        }

        return $generated->download("surat-keterangan-" . $status . "-" . $sk_marital_status->sk->citizent->name . ".$type");
    }

    public function destroy(SkMaritalStatusLetter $sk_marital_status)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {
            $delete = $this->skMaritalStatus->delete($sk_marital_status);  

            if(!isset($delete["status"])) {
                return redirect()->route('letters.sk-marital-status.index')->with('success', $this->responseMessage->response('Surat keterangan status nikah', true, 'delete'));
            } else if(isset($delete["status"])) {
                return redirect()->route('letters.sk-marital-status.index')->with('error', $delete["message"]);
            }

            throw new Exception;
        } catch (\Exception $e) {            
            return redirect()->route('letters.sk-marital-status.index')->with('error', $this->responseMessage->response('surat keterangan status nikah', false, 'delete'));
        }
    }
}
