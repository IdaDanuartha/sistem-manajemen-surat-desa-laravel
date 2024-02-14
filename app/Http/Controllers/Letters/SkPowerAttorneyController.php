<?php

namespace App\Http\Controllers\Letters;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Models\Sk;
use App\Models\SkPowerAttorney;
use App\Repositories\Letters\SkPowerAttorneyRepository;
use App\Utils\ResponseMessage;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;

class SkPowerAttorneyController extends Controller
{
    public function __construct(
        protected readonly SkPowerAttorneyRepository $skPowerAttorney,
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
        } else {
            $letters = $this->skPowerAttorney->findLetterByStatus(0);
        }
        return view('dashboard.letters.sk-power-attorney.index', compact('letters'));
    }

    public function create()
    { 
        if(auth()->user()->role === Role::ADMIN) abort(404);                                          
        return auth()->user()->role === Role::CITIZENT ? 
               view('dashboard.letters.sk-power-attorney.crud.create') : 
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
        return view('dashboard.letters.sk-power-attorney.crud.edit', compact('get_letter'));
    }

    public function store(StoreSkResidenceRequest $request)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);            
        if(auth()->user()->role === Role::CITIZENT) {
            try {            
                $store = $this->skPowerAttorney->store($request->validated());            
    
                if($store instanceof Sk) return redirect(route("letters.sk-power-attorney.index"))
                                    ->with("success", $this->responseMessage->response('Surat silsilah kuasa'));
    
                throw new Exception();
            } catch (\Exception $e) {  
                logger($e->getMessage());
    
                return redirect(route("letters.sk-power-attorney.create"))->with("error", $this->responseMessage->response('surat silsilah kuasa', false));
            }
        } else {
            abort(404);
        }
    }

    public function update(UpdateSkResidenceRequest $request, SkPowerAttorney $skPowerAttorney)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skPowerAttorney->update($request->validated(), $skPowerAttorney);
            if($update == true) {
                return redirect(route('letters.sk-power-attorney.index'))
                                ->with('success', $this->responseMessage->response('Surat silsilah kuasa', true, 'update'));
            }

            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-power-attorney.edit', $skPowerAttorney->id)->with('error', $this->responseMessage->response('surat silsilah kuasa', false, 'update'));
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
            $update = $this->skPowerAttorney->confirmationLetter($skPowerAttorney, false);

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

        if(auth()->user()->role === Role::ADMIN) abort(404);
        $generated = Pdf::loadView('dashboard.letters.sk-power-attorney.letter-template', ['letter' => $skPowerAttorney, "user" => auth()->user()]);        

        return $generated->stream("SK Tempat Tinggal " . $skPowerAttorney->sk->citizent->name . ".pdf");
    }
    
    public function download(SkPowerAttorney $skPowerAttorney, $type = "pdf")
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        $generated = Pdf::loadView('dashboard.letters.sk-power-attorney.letter-template', ['letter' => $skPowerAttorney]);        

        return $generated->download("SK Tempat Tinggal " . $skPowerAttorney->sk->citizent->name . ".$type");
    }

    public function destroy(SkPowerAttorney $skPowerAttorney)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {
            $delete = $this->skPowerAttorney->delete($skPowerAttorney);  

            if(!isset($delete["status"])) {
                return redirect()->route('letters.sk-power-attorney.index')->with('success', $this->responseMessage->response('Surat silsilah kuasa', true, 'delete'));
            } else if(isset($delete["status"])) {
                return redirect()->route('letters.sk-power-attorney.index')->with('error', $delete["message"]);
            }

            throw new Exception();
        } catch (\Exception $e) {            
            return redirect()->route('letters.sk-power-attorney.index')->with('error', $this->responseMessage->response('surat silsilah kuasa', false, 'delete'));
        }
    }
}
