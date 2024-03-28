<?php

namespace App\Http\Controllers\Letters;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Letter\InheritanceGeneology\StoreInheritanceGeneologyRequest;
use App\Http\Requests\Letter\InheritanceGeneology\UpdateInheritanceGeneologyRequest;
use App\Models\InheritanceGeneology;
use App\Models\Sk;
use App\Repositories\CitizentRepository;
use App\Repositories\Letters\InheritanceGeneologyRepository;
use App\Repositories\UserRepository;
use App\Utils\ResponseMessage;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;

class InheritanceGeneologyLetterController extends Controller
{
    public function __construct(
        protected readonly InheritanceGeneologyRepository $inheritanceGeneology,
        protected readonly CitizentRepository $citizent,
        protected readonly ResponseMessage $responseMessage
    ) {}

    public function index(Request $request)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);     
        if(auth()->user()->role === Role::VILLAGE_HEAD) {
            $letters = $this->inheritanceGeneology->findLetterByVillageHead();
        } else if(auth()->user()->role === Role::SECTION_HEAD) {
            $letters = $this->inheritanceGeneology->findLetterBySectionHead();
        } else if(auth()->user()->role === Role::CITIZENT) {
            $letters = $this->inheritanceGeneology->findLetterByCitizent();
        } else if(auth()->user()->role === Role::ENVIRONMENTAL_HEAD) {
            $letters = $this->inheritanceGeneology->findLetterByStatus(0);
        } else {
            $letters = $this->inheritanceGeneology->findAll();
        }

        return view('dashboard.letters.inheritance-geneology.index', compact('letters'));
    }

    public function create()
    { 
        if(auth()->user()->role === Role::ADMIN) abort(404);                                          
        return auth()->user()->role === Role::CITIZENT || auth()->user()->role === Role::SUPER_ADMIN ? 
               view('dashboard.letters.inheritance-geneology.crud.create', [
                    "citizents" => $this->citizent->findAll()
               ]) : 
               abort(404);
    }

    public function show(InheritanceGeneology $inheritanceGeneology)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);                                                   
        $get_letter = $this->inheritanceGeneology->findById($inheritanceGeneology);
        return view('dashboard.letters.inheritance-geneology.crud.detail', compact('get_letter'));
    }

    public function edit(InheritanceGeneology $inheritanceGeneology)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);  
        $get_letter = $this->inheritanceGeneology->findById($inheritanceGeneology);                                         
        return view('dashboard.letters.inheritance-geneology.crud.edit', [
            "get_letter" => $get_letter,
            "citizents" => $this->citizent->findAll()
        ]);
    }

    public function store(StoreInheritanceGeneologyRequest $request)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);            
        if(auth()->user()->role === Role::CITIZENT || auth()->user()->role === Role::SUPER_ADMIN) {
            try {            
                $store = $this->inheritanceGeneology->store($request->validated());            
    
                if($store instanceof Sk) return redirect(route("letters.inheritance-geneology.index"))
                                    ->with("success", $this->responseMessage->response('Surat silsilah waris'));
    
                throw new Exception();
            } catch (\Exception $e) {  
                logger($e->getMessage());
    
                return redirect(route("letters.inheritance-geneology.create"))->with("error", $this->responseMessage->response('surat silsilah waris', false));
            }
        } else {
            abort(404);
        }
    }

    public function update(UpdateInheritanceGeneologyRequest $request, InheritanceGeneology $inheritanceGeneology)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->inheritanceGeneology->update($request->validated(), $inheritanceGeneology);
            if($update == true) {
                return redirect(route('letters.inheritance-geneology.index'))
                                ->with('success', $this->responseMessage->response('Surat silsilah waris', true, 'update'));
            }

            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.inheritance-geneology.edit', $inheritanceGeneology->id)->with('error', $this->responseMessage->response('surat silsilah waris', false, 'update'));
        }
    }

    public function approveLetter(Request $request, InheritanceGeneology $inheritanceGeneology)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->inheritanceGeneology->confirmationLetter($inheritanceGeneology, true);

            if($update) return redirect(route('letters.inheritance-geneology.show', $inheritanceGeneology->id))
                                ->with('success', "Surat berhasil disetujui");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.inheritance-geneology.show', $inheritanceGeneology->id)->with('error', "Surat gagal disetujui");
        }
    }

    public function rejectLetter(Request $request, InheritanceGeneology $inheritanceGeneology)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->inheritanceGeneology->confirmationLetter($inheritanceGeneology, false);

            if($update) return redirect(route('letters.inheritance-geneology.show', $inheritanceGeneology->id))
                                ->with('success', "Surat berhasil ditolak");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.inheritance-geneology.show', $inheritanceGeneology->id)->with('error', "Surat gagal ditolak");
        }
    }

    public function preview(InheritanceGeneology $inheritanceGeneology)
    {
        $inheritanceGeneology = $this->inheritanceGeneology->findById($inheritanceGeneology);

        if(auth()->user()->role === Role::ADMIN) abort(404);
        $generated = Pdf::loadView('dashboard.letters.inheritance-geneology.letter-template', ['letter' => $inheritanceGeneology, "user" => auth()->user()]);        

        return $generated->stream("surat-silsilah-waris-" . $inheritanceGeneology->sk->citizent->name . ".pdf");
    }
    
    public function download(InheritanceGeneology $inheritanceGeneology, $type = "pdf")
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        $generated = Pdf::loadView('dashboard.letters.inheritance-geneology.letter-template', ['letter' => $inheritanceGeneology]);        

        return $generated->download("surat-silsilah-waris-" . $inheritanceGeneology->sk->citizent->name . ".$type");
    }

    public function destroy(InheritanceGeneology $inheritanceGeneology)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {
            $delete = $this->inheritanceGeneology->delete($inheritanceGeneology);  

            if(!isset($delete["status"])) {
                return redirect()->route('letters.inheritance-geneology.index')->with('success', $this->responseMessage->response('Surat silsilah waris', true, 'delete'));
            } else if(isset($delete["status"])) {
                return redirect()->route('letters.inheritance-geneology.index')->with('error', $delete["message"]);
            }

            throw new Exception();
        } catch (\Exception $e) {            
            return redirect()->route('letters.inheritance-geneology.index')->with('error', $this->responseMessage->response('surat silsilah waris', false, 'delete'));
        }
    }
}
