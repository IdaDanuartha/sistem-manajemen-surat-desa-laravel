<?php

namespace App\Http\Controllers\Letters;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Letter\SkTraveling\StoreSkTravelingRequest;
use App\Http\Requests\Letter\SkTraveling\UpdateSkTravelingRequest;
use App\Models\EnvironmentalHead;
use App\Models\Sk;
use App\Models\SkTravelingLetter;
use App\Models\VillageHead;
use App\Repositories\CitizentRepository;
use App\Repositories\Letters\SkTravelingRepository;
use App\Repositories\UserRepository;
use App\Utils\GenerateReferenceNumber;
use App\Utils\ResponseMessage;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;

class SkTravellingController extends Controller
{
    public function __construct(
        protected readonly SkTravelingRepository $skTravelling,
        protected readonly SkTravelingLetter $letter,
        protected readonly VillageHead $villageHead,
        protected readonly CitizentRepository $citizent,
        protected readonly ResponseMessage $responseMessage
    ) {}

    public function index(Request $request)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);     
        if(auth()->user()->role === Role::VILLAGE_HEAD) {
            $letters = $this->skTravelling->findLetterByVillageHead();
        } else if(auth()->user()->role === Role::SECTION_HEAD) {
            $letters = $this->skTravelling->findLetterBySectionHead();
        } else if(auth()->user()->role === Role::CITIZENT) {
            $letters = $this->skTravelling->findLetterByCitizent();
        } else if(auth()->user()->role === Role::ENVIRONMENTAL_HEAD) {
            $letters = $this->skTravelling->findLetterByStatus(0);
        } else {
            $letters = $this->skTravelling->findAll();
        }

        return view('dashboard.letters.sk-traveling.index', compact('letters'));
    }

    public function create()
    { 
        $reference_number = new GenerateReferenceNumber("", 8);
        $cover_letter_number = new GenerateReferenceNumber("", 1, "", "", "", auth()->user()->authenticatable->environmental->code ?? "---");

        if(auth()->user()->role === Role::ADMIN) abort(404);                                          
        return auth()->user()->role === Role::CITIZENT || auth()->user()->role === Role::SUPER_ADMIN ? 
               view('dashboard.letters.sk-traveling.crud.create', [
                    "citizents" => $this->citizent->findAll(),
                    "reference_number" => $reference_number->generate(),
                    "cover_letter_number" => $cover_letter_number->generateCoverLetter(),
               ]) : 
               abort(404);
    }

    public function show(SkTravelingLetter $sk_travelling)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);                                                   
        $get_letter = $this->skTravelling->findById($sk_travelling);
        $environmentalHead = EnvironmentalHead::with("environmental")->whereRelation("environmental", "code", "=", $get_letter->sk->citizent->environmental->code)->first();
        return view('dashboard.letters.sk-traveling.crud.detail', compact('get_letter', 'environmentalHead'));
    }

    public function edit(SkTravelingLetter $sk_travelling)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);  
        $get_letter = $this->skTravelling->findById($sk_travelling);                                         
        return view('dashboard.letters.sk-traveling.crud.edit', [
            "get_letter" => $get_letter,
            "citizents" => $this->citizent->findAll()
        ]);
    }

    public function store(StoreSkTravelingRequest $request)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);            
        if(auth()->user()->role === Role::CITIZENT || auth()->user()->role === Role::SUPER_ADMIN) {
            try {            
                $store = $this->skTravelling->store($request->validated());            
    
                if($store instanceof Sk) return redirect(route("letters.sk-travelling.index"))
                                    ->with("success", $this->responseMessage->response('Surat keterangan bepergian'));
    
                throw new Exception();
            } catch (\Exception $e) {  
                logger($e->getMessage());
    
                return redirect(route("letters.sk-travelling.create"))->with("error", $this->responseMessage->response('surat keterangan bepergian', false));
            }
        } else {
            abort(404);
        }
    }

    public function update(UpdateSkTravelingRequest $request, SkTravelingLetter $sk_travelling)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skTravelling->update($request->validated(), $sk_travelling);
            if($update == true) {
                return redirect(route('letters.sk-travelling.index'))
                                ->with('success', $this->responseMessage->response('Surat keterangan bepergian', true, 'update'));
            }

            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-travelling.edit', $sk_travelling->id)->with('error', $this->responseMessage->response('surat keterangan bepergian', false, 'update'));
        }
    }

    public function approveLetter(Request $request, SkTravelingLetter $sk_travelling)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skTravelling->confirmationLetter($sk_travelling, true);

            if($update) return redirect(route('letters.sk-travelling.show', $sk_travelling->id))
                                ->with('success', "Surat berhasil disetujui");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-travelling.show', $sk_travelling->id)->with('error', "Surat gagal disetujui");
        }
    }

    public function rejectLetter(Request $request, SkTravelingLetter $sk_travelling)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skTravelling->confirmationLetter($sk_travelling, false, $request->reject_reason);

            if($update) return redirect(route('letters.sk-travelling.show', $sk_travelling->id))
                                ->with('success', "Surat berhasil ditolak");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-travelling.show', $sk_travelling->id)->with('error', "Surat gagal ditolak");
        }
    }

    public function preview(SkTravelingLetter $sk_travelling)
    {
        $sk_travelling = $this->skTravelling->findById($sk_travelling);

        if(auth()->user()->role === Role::ADMIN) abort(404);
        $generated = Pdf::loadView('dashboard.letters.sk-traveling.letter-template', [
            'letter' => $sk_travelling, 
            'user' => auth()->user(), 
            'village_head' => $this->villageHead->find(1)
        ]);        
        return $generated->stream("sk-bepergian-" . $sk_travelling->sk->citizent->name . ".pdf");
    }
    
    public function download(SkTravelingLetter $sk_travelling, $type = "pdf")
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        $generated = Pdf::loadView('dashboard.letters.sk-traveling.letter-template', [
            'letter' => $sk_travelling, 
            'user' => auth()->user(), 
            'village_head' => $this->villageHead->find(1)
        ]);        

        return $generated->download("sk-bepergian-" . $sk_travelling->sk->citizent->name . ".$type");
    }

    public function destroy(SkTravelingLetter $sk_travelling)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {
            $delete = $this->skTravelling->delete($sk_travelling);  

            if(!isset($delete["status"])) {
                return redirect()->route('letters.sk-travelling.index')->with('success', $this->responseMessage->response('Surat keterangan bepergian', true, 'delete'));
            } else if(isset($delete["status"])) {
                return redirect()->route('letters.sk-travelling.index')->with('error', $delete["message"]);
            }

            throw new Exception();
        } catch (\Exception $e) {            
            return redirect()->route('letters.sk-travelling.index')->with('error', $this->responseMessage->response('surat keterangan bepergian', false, 'delete'));
        }
    }
}
