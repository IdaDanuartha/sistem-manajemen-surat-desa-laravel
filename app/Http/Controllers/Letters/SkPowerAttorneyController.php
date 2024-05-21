<?php

namespace App\Http\Controllers\Letters;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Letter\SkPowerAttorney\StoreSkPowerAttorneyRequest;
use App\Http\Requests\Letter\SkPowerAttorney\UpdateSkPowerAttorneyRequest;
use App\Models\Sk;
use App\Models\SkPowerAttorney;
use App\Models\SubdistrictHead;
use App\Repositories\CitizentRepository;
use App\Repositories\Letters\SkPowerAttorneyRepository;
use App\Repositories\UserRepository;
use App\Utils\GenerateReferenceNumber;
use App\Utils\ResponseMessage;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;

class SkPowerAttorneyController extends Controller
{
    public function __construct(
        protected readonly SkPowerAttorneyRepository $skPowerAttorney,
        protected readonly SkPowerAttorney $letter,
        protected readonly CitizentRepository $citizent,
        protected readonly SubdistrictHead $subdistrictHead,
        protected readonly ResponseMessage $responseMessage
    ) {}

    public function index(Request $request)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);     
        if(auth()->user()->role === Role::VILLAGE_HEAD) {
            $letters = $this->skPowerAttorney->findLetterByVillageHead();
        } else if(auth()->user()->role === Role::SECTION_HEAD) {
            $letters = $this->skPowerAttorney->findLetterBySectionHead();
        } else if(auth()->user()->role === Role::CITIZENT) {
            $letters = $this->skPowerAttorney->findLetterByCitizent();
        } else if(auth()->user()->role === Role::ENVIRONMENTAL_HEAD) {
            $letters = $this->skPowerAttorney->findLetterByStatus(0);
        } else {
            $letters = $this->skPowerAttorney->findAll();
        }

        return view('dashboard.letters.sk-power-attorney.index', compact('letters'));
    }

    public function create()
    { 
        $reference_number = new GenerateReferenceNumber("", 8, "Kpddk", "S.Ket");
        $cover_letter_number = new GenerateReferenceNumber("", 1, "", "", "", auth()->user()->authenticatable->environmental->code ?? "---");

        if(auth()->user()->role === Role::ADMIN) abort(404);                                          
        return auth()->user()->role === Role::CITIZENT || auth()->user()->role === Role::SUPER_ADMIN ? 
               view('dashboard.letters.sk-power-attorney.crud.create', [
                    "citizents" => $this->citizent->findAll(),
                    "reference_number" => $reference_number->generate(),
                    "cover_letter_number" => $cover_letter_number->generateCoverLetter(),
               ]) : 
               abort(404);
    }

    public function show(SkPowerAttorney $skPowerAttorney)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);                                                   
        $get_letter = $this->skPowerAttorney->findById($skPowerAttorney);
        return view('dashboard.letters.sk-power-attorney.crud.detail', compact('get_letter'));
    }

    public function edit(SkPowerAttorney $skPowerAttorney)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);  
        $get_letter = $this->skPowerAttorney->findById($skPowerAttorney);                                         
        return view('dashboard.letters.sk-power-attorney.crud.edit', [
            "get_letter" => $get_letter,
            "citizents" => $this->citizent->findAll()
        ]);
    }

    public function store(StoreSkPowerAttorneyRequest $request)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);            
        if(auth()->user()->role === Role::CITIZENT || auth()->user()->role === Role::SUPER_ADMIN) {
            try {            
                $store = $this->skPowerAttorney->store($request->validated());            
    
                if($store instanceof Sk) return redirect(route("letters.sk-power-attorney.index"))
                                    ->with("success", $this->responseMessage->response('Surat keterangan ahli waris'));
    
                throw new Exception();
            } catch (\Exception $e) {  
                logger($e->getMessage());
    
                return redirect(route("letters.sk-power-attorney.create"))->with("error", $this->responseMessage->response('surat keterangan ahli waris', false));
            }
        } else {
            abort(404);
        }
    }

    public function update(UpdateSkPowerAttorneyRequest $request, SkPowerAttorney $skPowerAttorney)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skPowerAttorney->update($request->validated(), $skPowerAttorney);
            if($update == true) {
                return redirect(route('letters.sk-power-attorney.index'))
                                ->with('success', $this->responseMessage->response('Surat keterangan ahli waris', true, 'update'));
            }

            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-power-attorney.edit', $skPowerAttorney->id)->with('error', $this->responseMessage->response('surat keterangan ahli waris', false, 'update'));
        }
    }

    public function approveLetter(Request $request, SkPowerAttorney $skPowerAttorney)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skPowerAttorney->confirmationLetter($skPowerAttorney, true);

            if($update) return redirect(route('letters.sk-power-attorney.show', $skPowerAttorney->id))
                                ->with('success', "Surat berhasil disetujui");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-power-attorney.show', $skPowerAttorney->id)->with('error', "Surat gagal disetujui");
        }
    }

    public function rejectLetter(Request $request, SkPowerAttorney $skPowerAttorney)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skPowerAttorney->confirmationLetter($skPowerAttorney, false, $request->reject_reason);

            if($update) return redirect(route('letters.sk-power-attorney.show', $skPowerAttorney->id))
                                ->with('success', "Surat berhasil ditolak");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-power-attorney.show', $skPowerAttorney->id)->with('error', "Surat gagal ditolak");
        }
    }

    public function preview(SkPowerAttorney $skPowerAttorney)
    {
        $skPowerAttorney = $this->skPowerAttorney->findById($skPowerAttorney);
        $subdistrictHead = $this->subdistrictHead->find(1);

        if(auth()->user()->role === Role::ADMIN) abort(404);
        $generated = Pdf::loadView('dashboard.letters.sk-power-attorney.letter-template', 
        [
            'letter' => $skPowerAttorney, 
            "user" => auth()->user(), 
            'subdistrictHead' => $subdistrictHead
        ]);        

        return $generated->stream("sk-ahli-waris-" . $skPowerAttorney->sk->citizent->name . ".pdf");
    }
    
    public function download(SkPowerAttorney $skPowerAttorney, $type = "pdf")
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);

        $subdistrictHead = $this->subdistrictHead->find(1);
        $generated = Pdf::loadView('dashboard.letters.sk-power-attorney.letter-template', [
            'letter' => $skPowerAttorney, 
            "user" => auth()->user(), 
            'subdistrictHead' => $subdistrictHead
        ]);        

        return $generated->download("sk-ahli-waris-" . $skPowerAttorney->sk->citizent->name . ".$type");
    }

    public function destroy(SkPowerAttorney $skPowerAttorney)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {
            $delete = $this->skPowerAttorney->delete($skPowerAttorney);  

            if(!isset($delete["status"])) {
                return redirect()->route('letters.sk-power-attorney.index')->with('success', $this->responseMessage->response('Surat keterangan ahli waris', true, 'delete'));
            } else if(isset($delete["status"])) {
                return redirect()->route('letters.sk-power-attorney.index')->with('error', $delete["message"]);
            }

            throw new Exception();
        } catch (\Exception $e) {            
            return redirect()->route('letters.sk-power-attorney.index')->with('error', $this->responseMessage->response('surat keterangan ahli waris', false, 'delete'));
        }
    }
}
