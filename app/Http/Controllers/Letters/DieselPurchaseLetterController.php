<?php

namespace App\Http\Controllers\Letters;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Letter\DieselPurchaseLetter\UpdateDieselPurchaseRequest;
use App\Http\Requests\Letter\DieselPurchaseLetter\StoreDieselPurchaseRequest;
use App\Models\DieselPurchaseLetter;
use App\Models\Sk;
use App\Repositories\Letters\DieselPurchaseLetterRepository;
use App\Repositories\UserRepository;
use App\Utils\ResponseMessage;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;

class DieselPurchaseLetterController extends Controller
{
    public function __construct(
        protected readonly DieselPurchaseLetterRepository $dieselPurchaseLetter,
        protected readonly UserRepository $user,
        protected readonly ResponseMessage $responseMessage
    ) {}

    public function index(Request $request)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);     
        if(auth()->user()->role === Role::VILLAGE_HEAD) {
            $letters = $this->dieselPurchaseLetter->findLetterByVillageHead();
        } else if(auth()->user()->role === Role::SECTION_HEAD) {
            $letters = $this->dieselPurchaseLetter->findLetterBySectionHead();
        } else if(auth()->user()->role === Role::CITIZENT) {
            $letters = $this->dieselPurchaseLetter->findLetterByCitizent();
        } else if(auth()->user()->role === Role::ENVIRONMENTAL_HEAD) {
            $letters = $this->dieselPurchaseLetter->findLetterByStatus(0);
        } else {
            $letters = $this->dieselPurchaseLetter->findAll();
        }

        return view('dashboard.letters.diesel-purchase.index', compact('letters'));
    }

    public function create()
    { 
        if(auth()->user()->role === Role::ADMIN) abort(404);                                          
        return auth()->user()->role === Role::CITIZENT || auth()->user()->role === Role::SUPER_ADMIN ? 
               view('dashboard.letters.diesel-purchase.crud.create', [
                "citizents" => $this->user->findAllCitizent()
               ]) : 
               abort(404);
    }

    public function show(DieselPurchaseLetter $dieselPurchase)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);                                                   
        $get_letter = $this->dieselPurchaseLetter->findById($dieselPurchase);
        return view('dashboard.letters.diesel-purchase.crud.detail', compact('get_letter'));
    }

    public function edit(DieselPurchaseLetter $dieselPurchase)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);  
        $get_letter = $this->dieselPurchaseLetter->findById($dieselPurchase);                                         
        return view('dashboard.letters.diesel-purchase.crud.edit', [
            "get_letter" => $get_letter,
            "citizents" => $this->user->findAllCitizent()
        ]);
    }

    public function store(StoreDieselPurchaseRequest $request)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);            
        if(auth()->user()->role === Role::CITIZENT || auth()->user()->role === Role::SUPER_ADMIN) {
            try {            
                $store = $this->dieselPurchaseLetter->store($request->validated());            
    
                if($store instanceof Sk) return redirect(route("letters.diesel-purchase.index"))
                                    ->with("success", $this->responseMessage->response('Surat rekomendasi pembelian solar'));
    
                throw new Exception;
            } catch (\Exception $e) {  
                logger($e->getMessage());
    
                return redirect(route("letters.diesel-purchase.create"))->with("error", $this->responseMessage->response('surat rekomendasi pembelian solar', false));
            }
        } else {
            abort(404);
        }
    }

    public function update(UpdateDieselPurchaseRequest $request, DieselPurchaseLetter $dieselPurchase)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->dieselPurchaseLetter->update($request->validated(), $dieselPurchase);
            if($update == true) {
                return redirect(route('letters.diesel-purchase.index'))
                                ->with('success', $this->responseMessage->response('Surat rekomendasi pembelian solar', true, 'update'));
            }

            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.diesel-purchase.edit', $dieselPurchase->id)->with('error', $this->responseMessage->response('surat rekomendasi pembelian solar', false, 'update'));
        }
    }

    public function approveLetter(Request $request, DieselPurchaseLetter $dieselPurchase)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->dieselPurchaseLetter->confirmationLetter($dieselPurchase, true);

            if($update) return redirect(route('letters.diesel-purchase.show', $dieselPurchase->id))
                                ->with('success', "Surat berhasil disetujui");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.diesel-purchase.show', $dieselPurchase->id)->with('error', "Surat gagal disetujui");
        }
    }

    public function rejectLetter(Request $request, DieselPurchaseLetter $dieselPurchase)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->dieselPurchaseLetter->confirmationLetter($dieselPurchase, false);

            if($update) return redirect(route('letters.diesel-purchase.show', $dieselPurchase->id))
                                ->with('success', "Surat berhasil ditolak");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.diesel-purchase.show', $dieselPurchase->id)->with('error', "Surat gagal ditolak");
        }
    }

    public function preview(DieselPurchaseLetter $dieselPurchase)
    {
        $dieselPurchase = $this->dieselPurchaseLetter->findById($dieselPurchase);

        if(auth()->user()->role === Role::ADMIN) abort(404);
        $generated = Pdf::loadView('dashboard.letters.diesel-purchase.letter-template', ['letter' => $dieselPurchase, "user" => auth()->user()]);        

        return $generated->stream("surat-rekomendasi-pembelian-solar-" . $dieselPurchase->sk->citizent->name . ".pdf");
    }
    
    public function download(DieselPurchaseLetter $dieselPurchase, $type = "pdf")
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        $generated = Pdf::loadView('dashboard.letters.diesel-purchase.letter-template', ['letter' => $dieselPurchase]);        

        return $generated->download("surat-rekomendasi-pembelian-solar-" . $dieselPurchase->sk->citizent->name . ".$type");
    }

    public function destroy(DieselPurchaseLetter $dieselPurchase)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {
            $delete = $this->dieselPurchaseLetter->delete($dieselPurchase);  

            if(!isset($delete["status"])) {
                return redirect()->route('letters.diesel-purchase.index')->with('success', $this->responseMessage->response('Surat rekomendasi pembelian solar', true, 'delete'));
            } else if(isset($delete["status"])) {
                return redirect()->route('letters.diesel-purchase.index')->with('error', $delete["message"]);
            }

            throw new Exception;
        } catch (\Exception $e) {            
            return redirect()->route('letters.diesel-purchase.index')->with('error', $this->responseMessage->response('surat rekomendasi pembelian solar', false, 'delete'));
        }
    }
}
