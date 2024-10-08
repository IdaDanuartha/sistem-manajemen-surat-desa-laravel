<?php

namespace App\Http\Controllers\Letters;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Letter\SkInheritanceDistribution\StoreSkInheritanceDistributionRequest;
use App\Http\Requests\Letter\SkInheritanceDistribution\UpdateSkInheritanceDistributionRequest;
use App\Models\EnvironmentalHead;
use App\Models\Sk;
use App\Models\SkInheritanceDistribution;
use App\Models\SubdistrictHead;
use App\Repositories\CitizentRepository;
use App\Repositories\Letters\SkInheritanceDistributionRepository;
use App\Repositories\UserRepository;
use App\Utils\ResponseMessage;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;

class SkInheritanceDistributionController extends Controller
{
    public function __construct(
        protected readonly SkInheritanceDistributionRepository $skInheritanceDistribution,
        protected readonly CitizentRepository $citizent,
        protected readonly SubdistrictHead $subdistrictHead,
        protected readonly ResponseMessage $responseMessage
    ) {}

    public function index(Request $request)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);     
        if(auth()->user()->role === Role::VILLAGE_HEAD) {
            $letters = $this->skInheritanceDistribution->findLetterByVillageHead();
        } else if(auth()->user()->role === Role::SECTION_HEAD) {
            $letters = $this->skInheritanceDistribution->findLetterBySectionHead();
        } else if(auth()->user()->role === Role::CITIZENT) {
            $letters = $this->skInheritanceDistribution->findLetterByCitizent();
        } else if(auth()->user()->role === Role::ENVIRONMENTAL_HEAD) {
            $letters = $this->skInheritanceDistribution->findLetterByStatus(0);
        } else {
            $letters = $this->skInheritanceDistribution->findAll();
        }

        return view('dashboard.letters.sk-inheritance-distribution.index', compact('letters'));
    }

    public function create()
    { 
        if(auth()->user()->role === Role::ADMIN) abort(404);                                          
        return auth()->user()->role === Role::CITIZENT || auth()->user()->role === Role::SUPER_ADMIN ? 
               view('dashboard.letters.sk-inheritance-distribution.crud.create', [
                    "citizents" => $this->citizent->findAll()
               ]) : 
               abort(404);
    }

    public function show(SkInheritanceDistribution $skInheritanceDistribution)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);                                                   
        $get_letter = $this->skInheritanceDistribution->findById($skInheritanceDistribution);
        $environmentalHead = EnvironmentalHead::with("environmental")->whereRelation("environmental", "code", "=", $get_letter->sk->citizent->environmental->code)->first();
        return view('dashboard.letters.sk-inheritance-distribution.crud.detail', compact('get_letter', 'environmentalHead'));
    }

    public function edit(SkInheritanceDistribution $skInheritanceDistribution)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);  
        $get_letter = $this->skInheritanceDistribution->findById($skInheritanceDistribution);                                         
        return view('dashboard.letters.sk-inheritance-distribution.crud.edit', [
            "get_letter" => $get_letter,
            "citizents" => $this->citizent->findAll()
        ]);
    }

    public function store(StoreSkInheritanceDistributionRequest $request)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);            
        if(auth()->user()->role === Role::CITIZENT || auth()->user()->role === Role::SUPER_ADMIN) {
            try {            
                $store = $this->skInheritanceDistribution->store($request->validated());            
    
                if($store instanceof Sk) return redirect(route("letters.sk-inheritance-distribution.index"))
                                    ->with("success", $this->responseMessage->response('Surat pernyataan pembagian waris'));
    
                throw new Exception();
            } catch (\Exception $e) {  
                logger($e->getMessage());
    
                return redirect(route("letters.sk-inheritance-distribution.create"))->with("error", $this->responseMessage->response('surat pernyataan pembagian waris', false));
            }
        } else {
            abort(404);
        }
    }

    public function update(UpdateSkInheritanceDistributionRequest $request, SkInheritanceDistribution $skInheritanceDistribution)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skInheritanceDistribution->update($request->validated(), $skInheritanceDistribution);
            if($update == true) {
                return redirect(route('letters.sk-inheritance-distribution.index'))
                                ->with('success', $this->responseMessage->response('Surat pernyataan pembagian waris', true, 'update'));
            }

            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-inheritance-distribution.edit', $skInheritanceDistribution->id)->with('error', $this->responseMessage->response('surat pernyataan pembagian waris', false, 'update'));
        }
    }

    public function approveLetter(Request $request, SkInheritanceDistribution $skInheritanceDistribution)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skInheritanceDistribution->confirmationLetter($skInheritanceDistribution, true);

            if($update) return redirect(route('letters.sk-inheritance-distribution.show', $skInheritanceDistribution->id))
                                ->with('success', "Surat berhasil disetujui");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-inheritance-distribution.show', $skInheritanceDistribution->id)->with('error', "Surat gagal disetujui");
        }
    }

    public function rejectLetter(Request $request, SkInheritanceDistribution $skInheritanceDistribution)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skInheritanceDistribution->confirmationLetter($skInheritanceDistribution, false, $request->reject_reason);

            if($update) return redirect(route('letters.sk-inheritance-distribution.show', $skInheritanceDistribution->id))
                                ->with('success', "Surat berhasil ditolak");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-inheritance-distribution.show', $skInheritanceDistribution->id)->with('error', "Surat gagal ditolak");
        }
    }

    public function preview(SkInheritanceDistribution $skInheritanceDistribution)
    {
        $skInheritanceDistribution = $this->skInheritanceDistribution->findById($skInheritanceDistribution);
        $subdistrictHead = $this->subdistrictHead->find(1);

        if(auth()->user()->role === Role::ADMIN) abort(404);
        $generated = Pdf::loadView('dashboard.letters.sk-inheritance-distribution.letter-template', 
        [
            'letter' => $skInheritanceDistribution, 
            "user" => auth()->user(), 
            'subdistrictHead' => $subdistrictHead
        ]);        

        return $generated->stream("surat-pernyataan-pembagian-waris-" . $skInheritanceDistribution->sk->citizent->name . ".pdf");
    }
    
    public function download(SkInheritanceDistribution $skInheritanceDistribution, $type = "pdf")
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        $subdistrictHead = $this->subdistrictHead->find(1);
        $generated = Pdf::loadView('dashboard.letters.sk-inheritance-distribution.letter-template', [
            'letter' => $skInheritanceDistribution, 
            "user" => auth()->user(), 
            'subdistrictHead' => $subdistrictHead
        ]);        

        return $generated->download("surat-pernyataan-pembagian-waris-" . $skInheritanceDistribution->sk->citizent->name . ".$type");
    }

    public function destroy(SkInheritanceDistribution $skInheritanceDistribution)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {
            $delete = $this->skInheritanceDistribution->delete($skInheritanceDistribution);  

            if(!isset($delete["status"])) {
                return redirect()->route('letters.sk-inheritance-distribution.index')->with('success', $this->responseMessage->response('Surat pernyataan pembagian waris', true, 'delete'));
            } else if(isset($delete["status"])) {
                return redirect()->route('letters.sk-inheritance-distribution.index')->with('error', $delete["message"]);
            }

            throw new Exception();
        } catch (\Exception $e) {            
            return redirect()->route('letters.sk-inheritance-distribution.index')->with('error', $this->responseMessage->response('surat pernyataan pembagian waris', false, 'delete'));
        }
    }
}
