<?php

namespace App\Http\Controllers\Letters;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Letter\SkLandPrice\StoreSkLandPriceRequest;
use App\Http\Requests\Letter\SkLandPrice\UpdateSkLandPriceRequest;
use App\Models\Sk;
use App\Models\SkLandPriceLetter;
use App\Repositories\Letters\SkLandPriceRepository;
use App\Utils\ResponseMessage;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;

class SkLandPriceController extends Controller
{
    public function __construct(
        protected readonly SkLandPriceRepository $skLandPrice,
        protected readonly ResponseMessage $responseMessage
    ) {}

    public function index(Request $request)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);     
        if(auth()->user()->role === Role::VILLAGE_HEAD) {
            $letters = $this->skLandPrice->findLetterByVillageHead();
        } else if(auth()->user()->role === Role::SECTION_HEAD) {
            $letters = $this->skLandPrice->findLetterBySectionHead();
        } else if(auth()->user()->role === Role::CITIZENT) {
            $letters = $this->skLandPrice->findLetterByCitizent();
        } else {
            $letters = $this->skLandPrice->findLetterByStatus(0);
        }
        return view('dashboard.letters.sk-land-price.index', compact('letters'));
    }

    public function create()
    { 
        if(auth()->user()->role === Role::ADMIN) abort(404);                                          
        return auth()->user()->role === Role::CITIZENT ? 
               view('dashboard.letters.sk-land-price.crud.create') : 
               abort(404);
    }

    public function show(SkLandPriceLetter $skLandPrice)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);                                                   
        $get_letter = $this->skLandPrice->findById($skLandPrice);
        return view('dashboard.letters.sk-land-price.crud.detail', compact('get_letter'));
    }

    public function edit(SkLandPriceLetter $skLandPrice)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);  
        $get_letter = $this->skLandPrice->findById($skLandPrice);                                         
        return view('dashboard.letters.sk-land-price.crud.edit', compact('get_letter'));
    }

    public function store(StoreSkLandPriceRequest $request)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);            
        if(auth()->user()->role === Role::CITIZENT) {
            try {            
                $store = $this->skLandPrice->store($request->validated());            
    
                if($store instanceof Sk) return redirect(route("letters.sk-land-price.index"))
                                    ->with("success", $this->responseMessage->response('Surat keterangan harga tanah'));
    
                throw new Exception();
            } catch (\Exception $e) {  
                logger($e->getMessage());
    
                return redirect(route("letters.sk-land-price.create"))->with("error", $this->responseMessage->response('surat keterangan harga tanah', false));
            }
        } else {
            abort(404);
        }
    }

    public function update(UpdateSkLandPriceRequest $request, SkLandPriceLetter $skLandPrice)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skLandPrice->update($request->validated(), $skLandPrice);
            if($update == true) {
                return redirect(route('letters.sk-land-price.index'))
                                ->with('success', $this->responseMessage->response('Surat keterangan harga tanah', true, 'update'));
            }

            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-land-price.edit', $skLandPrice->id)->with('error', $this->responseMessage->response('surat keterangan harga tanah', false, 'update'));
        }
    }

    public function approveLetter(Request $request, SkLandPriceLetter $skLandPrice)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skLandPrice->confirmationLetter($skLandPrice, true);

            if($update) return redirect(route('letters.sk-land-price.show', $skLandPrice->id))
                                ->with('success', "Surat berhasil disetujui");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-land-price.show', $skLandPrice->id)->with('error', "Surat gagal disetujui");
        }
    }

    public function rejectLetter(Request $request, SkLandPriceLetter $skLandPrice)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skLandPrice->confirmationLetter($skLandPrice, false);

            if($update) return redirect(route('letters.sk-land-price.show', $skLandPrice->id))
                                ->with('success', "Surat berhasil ditolak");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-land-price.show', $skLandPrice->id)->with('error', "Surat gagal ditolak");
        }
    }

    public function preview(SkLandPriceLetter $skLandPrice)
    {
        $skLandPrice = $this->skLandPrice->findById($skLandPrice);

        if(auth()->user()->role === Role::ADMIN) abort(404);
        $generated = Pdf::loadView('dashboard.letters.sk-land-price.letter-template', ['letter' => $skLandPrice, "user" => auth()->user()]);        

        return $generated->stream("SK Harga Tanah " . $skLandPrice->sk->citizent->name . ".pdf");
    }
    
    public function download(SkLandPriceLetter $skLandPrice, $type = "pdf")
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        $generated = Pdf::loadView('dashboard.letters.sk-land-price.letter-template', ['letter' => $skLandPrice]);        

        return $generated->download("SK Harga Tanah " . $skLandPrice->sk->citizent->name . ".$type");
    }

    public function destroy(SkLandPriceLetter $skLandPrice)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {
            $delete = $this->skLandPrice->delete($skLandPrice);  

            if(!isset($delete["status"])) {
                return redirect()->route('letters.sk-land-price.index')->with('success', $this->responseMessage->response('Surat keterangan harga tanah', true, 'delete'));
            } else if(isset($delete["status"])) {
                return redirect()->route('letters.sk-land-price.index')->with('error', $delete["message"]);
            }

            throw new Exception;
        } catch (\Exception $e) {            
            return redirect()->route('letters.sk-land-price.index')->with('error', $this->responseMessage->response('surat keterangan harga tanah', false, 'delete'));
        }
    }
}
