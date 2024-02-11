<?php

namespace App\Http\Controllers\Letters;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Letter\SkParentIncome\StoreSkParentIncomeRequest;
use App\Http\Requests\Letter\SkParentIncome\UpdateSkParentIncomeRequest;
use App\Models\Sk;
use App\Models\SkParentIncomeLetter;
use App\Repositories\Letters\SkParentIncomeRepository;
use App\Utils\ResponseMessage;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;

class SkParentIncomeController extends Controller
{
    public function __construct(
        protected readonly SkParentIncomeRepository $skParentIncome,
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
        } else {
            $letters = $this->skParentIncome->findLetterByStatus(0);
        }
        return view('dashboard.letters.sk-parent-income.index', compact('letters'));
    }

    public function create()
    { 
        if(auth()->user()->role === Role::ADMIN) abort(404);                                          
        return auth()->user()->role === Role::CITIZENT ? 
               view('dashboard.letters.sk-parent-income.crud.create') : 
               abort(404);
    }

    public function show(SkParentIncomeLetter $skParentIncome)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);                                                   
        $get_letter = $this->skParentIncome->findById($skParentIncome);
        return view('dashboard.letters.sk-parent-income.crud.detail', compact('get_letter'));
    }

    public function edit(SkParentIncomeLetter $skParentIncome)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);  
        $get_letter = $this->skParentIncome->findById($skParentIncome);                                         
        return view('dashboard.letters.sk-parent-income.crud.edit', compact('get_letter'));
    }

    public function store(StoreSkParentIncomeRequest $request)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);            
        if(auth()->user()->role === Role::CITIZENT) {
            try {            
                $store = $this->skParentIncome->store($request->validated());            
    
                if($store instanceof Sk) return redirect(route("letters.sk-parent-income.index"))
                                    ->with("success", $this->responseMessage->response('Surat keterangan penghasilan orang tua'));
    
                throw new Exception();
            } catch (\Exception $e) {  
                logger($e->getMessage());
    
                return redirect(route("letters.sk-parent-income.create"))->with("error", $this->responseMessage->response('surat keterangan penghasilan orang tua', false));
            }
        } else {
            abort(404);
        }
    }

    public function update(UpdateSkParentIncomeRequest $request, SkParentIncomeLetter $skParentIncome)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skParentIncome->update($request->validated(), $skParentIncome);
            if($update == true) {
                return redirect(route('letters.sk-parent-income.index'))
                                ->with('success', $this->responseMessage->response('Surat keterangan penghasilan orang tua', true, 'update'));
            }

            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-parent-income.edit', $skParentIncome->id)->with('error', $this->responseMessage->response('surat keterangan penghasilan orang tua', false, 'update'));
        }
    }

    public function approveLetter(Request $request, SkParentIncomeLetter $skParentIncome)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skParentIncome->confirmationLetter($skParentIncome, true);

            if($update) return redirect(route('letters.sk-parent-income.show', $skParentIncome->id))
                                ->with('success', "Surat berhasil disetujui");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-parent-income.show', $skParentIncome->id)->with('error', "Surat gagal disetujui");
        }
    }

    public function rejectLetter(Request $request, SkParentIncomeLetter $skParentIncome)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skParentIncome->confirmationLetter($skParentIncome, false);

            if($update) return redirect(route('letters.sk-parent-income.show', $skParentIncome->id))
                                ->with('success', "Surat berhasil ditolak");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-parent-income.show', $skParentIncome->id)->with('error', "Surat gagal ditolak");
        }
    }

    public function preview(SkParentIncomeLetter $skParentIncome)
    {
        $skParentIncome = $this->skParentIncome->findById($skParentIncome);

        if(auth()->user()->role === Role::ADMIN) abort(404);
        $generated = Pdf::loadView('dashboard.letters.sk-parent-income.letter-template', ['letter' => $skParentIncome, "user" => auth()->user()]);        

        return $generated->stream("SK Penghasilan Orang Tua " . $skParentIncome->sk->citizent->name . ".pdf");
    }
    
    public function download(SkParentIncomeLetter $skParentIncome, $type = "pdf")
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        $generated = Pdf::loadView('dashboard.letters.sk-parent-income.letter-template', ['letter' => $skParentIncome]);        

        return $generated->download("SK Penghasilan Orang Tua " . $skParentIncome->sk->citizent->name . ".$type");
    }

    public function destroy(SkParentIncomeLetter $skParentIncome)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {
            $delete = $this->skParentIncome->delete($skParentIncome);  

            if(!isset($delete["status"])) {
                return redirect()->route('letters.sk-parent-income.index')->with('success', $this->responseMessage->response('Surat keterangan penghasilan orang tua', true, 'delete'));
            } else if(isset($delete["status"])) {
                return redirect()->route('letters.sk-parent-income.index')->with('error', $delete["message"]);
            }

            throw new Exception;
        } catch (\Exception $e) {            
            return redirect()->route('letters.sk-parent-income.index')->with('error', $this->responseMessage->response('surat keterangan penghasilan orang tua', false, 'delete'));
        }
    }
}
