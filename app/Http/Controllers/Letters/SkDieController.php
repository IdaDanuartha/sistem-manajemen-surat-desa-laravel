<?php

namespace App\Http\Controllers\Letters;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Letter\SkDie\StoreSkDieRequest;
use App\Http\Requests\Letter\SkDie\UpdateSkDieRequest;
use App\Models\Sk;
use App\Models\SkDieLetter;
use App\Repositories\CitizentRepository;
use App\Repositories\Letters\SkDieRepository;
use App\Utils\GenerateReferenceNumber;
use App\Utils\ResponseMessage;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;

class SkDieController extends Controller
{
    public function __construct(
        protected readonly SkDieRepository $skDie,
        protected readonly CitizentRepository $citizent,
        protected readonly ResponseMessage $responseMessage
    ) {}

    public function index(Request $request)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);     
        if(auth()->user()->role === Role::VILLAGE_HEAD || auth()->user()->role === Role::SECTION_HEAD) {
            $letters = $this->skDie->findLetterBySectionHead();
        } else if(auth()->user()->role === Role::CITIZENT) {
            $letters = $this->skDie->findLetterByCitizent();
        } else if(auth()->user()->role === Role::ENVIRONMENTAL_HEAD) {
            $letters = $this->skDie->findLetterByStatus(0);
        } else {
            $letters = $this->skDie->findAll();
        }

        return view('dashboard.letters.sk-die.index', compact('letters'));
    }

    public function create()
    { 
        $reference_number = new GenerateReferenceNumber();
        $cover_letter_number = new GenerateReferenceNumber("", 1, "", "", "", auth()->user()->authenticatable->environmental->code ?? "---");

        if(auth()->user()->role === Role::ADMIN) abort(404);                                          
        return auth()->user()->role === Role::CITIZENT || auth()->user()->role === Role::SUPER_ADMIN ? 
               view('dashboard.letters.sk-die.crud.create', [
                    "citizents" => $this->citizent->findAll(),
                    "reference_number" => $reference_number->generate(),
                    "cover_letter_number" => $cover_letter_number->generateCoverLetter(),
               ]) : 
               abort(404);
    }

    public function show(SkDieLetter $skDie)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);                                                   
        $get_letter = $this->skDie->findById($skDie);
        return view('dashboard.letters.sk-die.crud.detail', compact('get_letter'));
    }

    public function edit(SkDieLetter $skDie)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);  
        $get_letter = $this->skDie->findById($skDie);                                         
        return view('dashboard.letters.sk-die.crud.edit', [
            "get_letter" => $get_letter,
            "citizents" => $this->citizent->findAll()
        ]);
    }

    public function store(StoreSkDieRequest $request)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);            
        if(auth()->user()->role === Role::CITIZENT || auth()->user()->role === Role::SUPER_ADMIN) {
            try {            
                $store = $this->skDie->store($request->validated());            
    
                if($store instanceof Sk) return redirect(route("letters.sk-die.index"))
                                    ->with("success", $this->responseMessage->response('Surat keterangan meninggal'));
    
                throw new Exception();
            } catch (\Exception $e) {  
                logger($e->getMessage());
    
                return redirect(route("letters.sk-die.create"))->with("error", $this->responseMessage->response('surat keterangan meninggal', false));
            }
        } else {
            abort(404);
        }
    }

    public function update(UpdateSkDieRequest $request, SkDieLetter $skDie)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skDie->update($request->validated(), $skDie);
            if($update == true) {
                return redirect(route('letters.sk-die.index'))
                                ->with('success', $this->responseMessage->response('Surat keterangan meninggal', true, 'update'));
            }

            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-die.edit', $skDie->id)->with('error', $this->responseMessage->response('surat keterangan meninggal', false, 'update'));
        }
    }

    public function approveLetter(Request $request, SkDieLetter $skDie)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skDie->confirmationLetter($skDie, true);

            if($update) return redirect(route('letters.sk-die.show', $skDie->id))
                                ->with('success', "Surat berhasil disetujui");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-die.show', $skDie->id)->with('error', "Surat gagal disetujui");
        }
    }

    public function rejectLetter(Request $request, SkDieLetter $skDie)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skDie->confirmationLetter($skDie, false);

            if($update) return redirect(route('letters.sk-die.show', $skDie->id))
                                ->with('success', "Surat berhasil ditolak");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-die.show', $skDie->id)->with('error', "Surat gagal ditolak");
        }
    }

    public function preview(SkDieLetter $skDie)
    {
        $skDie = $this->skDie->findById($skDie);

        if(auth()->user()->role === Role::ADMIN) abort(404);
        $generated = Pdf::loadView('dashboard.letters.sk-die.letter-template', ['letter' => $skDie, "user" => auth()->user()]);        

        return $generated->stream("sk-meninggal-" . $skDie->sk->citizent->name . ".pdf");
    }
    
    public function download(SkDieLetter $skDie, $type = "pdf")
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        $generated = Pdf::loadView('dashboard.letters.sk-die.letter-template', ['letter' => $skDie]);        

        return $generated->download("sk-meninggal-" . $skDie->sk->citizent->name . ".$type");
    }

    public function destroy(SkDieLetter $skDie)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {
            $delete = $this->skDie->delete($skDie);  

            if(!isset($delete["status"])) {
                return redirect()->route('letters.sk-die.index')->with('success', $this->responseMessage->response('Surat keterangan meninggal', true, 'delete'));
            } else if(isset($delete["status"])) {
                return redirect()->route('letters.sk-die.index')->with('error', $delete["message"]);
            }

            throw new Exception;
        } catch (\Exception $e) {            
            return redirect()->route('letters.sk-die.index')->with('error', $this->responseMessage->response('surat keterangan meninggal', false, 'delete'));
        }
    }
}
