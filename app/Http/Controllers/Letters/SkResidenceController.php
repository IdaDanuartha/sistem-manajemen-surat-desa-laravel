<?php

namespace App\Http\Controllers\Letters;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Letter\SkResidence\StoreSkResidenceRequest;
use App\Http\Requests\Letter\SkResidence\UpdateSkResidenceRequest;
use App\Models\EnvironmentalHead;
use App\Models\Sk;
use App\Models\SkResidenceLetter;
use App\Repositories\CitizentRepository;
use App\Repositories\Letters\SkResidenceRepository;
use App\Utils\GenerateReferenceNumber;
use App\Utils\ResponseMessage;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;

class SkResidenceController extends Controller
{
    public function __construct(
        protected readonly SkResidenceRepository $skResidence,
        protected readonly CitizentRepository $citizent,
        protected readonly ResponseMessage $responseMessage
    ) {}

    public function index(Request $request)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);     
        if(auth()->user()->role === Role::VILLAGE_HEAD || auth()->user()->role === Role::SECTION_HEAD) {
            $letters = $this->skResidence->findLetterBySectionHead();
        } else if(auth()->user()->role === Role::CITIZENT) {
            $letters = $this->skResidence->findLetterByCitizent();
        } else if(auth()->user()->role === Role::ENVIRONMENTAL_HEAD) {
            $letters = $this->skResidence->findLetterByStatus(0);
        } else {
            $letters = $this->skResidence->findAll();
        }

        return view('dashboard.letters.sk-residence.index', compact('letters'));
    }

    public function create()
    { 
        $reference_number = new GenerateReferenceNumber("", 9);
        $cover_letter_number = new GenerateReferenceNumber("", 1, "", "", "", auth()->user()->authenticatable->environmental->code ?? "---");

        if(auth()->user()->role === Role::ADMIN) abort(404);                                          
        return auth()->user()->role === Role::CITIZENT || auth()->user()->role === Role::SUPER_ADMIN ? 
               view('dashboard.letters.sk-residence.crud.create', [
                    "citizents" => $this->citizent->findAll(),
                    "reference_number" => $reference_number->generate(),
                    "cover_letter_number" => $cover_letter_number->generateCoverLetter(),
               ]) : 
               abort(404);
    }

    public function show(SkResidenceLetter $skResidence)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);                                                   
        $get_letter = $this->skResidence->findById($skResidence);
        $environmentalHead = EnvironmentalHead::with("environmental")->whereRelation("environmental", "code", "=", $get_letter->sk->citizent->environmental->code)->first();
        return view('dashboard.letters.sk-residence.crud.detail', compact('get_letter', 'environmentalHead'));
    }

    public function edit(SkResidenceLetter $skResidence)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);  
        $get_letter = $this->skResidence->findById($skResidence);                                         
        return view('dashboard.letters.sk-residence.crud.edit', [
            "get_letter" => $get_letter,
            "citizents" => $this->citizent->findAll()
        ]);
    }

    public function store(StoreSkResidenceRequest $request)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);            
        if(auth()->user()->role === Role::CITIZENT || auth()->user()->role === Role::SUPER_ADMIN) {
            try {            
                $store = $this->skResidence->store($request->validated());            
    
                if($store instanceof Sk) return redirect(route("letters.sk-residence.index"))
                                    ->with("success", $this->responseMessage->response('Surat keterangan tempat tinggal'));
    
                throw new Exception();
            } catch (\Exception $e) {  
                logger($e->getMessage());
    
                return redirect(route("letters.sk-residence.create"))->with("error", $this->responseMessage->response('surat keterangan tempat tinggal', false));
            }
        } else {
            abort(404);
        }
    }

    public function update(UpdateSkResidenceRequest $request, SkResidenceLetter $skResidence)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skResidence->update($request->validated(), $skResidence);
            if($update == true) {
                return redirect(route('letters.sk-residence.index'))
                                ->with('success', $this->responseMessage->response('Surat keterangan tempat tinggal', true, 'update'));
            }

            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-residence.edit', $skResidence->id)->with('error', $this->responseMessage->response('surat keterangan tempat tinggal', false, 'update'));
        }
    }

    public function approveLetter(Request $request, SkResidenceLetter $skResidence)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skResidence->confirmationLetter($skResidence, true);

            if($update) return redirect(route('letters.sk-residence.show', $skResidence->id))
                                ->with('success', "Surat berhasil disetujui");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-residence.show', $skResidence->id)->with('error', "Surat gagal disetujui");
        }
    }

    public function rejectLetter(Request $request, SkResidenceLetter $skResidence)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skResidence->confirmationLetter($skResidence, false, $request->reject_reason);

            if($update) return redirect(route('letters.sk-residence.show', $skResidence->id))
                                ->with('success', "Surat berhasil ditolak");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-residence.show', $skResidence->id)->with('error', "Surat gagal ditolak");
        }
    }

    public function preview(SkResidenceLetter $skResidence)
    {
        $skResidence = $this->skResidence->findById($skResidence);

        if(auth()->user()->role === Role::ADMIN) abort(404);
        $generated = Pdf::loadView('dashboard.letters.sk-residence.letter-template', ['letter' => $skResidence, "user" => auth()->user()]);        

        return $generated->stream("sk-tempat-tinggal-" . $skResidence->sk->citizent->name . ".pdf");
    }
    
    public function download(SkResidenceLetter $skResidence, $type = "pdf")
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        $generated = Pdf::loadView('dashboard.letters.sk-residence.letter-template', ['letter' => $skResidence]);        

        return $generated->download("sk-tempat-tinggal-" . $skResidence->sk->citizent->name . ".$type");
    }

    public function destroy(SkResidenceLetter $skResidence)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {
            $delete = $this->skResidence->delete($skResidence);  

            if(!isset($delete["status"])) {
                return redirect()->route('letters.sk-residence.index')->with('success', $this->responseMessage->response('Surat keterangan tempat tinggal', true, 'delete'));
            } else if(isset($delete["status"])) {
                return redirect()->route('letters.sk-residence.index')->with('error', $delete["message"]);
            }

            throw new Exception();
        } catch (\Exception $e) {            
            return redirect()->route('letters.sk-residence.index')->with('error', $this->responseMessage->response('surat keterangan tempat tinggal', false, 'delete'));
        }
    }
}
