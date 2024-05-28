<?php

namespace App\Http\Controllers\Letters;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Letter\SkParentIncome\StoreSkParentIncomeRequest;
use App\Http\Requests\Letter\SkParentIncome\UpdateSkParentIncomeRequest;
use App\Models\EnvironmentalHead;
use App\Models\Sk;
use App\Models\SkParentIncomeLetter;
use App\Models\SubdistrictHead;
use App\Repositories\CitizentRepository;
use App\Repositories\Letters\SkParentIncomeRepository;
use App\Repositories\UserRepository;
use App\Utils\GenerateReferenceNumber;
use App\Utils\ResponseMessage;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;

class SkParentIncomeController extends Controller
{
    public function __construct(
        protected readonly SkParentIncomeRepository $skParentIncome,
        protected readonly CitizentRepository $citizent,
        protected readonly SubdistrictHead $subdistrictHead,
        protected readonly ResponseMessage $responseMessage
    ) {}

    public function index(Request $request)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);     
        if(auth()->user()->role === Role::VILLAGE_HEAD) {
            $letters = $this->skParentIncome->findLetterByVillageHead();
        } else if(auth()->user()->role === Role::SECTION_HEAD) {
            $letters = $this->skParentIncome->findLetterBySectionHead();
        } else if(auth()->user()->role === Role::CITIZENT) {
            $letters = $this->skParentIncome->findLetterByCitizent();
        } else if(auth()->user()->role === Role::ENVIRONMENTAL_HEAD) {
            $letters = $this->skParentIncome->findLetterByStatus(0);
        } else {
            $letters = $this->skParentIncome->findAll();
        }

        return view('dashboard.letters.sk-parent-income.index', compact('letters'));
    }

    public function create()
    { 
        $reference_number = new GenerateReferenceNumber("", 6);
        $cover_letter_number = new GenerateReferenceNumber("", 1, "", "", "", auth()->user()->authenticatable->environmental->code ?? "---");

        if(auth()->user()->role === Role::ADMIN) abort(404);                                          
        return auth()->user()->role === Role::CITIZENT || auth()->user()->role === Role::SUPER_ADMIN ? 
               view('dashboard.letters.sk-parent-income.crud.create', [
                    // "citizents" => $this->user->findByFamilyNumber(auth()->user()->authenticatable->family_card_number, auth()->user()->authenticatable->id)
                    "citizents" => $this->citizent->findAll(),
                    "reference_number" => $reference_number->generate(),
                    "cover_letter_number" => $cover_letter_number->generateCoverLetter(),
               ]) : 
               abort(404);
    }

    public function show(SkParentIncomeLetter $sk_parent_income)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);                                                   
        $get_letter = $this->skParentIncome->findById($sk_parent_income);
        $environmentalHead = EnvironmentalHead::with("environmental")->whereRelation("environmental", "code", "=", $get_letter->sk->citizent->environmental->code)->first();
        return view('dashboard.letters.sk-parent-income.crud.detail', compact('get_letter', 'environmentalHead'));
    }

    public function edit(SkParentIncomeLetter $sk_parent_income)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);  
        $get_letter = $this->skParentIncome->findById($sk_parent_income);                                         
        return view('dashboard.letters.sk-parent-income.crud.edit', [
            "get_letter" => $get_letter,
            // "citizents" => $this->user->findByFamilyNumber(auth()->user()->authenticatable->family_card_number, auth()->user()->authenticatable->id)
            "citizents" => $this->citizent->findAll()
        ]);
    }

    public function store(StoreSkParentIncomeRequest $request)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);            
        if(auth()->user()->role === Role::CITIZENT || auth()->user()->role === Role::SUPER_ADMIN) {
            try {            
                $store = $this->skParentIncome->store($request->validated());            
    
                if($store instanceof Sk) return redirect(route("letters.sk-parent-income.index"))
                                    ->with("success", $this->responseMessage->response('Surat keterangan penghasilan'));
    
                throw new Exception();
            } catch (\Exception $e) {  
                logger($e->getMessage());
    
                return redirect(route("letters.sk-parent-income.create"))->with("error", $this->responseMessage->response('surat keterangan penghasilan', false));
            }
        } else {
            abort(404);
        }
    }

    public function update(UpdateSkParentIncomeRequest $request, SkParentIncomeLetter $sk_parent_income)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skParentIncome->update($request->validated(), $sk_parent_income);
            if($update == true) {
                return redirect(route('letters.sk-parent-income.index'))
                                ->with('success', $this->responseMessage->response('Surat keterangan penghasilan', true, 'update'));
            }

            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-parent-income.edit', $sk_parent_income->id)->with('error', $this->responseMessage->response('surat keterangan penghasilan', false, 'update'));
        }
    }

    public function approveLetter(Request $request, SkParentIncomeLetter $sk_parent_income)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skParentIncome->confirmationLetter($sk_parent_income, true);

            if($update) return redirect(route('letters.sk-parent-income.show', $sk_parent_income->id))
                                ->with('success', "Surat berhasil disetujui");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-parent-income.show', $sk_parent_income->id)->with('error', "Surat gagal disetujui");
        }
    }

    public function rejectLetter(Request $request, SkParentIncomeLetter $sk_parent_income)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skParentIncome->confirmationLetter($sk_parent_income, false, $request->reject_reason);

            if($update) return redirect(route('letters.sk-parent-income.show', $sk_parent_income->id))
                                ->with('success', "Surat berhasil ditolak");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-parent-income.show', $sk_parent_income->id)->with('error', "Surat gagal ditolak");
        }
    }

    public function preview(SkParentIncomeLetter $sk_parent_income)
    {
        $sk_parent_income = $this->skParentIncome->findById($sk_parent_income);
        $subdistrictHead = $this->subdistrictHead->find(1);

        if(auth()->user()->role === Role::ADMIN) abort(404);
        $generated = Pdf::loadView('dashboard.letters.sk-parent-income.letter-template', ['letter' => $sk_parent_income, "user" => auth()->user(), 'subdistrictHead' => $subdistrictHead]);        

        return $generated->stream("sk-penghasilan-orang-tua-" . $sk_parent_income->sk->citizent->name . ".pdf");
    }
    
    public function download(SkParentIncomeLetter $sk_parent_income, $type = "pdf")
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        $generated = Pdf::loadView('dashboard.letters.sk-parent-income.letter-template', ['letter' => $sk_parent_income]);        

        return $generated->download("sk-penghasilan-orang-tua-" . $sk_parent_income->sk->citizent->name . ".$type");
    }

    public function destroy(SkParentIncomeLetter $sk_parent_income)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {
            $delete = $this->skParentIncome->delete($sk_parent_income);  

            if(!isset($delete["status"])) {
                return redirect()->route('letters.sk-parent-income.index')->with('success', $this->responseMessage->response('Surat keterangan penghasilan', true, 'delete'));
            } else if(isset($delete["status"])) {
                return redirect()->route('letters.sk-parent-income.index')->with('error', $delete["message"]);
            }

            throw new Exception;
        } catch (\Exception $e) {            
            return redirect()->route('letters.sk-parent-income.index')->with('error', $this->responseMessage->response('surat keterangan penghasilan', false, 'delete'));
        }
    }
}
