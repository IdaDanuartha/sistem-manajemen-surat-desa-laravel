<?php

namespace App\Http\Controllers\Letters;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Letter\SkTraveling\StoreSkTravelingRequest;
use App\Http\Requests\Letter\SkTraveling\UpdateSkTravelingRequest;
use App\Models\Sk;
use App\Models\SkTravelingLetter;
use App\Repositories\Letters\SkTravelingRepository;
use App\Utils\ResponseMessage;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;

class SkTravellingController extends Controller
{
    public function __construct(
        protected readonly SkTravelingRepository $skTraveling,
        protected readonly ResponseMessage $responseMessage
    ) {}

    public function index(Request $request)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);     
        if(auth()->user()->role === Role::VILLAGE_HEAD) {
            $letters = $this->skTraveling->findLetterByVillageHead();
        } else if(auth()->user()->role === Role::SECTION_HEAD) {
            $letters = $this->skTraveling->findLetterBySectionHead();
        } else if(auth()->user()->role === Role::CITIZENT) {
            $letters = $this->skTraveling->findLetterByCitizent();
        } else {
            $letters = $this->skTraveling->findLetterByStatus(0);
        }
        return view('dashboard.letters.sk-traveling.index', compact('letters'));
    }

    public function create()
    { 
        if(auth()->user()->role === Role::ADMIN) abort(404);                                          
        return auth()->user()->role === Role::CITIZENT ? 
               view('dashboard.letters.sk-traveling.crud.create') : 
               abort(404);
    }

    public function show(SkTravelingLetter $skTraveling)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);                                                   
        $get_letter = $this->skTraveling->findById($skTraveling);
        return view('dashboard.letters.sk-traveling.crud.detail', compact('get_letter'));
    }

    public function edit(SkTravelingLetter $skTraveling)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);  
        $get_letter = $this->skTraveling->findById($skTraveling);                                         
        return view('dashboard.letters.sk-traveling.crud.edit', compact('get_letter'));
    }

    public function store(StoreSkTravelingRequest $request)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);            
        if(auth()->user()->role === Role::CITIZENT) {
            try {            
                $store = $this->skTraveling->store($request->validated());            
    
                if($store instanceof Sk) return redirect(route("letters.sk-traveling.index"))
                                    ->with("success", $this->responseMessage->response('Surat keterangan bepergian'));
    
                throw new Exception();
            } catch (\Exception $e) {  
                logger($e->getMessage());
    
                return redirect(route("letters.sk-traveling.create"))->with("error", $this->responseMessage->response('surat keterangan bepergian', false));
            }
        } else {
            abort(404);
        }
    }

    public function update(UpdateSkTravelingRequest $request, SkTravelingLetter $skTraveling)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skTraveling->update($request->validated(), $skTraveling);
            if($update == true) {
                return redirect(route('letters.sk-traveling.index'))
                                ->with('success', $this->responseMessage->response('Surat keterangan bepergian', true, 'update'));
            }

            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-traveling.edit', $skTraveling->id)->with('error', $this->responseMessage->response('surat keterangan bepergian', false, 'update'));
        }
    }

    public function approveLetter(Request $request, SkTravelingLetter $skTraveling)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skTraveling->confirmationLetter($skTraveling, true);

            if($update) return redirect(route('letters.sk-traveling.show', $skTraveling->id))
                                ->with('success', "Surat berhasil disetujui");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-traveling.show', $skTraveling->id)->with('error', "Surat gagal disetujui");
        }
    }

    public function rejectLetter(Request $request, SkTravelingLetter $skTraveling)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skTraveling->confirmationLetter($skTraveling, false);

            if($update) return redirect(route('letters.sk-traveling.show', $skTraveling->id))
                                ->with('success', "Surat berhasil ditolak");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-traveling.show', $skTraveling->id)->with('error', "Surat gagal ditolak");
        }
    }

    public function preview(SkTravelingLetter $skTraveling)
    {
        $skTraveling = $this->skTraveling->findById($skTraveling);

        if(auth()->user()->role === Role::ADMIN) abort(404);
        $generated = Pdf::loadView('dashboard.letters.sk-traveling.letter-template', ['letter' => $skTraveling, "user" => auth()->user()]);        

        return $generated->stream("SK Bepergian " . $skTraveling->sk->citizent->name . ".pdf");
    }
    
    public function download(SkTravelingLetter $skTraveling, $type = "pdf")
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        $generated = Pdf::loadView('dashboard.letters.sk-traveling.letter-template', ['letter' => $skTraveling]);        

        return $generated->download("SK Bepergian " . $skTraveling->sk->citizent->name . ".$type");
    }

    public function destroy(SkTravelingLetter $skTraveling)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {
            $delete = $this->skTraveling->delete($skTraveling);  

            if(!isset($delete["status"])) {
                return redirect()->route('letters.sk-traveling.index')->with('success', $this->responseMessage->response('Surat keterangan bepergian', true, 'delete'));
            } else if(isset($delete["status"])) {
                return redirect()->route('letters.sk-traveling.index')->with('error', $delete["message"]);
            }

            throw new Exception();
        } catch (\Exception $e) {            
            return redirect()->route('letters.sk-traveling.index')->with('error', $this->responseMessage->response('surat keterangan bepergian', false, 'delete'));
        }
    }
}
