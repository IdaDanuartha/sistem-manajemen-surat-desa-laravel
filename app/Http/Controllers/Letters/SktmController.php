<?php

namespace App\Http\Controllers\Letters;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Letter\Sktm\StoreSktmRequest;
use App\Http\Requests\Letter\Sktm\UpdateSktmRequest;
use App\Models\EnvironmentalHead;
use App\Models\Sk;
use App\Models\SktmLetter;
use App\Models\SubdistrictHead;
use App\Repositories\CitizentRepository;
use App\Repositories\Letters\SktmRepository;
use App\Utils\GenerateReferenceNumber;
use App\Utils\ResponseMessage;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;

class SktmController extends Controller
{
    public function __construct(
        protected readonly SktmRepository $sktm,
        protected readonly SktmLetter $letter,
        protected readonly CitizentRepository $citizent,
        protected readonly SubdistrictHead $subdistrictHead,
        protected readonly ResponseMessage $responseMessage
    ) {}

    public function index(Request $request)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);     
        if(auth()->user()->role === Role::VILLAGE_HEAD || auth()->user()->role === Role::SECTION_HEAD) {
            $letters = $this->sktm->findLetterBySectionHead();
        } else if(auth()->user()->role === Role::CITIZENT) {
            $letters = $this->sktm->findLetterByCitizent();
        } else if(auth()->user()->role === Role::ENVIRONMENTAL_HEAD) {
            $letters = $this->sktm->findLetterByStatus(0);
        } else {
            $letters = $this->sktm->findAll();
        }

        return view('dashboard.letters.sktm.index', compact('letters'));
    }

    public function create()
    { 
        // $reference_number = new GenerateReferenceNumber("416", 5, "Kppdk", "Ket", "Kel. Subagan");
        // $reference_number_2 = new GenerateReferenceNumber("416", 5, "Kppdk", "Ket", "Kel. Subagan");
        // $cover_letter_number = new GenerateReferenceNumber("", 1, "", "", "", auth()->user()->authenticatable->environmental->code ?? "---");

        if(auth()->user()->role === Role::ADMIN) abort(404);                                          
        return auth()->user()->role === Role::CITIZENT || auth()->user()->role === Role::SUPER_ADMIN ? 
               view('dashboard.letters.sktm.crud.create', [
                    "citizents" => $this->citizent->findAll(),
                    // "reference_number" => $reference_number->generate(),
                    // "cover_letter_number" => $cover_letter_number->generateCoverLetter()
               ]) : 
               abort(404);
    }

    public function show(SktmLetter $sktm)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);                                                   
        $get_letter = $this->sktm->findById($sktm);
        $environmentalHead = EnvironmentalHead::with("environmental")->whereRelation("environmental", "code", "=", $get_letter->sk->citizent->environmental->code)->first();
        return view('dashboard.letters.sktm.crud.detail', compact('get_letter', 'environmentalHead'));
    }

    public function edit(SktmLetter $sktm)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);  
        $get_letter = $this->sktm->findById($sktm);                                         
        return view('dashboard.letters.sktm.crud.edit', [
            "get_letter" => $get_letter,
            "citizents" => $this->citizent->findAll()
        ]);
    }

    public function store(StoreSktmRequest $request)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);            
        if(auth()->user()->role === Role::CITIZENT || auth()->user()->role === Role::SUPER_ADMIN) {
            try {            
                $store = $this->sktm->store($request->validated());            
    
                if($store instanceof Sk) return redirect(route("letters.sktm.index"))
                                    ->with("success", $this->responseMessage->response('Surat keterangan tidak mampu'));
    
                throw new Exception();
            } catch (\Exception $e) {  
                logger($e->getMessage());
    
                return redirect(route("letters.sktm.create"))->with("error", $this->responseMessage->response('surat keterangan tidak mampu', false));
            }
        } else {
            abort(404);
        }
    }

    public function update(UpdateSktmRequest $request, SktmLetter $sktm)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->sktm->update($request->validated(), $sktm);
            if($update == true) {
                return redirect(route('letters.sktm.index'))
                                ->with('success', $this->responseMessage->response('Surat keterangan tidak mampu', true, 'update'));
            }

            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sktm.edit', $sktm->id)->with('error', $this->responseMessage->response('surat keterangan tidak mampu', false, 'update'));
        }
    }

    public function approveLetter(Request $request, SktmLetter $sktm)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->sktm->confirmationLetter($sktm, true);

            if($update) return redirect(route('letters.sktm.show', $sktm->id))
                                ->with('success', "Surat berhasil disetujui");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sktm.show', $sktm->id)->with('error', "Surat gagal disetujui");
        }
    }

    public function rejectLetter(Request $request, SktmLetter $sktm)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->sktm->confirmationLetter($sktm, false, $request->reject_reason);

            if($update) return redirect(route('letters.sktm.show', $sktm->id))
                                ->with('success', "Surat berhasil ditolak");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sktm.show', $sktm->id)->with('error', "Surat gagal ditolak");
        }
    }

    public function preview(SktmLetter $sktm)
    {
        $sktm = $this->sktm->findById($sktm);
        $subdistrictHead = $this->subdistrictHead->find(1);

        if(auth()->user()->role === Role::ADMIN) abort(404);
        $generated = Pdf::loadView('dashboard.letters.sktm.letter-template', ['letter' => $sktm, "user" => auth()->user(), 'subdistrictHead' => $subdistrictHead]);        

        return $generated->stream("sktm-" . $sktm->sk->citizent->name . ".pdf");
    }
    
    public function download(SktmLetter $sktm, $type = "pdf")
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        $generated = Pdf::loadView('dashboard.letters.sktm.letter-template', ['letter' => $sktm]);        

        return $generated->download("sktm-" . $sktm->sk->citizent->name . ".$type");
    }

    public function destroy(SktmLetter $sktm)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {
            $delete = $this->sktm->delete($sktm);  

            if(!isset($delete["status"])) {
                return redirect()->route('letters.sktm.index')->with('success', $this->responseMessage->response('Surat keterangan tidak mampu', true, 'delete'));
            } else if(isset($delete["status"])) {
                return redirect()->route('letters.sktm.index')->with('error', $delete["message"]);
            }

            throw new Exception();
        } catch (\Exception $e) {            
            return redirect()->route('letters.sktm.index')->with('error', $this->responseMessage->response('surat keterangan tidak mampu', false, 'delete'));
        }
    }
}
