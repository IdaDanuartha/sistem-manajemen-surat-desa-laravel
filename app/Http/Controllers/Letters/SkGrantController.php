<?php

namespace App\Http\Controllers\Letters;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Letter\SkGrant\StoreSkGrantRequest;
use App\Http\Requests\Letter\SkGrant\UpdateSkGrantRequest;
use App\Models\EnvironmentalHead;
use App\Models\Sk;
use App\Models\SkGrantLetter;
use App\Repositories\CitizentRepository;
use App\Repositories\Letters\SkGrantRepository;
use App\Repositories\UserRepository;
use App\Utils\ResponseMessage;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;

class SkGrantController extends Controller
{
    public function __construct(
        protected readonly SkGrantRepository $skGrant,
        protected readonly CitizentRepository $citizent,
        protected readonly ResponseMessage $responseMessage
    ) {}

    public function index(Request $request)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);     
        if(auth()->user()->role === Role::VILLAGE_HEAD) {
            $letters = $this->skGrant->findLetterByVillageHead();
        } else if(auth()->user()->role === Role::SECTION_HEAD) {
            $letters = $this->skGrant->findLetterBySectionHead();
        } else if(auth()->user()->role === Role::CITIZENT) {
            $letters = $this->skGrant->findLetterByCitizent();
        } else if(auth()->user()->role === Role::ENVIRONMENTAL_HEAD) {
            $letters = $this->skGrant->findAllEnvironmentalLetter();
        } else {
            $letters = $this->skGrant->findAll();
        }

        return view('dashboard.letters.sk-grant.index', compact('letters'));
    }

    public function create()
    { 
        if(auth()->user()->role === Role::ADMIN) abort(404);                                          
        return auth()->user()->role === Role::CITIZENT || auth()->user()->role === Role::SUPER_ADMIN ? 
               view('dashboard.letters.sk-grant.crud.create', [
                    "citizents" => $this->citizent->findAll()
               ]) : 
               abort(404);
    }

    public function show(SkGrantLetter $skGrant)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);                                                   
        $get_letter = $this->skGrant->findById($skGrant);
        $environmentalHead = EnvironmentalHead::with("environmental")->whereRelation("environmental", "code", "=", $get_letter->sk->citizent->environmental->code)->first();
        return view('dashboard.letters.sk-grant.crud.detail', compact('get_letter', 'environmentalHead'));
    }

    public function edit(SkGrantLetter $skGrant)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);  
        $get_letter = $this->skGrant->findById($skGrant);                                         
        return view('dashboard.letters.sk-grant.crud.edit', [
            "get_letter" => $get_letter,
            "citizents" => $this->citizent->findAll()
        ]);
    }

    public function store(StoreSkGrantRequest $request)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);            
        if(auth()->user()->role === Role::CITIZENT || auth()->user()->role === Role::SUPER_ADMIN) {
            try {            
                $store = $this->skGrant->store($request->validated());            
    
                if($store instanceof Sk) return redirect(route("letters.sk-grant.index"))
                                    ->with("success", $this->responseMessage->response('Surat keterangan hibah samsat'));
    
                throw new Exception();
            } catch (\Exception $e) {  
                logger($e->getMessage());
    
                return redirect(route("letters.sk-grant.create"))->with("error", $this->responseMessage->response('surat keterangan hibah samsat', false));
            }
        } else {
            abort(404);
        }
    }

    public function update(UpdateSkGrantRequest $request, SkGrantLetter $skGrant)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skGrant->update($request->validated(), $skGrant);
            if($update == true) {
                return redirect(route('letters.sk-grant.index'))
                                ->with('success', $this->responseMessage->response('Surat keterangan hibah samsat', true, 'update'));
            }

            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-grant.edit', $skGrant->id)->with('error', $this->responseMessage->response('surat keterangan hibah samsat', false, 'update'));
        }
    }

    public function approveLetter(Request $request, SkGrantLetter $skGrant)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skGrant->confirmationLetter($skGrant, true);

            if($update) return redirect(route('letters.sk-grant.show', $skGrant->id))
                                ->with('success', "Surat berhasil disetujui");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-grant.show', $skGrant->id)->with('error', "Surat gagal disetujui");
        }
    }

    public function rejectLetter(Request $request, SkGrantLetter $skGrant)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skGrant->confirmationLetter($skGrant, false, $request->reject_reason);

            if($update) return redirect(route('letters.sk-grant.show', $skGrant->id))
                                ->with('success', "Surat berhasil ditolak");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-grant.show', $skGrant->id)->with('error', "Surat gagal ditolak");
        }
    }

    public function preview(SkGrantLetter $skGrant)
    {
        $skGrant = $this->skGrant->findById($skGrant);

        if(auth()->user()->role === Role::ADMIN) abort(404);
        $generated = Pdf::loadView('dashboard.letters.sk-grant.letter-template', ['letter' => $skGrant, "user" => auth()->user()]);        

        return $generated->stream("sk-hibah-samsat-" . $skGrant->sk->citizent->name . ".pdf");
    }
    
    public function download(SkGrantLetter $skGrant, $type = "pdf")
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        $generated = Pdf::loadView('dashboard.letters.sk-grant.letter-template', ['letter' => $skGrant]);        

        return $generated->download("sk-hibah-samsat-" . $skGrant->sk->citizent->name . ".$type");
    }

    public function destroy(SkGrantLetter $skGrant)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {
            $delete = $this->skGrant->delete($skGrant);  

            if(!isset($delete["status"])) {
                return redirect()->route('letters.sk-grant.index')->with('success', $this->responseMessage->response('Surat keterangan hibah samsat', true, 'delete'));
            } else if(isset($delete["status"])) {
                return redirect()->route('letters.sk-grant.index')->with('error', $delete["message"]);
            }

            throw new Exception;
        } catch (\Exception $e) {            
            return redirect()->route('letters.sk-grant.index')->with('error', $this->responseMessage->response('surat keterangan hibah samsat', false, 'delete'));
        }
    }
}
