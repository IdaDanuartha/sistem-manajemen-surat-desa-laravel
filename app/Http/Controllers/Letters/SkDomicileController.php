<?php

namespace App\Http\Controllers\Letters;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Letter\SkDomicile\StoreSkDomicileRequest;
use App\Http\Requests\Letter\SkDomicile\UpdateSkDomicileRequest;
use App\Models\Sk;
use App\Models\SkDomicileLetter;
use App\Models\User;
use App\Repositories\CitizentRepository;
use App\Repositories\Letters\SkDomicileRepository;
use App\Utils\GenerateReferenceNumber;
use App\Utils\ResponseMessage;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;

class SkDomicileController extends Controller
{
    public function __construct(
        protected readonly SkDomicileRepository $skDomicile,
        protected readonly User $user,
        protected readonly CitizentRepository $citizent,
        protected readonly ResponseMessage $responseMessage
    ) {}

    public function index(Request $request)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);     
        if(auth()->user()->role === Role::VILLAGE_HEAD || auth()->user()->role === Role::SECTION_HEAD) {
            $letters = $this->skDomicile->findLetterBySectionHead();
        } else if(auth()->user()->role === Role::CITIZENT) {
            $letters = $this->skDomicile->findLetterByCitizent();
        } else if(auth()->user()->role === Role::ENVIRONMENTAL_HEAD) {
            $letters = $this->skDomicile->findLetterByStatus(0);
        } else {
            $letters = $this->skDomicile->findAll();
        }
        return view('dashboard.letters.sk-domicile.index', compact('letters'));
    }

    public function create()
    { 
        $reference_number = new GenerateReferenceNumber("", 6);
        $cover_letter_number = new GenerateReferenceNumber("", 1, "", "", "", auth()->user()->authenticatable->environmental->code ?? "---");

        if(auth()->user()->role === Role::ADMIN) abort(404);                                          
        return auth()->user()->role === Role::CITIZENT || auth()->user()->role === Role::SUPER_ADMIN ? 
               view('dashboard.letters.sk-domicile.crud.create', [
                    "citizents" => $this->citizent->findAll(),
                    "reference_number" => $reference_number->generate(),
                    "cover_letter_number" => $cover_letter_number->generateCoverLetter(),
               ]) : 
               abort(404);
    }

    public function show(SkDomicileLetter $skDomicile)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);                                                   
        $get_letter = $this->skDomicile->findById($skDomicile);
        return view('dashboard.letters.sk-domicile.crud.detail', compact('get_letter'));
    }

    public function edit(SkDomicileLetter $skDomicile)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);  
        $get_letter = $this->skDomicile->findById($skDomicile);                                         
        return view('dashboard.letters.sk-domicile.crud.edit', [
            "get_letter" => $get_letter,
            "citizents" => $this->citizent->findAll()
        ]);
    }

    public function store(StoreSkDomicileRequest $request)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);            
        if(auth()->user()->role === Role::CITIZENT || auth()->user()->role === Role::SUPER_ADMIN) {
            try {            
                $store = $this->skDomicile->store($request->validated());            
    
                if($store instanceof Sk) return redirect(route("letters.sk-domicile.index"))
                                    ->with("success", $this->responseMessage->response('Surat keterangan domisili'));
    
                throw new Exception();
            } catch (\Exception $e) {  
                logger($e->getMessage());
    
                return redirect(route("letters.sk-domicile.create"))->with("error", $this->responseMessage->response('surat keterangan domisili', false));
            }
        } else {
            abort(404);
        }
    }

    public function update(UpdateSkDomicileRequest $request, SkDomicileLetter $skDomicile)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skDomicile->update($request->validated(), $skDomicile);
            if($update == true) {
                return redirect(route('letters.sk-domicile.index'))
                                ->with('success', $this->responseMessage->response('Surat keterangan domisili', true, 'update'));
            }

            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-domicile.edit', $skDomicile->id)->with('error', $this->responseMessage->response('surat keterangan domisili', false, 'update'));
        }
    }

    public function approveLetter(Request $request, SkDomicileLetter $skDomicile)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skDomicile->confirmationLetter($skDomicile, true);

            if($update) return redirect(route('letters.sk-domicile.show', $skDomicile->id))
                                ->with('success', "Surat berhasil disetujui");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-domicile.show', $skDomicile->id)->with('error', "Surat gagal disetujui");
        }
    }

    public function rejectLetter(Request $request, SkDomicileLetter $skDomicile)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skDomicile->confirmationLetter($skDomicile, false, $request->reject_reason);

            if($update) return redirect(route('letters.sk-domicile.show', $skDomicile->id))
                                ->with('success', "Surat berhasil ditolak");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-domicile.show', $skDomicile->id)->with('error', "Surat gagal ditolak");
        }
    }

    public function preview(SkDomicileLetter $skDomicile)
    {
        $skDomicile = $this->skDomicile->findById($skDomicile);

        if(auth()->user()->role === Role::ADMIN) abort(404);
        $generated = Pdf::loadView('dashboard.letters.sk-domicile.letter-template', [
            'letter' => $skDomicile,
            "user" => auth()->user(),
            "village_head" => $this->user->where("role", Role::VILLAGE_HEAD)->first()
        ]);        

        return $generated->stream("sk-domisili-" . $skDomicile->sk->citizent->name . ".pdf");
    }
    
    public function download(SkDomicileLetter $skDomicile, $type = "pdf")
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        $generated = Pdf::loadView('dashboard.letters.sk-domicile.letter-template', [
            'letter' => $skDomicile,
            "user" => auth()->user(),
            "village_head" => $this->user->where("role", Role::VILLAGE_HEAD)->first()
        ]);        

        return $generated->download("sk-domisili-" . $skDomicile->sk->citizent->name . ".$type");
    }

    public function destroy(SkDomicileLetter $skDomicile)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {
            $delete = $this->skDomicile->delete($skDomicile);  

            if(!isset($delete["status"])) {
                return redirect()->route('letters.sk-domicile.index')->with('success', $this->responseMessage->response('Surat keterangan domisili', true, 'delete'));
            } else if(isset($delete["status"])) {
                return redirect()->route('letters.sk-domicile.index')->with('error', $delete["message"]);
            }

            throw new Exception;
        } catch (\Exception $e) {            
            return redirect()->route('letters.sk-domicile.index')->with('error', $this->responseMessage->response('surat keterangan domisili', false, 'delete'));
        }
    }
}
