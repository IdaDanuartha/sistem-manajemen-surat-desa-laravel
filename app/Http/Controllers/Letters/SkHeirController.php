<?php

namespace App\Http\Controllers\Letters;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Letter\SkHeir\StoreSkHeirRequest;
use App\Http\Requests\Letter\SkHeir\UpdateSkHeirRequest;
use App\Models\Sk;
use App\Models\SkHeir;
use App\Repositories\Letters\SkHeirRepository;
use App\Repositories\UserRepository;
use App\Utils\ResponseMessage;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;

class SkHeirController extends Controller
{
    public function __construct(
        protected readonly SkHeirRepository $skHeir,
        protected readonly UserRepository $user,
        protected readonly ResponseMessage $responseMessage
    ) {}

    public function index(Request $request)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);     
        if(auth()->user()->role === Role::VILLAGE_HEAD) {
            $letters = $this->skHeir->findLetterByVillageHead();
        } else if(auth()->user()->role === Role::SECTION_HEAD) {
            $letters = $this->skHeir->findLetterBySectionHead();
        } else if(auth()->user()->role === Role::CITIZENT) {
            $letters = $this->skHeir->findLetterByCitizent();
        } else if(auth()->user()->role === Role::ENVIRONMENTAL_HEAD) {
            $letters = $this->skHeir->findLetterByStatus(0);
        } else {
            $letters = $this->skHeir->findAll();
        }

        return view('dashboard.letters.sk-heir.index', compact('letters'));
    }

    public function create()
    { 
        if(auth()->user()->role === Role::ADMIN) abort(404);                                          
        return auth()->user()->role === Role::CITIZENT || auth()->user()->role === Role::SUPER_ADMIN ? 
               view('dashboard.letters.sk-heir.crud.create', [
                    "citizents" => $this->user->findAllCitizent()
               ]) : 
               abort(404);
    }

    public function show(SkHeir $skHeir)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);                                                   
        $get_letter = $this->skHeir->findById($skHeir);
        return view('dashboard.letters.sk-heir.crud.detail', compact('get_letter'));
    }

    public function edit(SkHeir $skHeir)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);  
        $get_letter = $this->skHeir->findById($skHeir);                                         
        return view('dashboard.letters.sk-heir.crud.edit', [
            "get_letter" => $get_letter,
            "citizents" => $this->user->findAllCitizent()
        ]);
    }

    public function store(StoreSkHeirRequest $request)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);            
        if(auth()->user()->role === Role::CITIZENT || auth()->user()->role === Role::SUPER_ADMIN) {
            try {            
                $store = $this->skHeir->store($request->validated());            
    
                if($store instanceof Sk) return redirect(route("letters.sk-heir.index"))
                                    ->with("success", $this->responseMessage->response('Surat kuasa'));
    
                throw new Exception();
            } catch (\Exception $e) {  
                logger($e->getMessage());
    
                return redirect(route("letters.sk-heir.create"))->with("error", $this->responseMessage->response('surat kuasa', false));
            }
        } else {
            abort(404);
        }
    }

    public function update(UpdateSkHeirRequest $request, SkHeir $skHeir)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skHeir->update($request->validated(), $skHeir);
            if($update == true) {
                return redirect(route('letters.sk-heir.index'))
                                ->with('success', $this->responseMessage->response('Surat kuasa', true, 'update'));
            }

            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-heir.edit', $skHeir->id)->with('error', $this->responseMessage->response('surat kuasa', false, 'update'));
        }
    }

    public function approveLetter(Request $request, SkHeir $skHeir)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skHeir->confirmationLetter($skHeir, true);

            if($update) return redirect(route('letters.sk-heir.show', $skHeir->id))
                                ->with('success', "Surat berhasil disetujui");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-heir.show', $skHeir->id)->with('error', "Surat gagal disetujui");
        }
    }

    public function rejectLetter(Request $request, SkHeir $skHeir)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skHeir->confirmationLetter($skHeir, false);

            if($update) return redirect(route('letters.sk-heir.show', $skHeir->id))
                                ->with('success', "Surat berhasil ditolak");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-heir.show', $skHeir->id)->with('error', "Surat gagal ditolak");
        }
    }

    public function preview(SkHeir $skHeir)
    {
        $skHeir = $this->skHeir->findById($skHeir);

        if(auth()->user()->role === Role::ADMIN) abort(404);
        $generated = Pdf::loadView('dashboard.letters.sk-heir.letter-template', ['letter' => $skHeir, "user" => auth()->user()]);        

        return $generated->stream("surat-kuasa-" . $skHeir->sk->citizent->name . ".pdf");
    }
    
    public function download(SkHeir $skHeir, $type = "pdf")
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        $generated = Pdf::loadView('dashboard.letters.sk-heir.letter-template', ['letter' => $skHeir]);        

        return $generated->download("surat-kuasa-" . $skHeir->sk->citizent->name . ".$type");
    }

    public function destroy(SkHeir $skHeir)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {
            $delete = $this->skHeir->delete($skHeir);  

            if(!isset($delete["status"])) {
                return redirect()->route('letters.sk-heir.index')->with('success', $this->responseMessage->response('Surat kuasa', true, 'delete'));
            } else if(isset($delete["status"])) {
                return redirect()->route('letters.sk-heir.index')->with('error', $delete["message"]);
            }

            throw new Exception();
        } catch (\Exception $e) {            
            return redirect()->route('letters.sk-heir.index')->with('error', $this->responseMessage->response('surat kuasa', false, 'delete'));
        }
    }
}
