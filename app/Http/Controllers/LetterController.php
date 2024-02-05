<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Http\Requests\Letter\StoreLetterRequest;
use App\Http\Requests\Letter\UpdateLetterRequest;
use App\Models\Letter;
use App\Repositories\LetterRepository;
use App\Utils\ResponseMessage;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;

class LetterController extends Controller
{
    public function __construct(
        protected readonly LetterRepository $letterRepository,
        protected readonly ResponseMessage $responseMessage
    ) {}

    public function index(Request $request)
    {     
        if(auth()->user()->role === Role::VILLAGE_HEAD) {
            $letters = $this->letterRepository->findLetterByVillageHead();
        } else if(auth()->user()->role === Role::SECTION_HEAD) {
            $letters = $this->letterRepository->findLetterBySectionHead();
        } else if(auth()->user()->role === Role::CITIZENT) {
            $letters = $this->letterRepository->findLetterByCitizent();
        } else {
            $letters = $this->letterRepository->findAll();
        }
        return view('dashboard.letters.index', compact('letters'));
    }

    public function create()
    {                                           
        return auth()->user()->role === Role::CITIZENT ? 
               view('dashboard.letters.crud.create') : 
               abort(404);
    }

    public function show(Letter $letter)
    {                                                   
        $get_letter = $this->letterRepository->findById($letter);
        return view('dashboard.letters.crud.detail', compact('get_letter'));
    }

    public function edit(Letter $letter)
    {                                           
        return view('dashboard.letters.crud.edit', compact('letter'));
    }

    public function store(StoreLetterRequest $request)
    {            
        if(auth()->user()->role === Role::CITIZENT) {
            try {            
                $store = $this->letterRepository->store($request->validated());            
    
                if($store instanceof Letter) return redirect(route("letters.index"))
                                    ->with("success", $this->responseMessage->response('Surat'));
    
                throw new Exception;
            } catch (\Exception $e) {  
                logger($e->getMessage());
    
                return redirect(route("letters.create"))->with("error", $this->responseMessage->response('surat', false));
            }
        } else {
            abort(404);
        }
    }

    public function update(UpdateLetterRequest $request, Letter $letter)
    {
        try {                     
            $update = $this->letterRepository->update($request->validated(), $letter);
            if($update == true) {
                return redirect(route('letters.index'))
                                ->with('success', $this->responseMessage->response('Surat', true, 'update'));
            }
            // else if(isset($update["status"])) {
            //     return redirect()->route('letters.index')->with('error', $update["message"]);
            // }

            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.edit', $letter->id)->with('error', $this->responseMessage->response('surat', false, 'update'));
        }
    }

    // public function addSignatureToLetter(Request $request, Letter $letter)
    // {
    //     try {                     
    //         $update = $this->letterRepository->addSignature($request->signature_image, $letter);

    //         if($update) return redirect(route('letters.show', $letter->id))
    //                             ->with('success', $this->responseMessage->response('Surat', true, 'update'));            
    //         throw new Exception;
    //     } catch (\Exception $e) {
    //         return redirect()->route('letters.show', $letter->id)->with('error', $this->responseMessage->response('surat', false, 'update'));
    //     }
    // }

    public function approveLetter(Request $request, Letter $letter)
    {
        try {                     
            $update = $this->letterRepository->updateLetterStatus($letter);

            if($update) return redirect(route('letters.show', $letter->id))
                                ->with('success', "Surat berhasil disetujui");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.show', $letter->id)->with('error', "Surat gagal disetujui");
        }
    }

    public function preview(Letter $letter)
    {
        $generated = Pdf::loadView('dashboard.letters.letter-template', ['letter' => $letter]);        

        return $generated->stream();
    }

    public function destroy(Letter $letter)
    {
        try {
            $delete = $this->letterRepository->delete($letter);  

            if(!isset($delete["status"])) {
                return redirect()->route('letters.index')->with('success', $this->responseMessage->response('Surat', true, 'delete'));
            } else if(isset($delete["status"])) {
                return redirect()->route('letters.index')->with('error', $delete["message"]);
            }

            throw new Exception;
        } catch (\Exception $e) {            
            return redirect()->route('letters.index')->with('error', $this->responseMessage->response('surat', false, 'delete'));
        }
    }
}
