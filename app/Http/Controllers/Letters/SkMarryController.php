<?php

namespace App\Http\Controllers\Letters;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Letter\SkMarry\StoreSkMarryRequest;
use App\Http\Requests\Letter\SkMarry\UpdateSkMarryRequest;
use App\Models\Sk;
use App\Models\SkMarryLetter;
use App\Repositories\CitizentRepository;
use App\Repositories\Letters\SkMarryRepository;
use App\Utils\GenerateReferenceNumber;
use App\Utils\ResponseMessage;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;

class SkMarryController extends Controller
{
    public function __construct(
        protected readonly SkMarryRepository $skMarry,
        protected readonly CitizentRepository $citizent,
        protected readonly ResponseMessage $responseMessage
    ) {}

    public function index(Request $request)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);     
        if(auth()->user()->role === Role::VILLAGE_HEAD || auth()->user()->role === Role::SECTION_HEAD) {
            $letters = $this->skMarry->findLetterBySectionHead();
        } else if(auth()->user()->role === Role::CITIZENT) {
            $letters = $this->skMarry->findLetterByCitizent();
        } else if(auth()->user()->role === Role::ENVIRONMENTAL_HEAD) {
            $letters = $this->skMarry->findLetterByStatus(0);
        } else {
            $letters = $this->skMarry->findAll();
        }

        return view('dashboard.letters.sk-marry.index', compact('letters'));
    }

    public function create()
    { 
        $reference_number = new GenerateReferenceNumber("474.2", 2, "Kppdk", "Ket");
        $cover_letter_number = new GenerateReferenceNumber("", 1, "", "", "", auth()->user()->authenticatable->environmental->code ?? "---");
        
        if(auth()->user()->role === Role::ADMIN) abort(404);                                          
        return auth()->user()->role === Role::CITIZENT || auth()->user()->role === Role::SUPER_ADMIN ? 
               view('dashboard.letters.sk-marry.crud.create', [
                    "citizents" => $this->citizent->findAll(),
                    "reference_number" => $reference_number->generate(),
                    "cover_letter_number" => $cover_letter_number->generateCoverLetter(),
               ]) : 
               abort(404);
    }

    public function show(SkMarryLetter $sk_marry)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);                                                   
        $get_letter = $this->skMarry->findById($sk_marry);
        return view('dashboard.letters.sk-marry.crud.detail', compact('get_letter'));
    }

    public function edit(SkMarryLetter $sk_marry)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);  
        $get_letter = $this->skMarry->findById($sk_marry);                                         
        return view('dashboard.letters.sk-marry.crud.edit', [
            "get_letter" => $get_letter,
            "citizents" => $this->citizent->findAll()
        ]);
    }

    public function store(StoreSkMarryRequest $request)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);            
        if(auth()->user()->role === Role::CITIZENT || auth()->user()->role === Role::SUPER_ADMIN) {
            try {            
                $store = $this->skMarry->store($request->validated());            
    
                if($store instanceof Sk) return redirect(route("letters.sk-marry.index"))
                                    ->with("success", $this->responseMessage->response('Surat keterangan kawin'));
    
                throw new Exception;
            } catch (\Exception $e) {  
                logger($e->getMessage());
    
                return redirect(route("letters.sk-marry.create"))->with("error", $this->responseMessage->response('surat keterangan kawin', false));
            }
        } else {
            abort(404);
        }
    }

    public function update(UpdateSkMarryRequest $request, SkMarryLetter $sk_marry)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skMarry->update($request->validated(), $sk_marry);
            if($update == true) {
                return redirect(route('letters.sk-marry.index'))
                                ->with('success', $this->responseMessage->response('Surat keterangan kawin', true, 'update'));
            }

            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-marry.edit', $sk_marry->id)->with('error', $this->responseMessage->response('surat keterangan kawin', false, 'update'));
        }
    }

    public function approveLetter(Request $request, SkMarryLetter $sk_marry)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skMarry->confirmationLetter($sk_marry, true);

            if($update) return redirect(route('letters.sk-marry.show', $sk_marry->id))
                                ->with('success', "Surat berhasil disetujui");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-marry.show', $sk_marry->id)->with('error', "Surat gagal disetujui");
        }
    }

    public function rejectLetter(Request $request, SkMarryLetter $sk_marry)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skMarry->confirmationLetter($sk_marry, false, $request->reject_reason);

            if($update) return redirect(route('letters.sk-marry.show', $sk_marry->id))
                                ->with('success', "Surat berhasil ditolak");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-marry.show', $sk_marry->id)->with('error', "Surat gagal ditolak");
        }
    }

    public function preview(SkMarryLetter $sk_marry)
    {
        $sk_marry = $this->skMarry->findById($sk_marry);

        if(auth()->user()->role === Role::ADMIN) abort(404);
        $generated = Pdf::loadView('dashboard.letters.sk-marry.letter-template', ['letter' => $sk_marry, "user" => auth()->user()]);        

        return $generated->stream("surat-keterangan-" . $sk_marry->status === 1 ? "belum-menikah-" : "kawin-" . $sk_marry->sk->citizent->name . ".pdf");
    }
    
    public function download(SkMarryLetter $sk_marry, $type = "pdf")
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        $generated = Pdf::loadView('dashboard.letters.sk-marry.letter-template', ['letter' => $sk_marry]);        

        return $generated->download("surat-keterangan-" . $sk_marry->status === 1 ? "belum-menikah-" : "kawin-" . $sk_marry->sk->citizent->name . ".$type");
    }

    public function destroy(SkMarryLetter $sk_marry)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {
            $delete = $this->skMarry->delete($sk_marry);  

            if(!isset($delete["status"])) {
                return redirect()->route('letters.sk-marry.index')->with('success', $this->responseMessage->response('Surat keterangan kawin', true, 'delete'));
            } else if(isset($delete["status"])) {
                return redirect()->route('letters.sk-marry.index')->with('error', $delete["message"]);
            }

            throw new Exception;
        } catch (\Exception $e) {            
            return redirect()->route('letters.sk-marry.index')->with('error', $this->responseMessage->response('surat keterangan kawin', false, 'delete'));
        }
    }
}
