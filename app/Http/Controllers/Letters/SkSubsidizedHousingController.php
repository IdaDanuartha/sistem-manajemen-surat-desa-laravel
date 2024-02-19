<?php

namespace App\Http\Controllers\Letters;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Letter\SkSubsidizedHousing\StoreSkSubsidizedHousingRequest;
use App\Http\Requests\Letter\SkSubsidizedHousing\UpdateSkSubsidizedHousingRequest;
use App\Models\Sk;
use App\Models\SkSubsidizedHousingLetter;
use App\Repositories\Letters\SkSubsidizedHousingRepository;
use App\Repositories\UserRepository;
use App\Utils\GenerateReferenceNumber;
use App\Utils\ResponseMessage;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;

class SkSubsidizedHousingController extends Controller
{
    public function __construct(
        protected readonly SkSubsidizedHousingRepository $skSubsidizedHousing,
        protected readonly SkSubsidizedHousingLetter $letter,
        protected readonly UserRepository $user,
        protected readonly ResponseMessage $responseMessage
    ) {}

    public function index(Request $request)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);     
        if(auth()->user()->role === Role::VILLAGE_HEAD) {
            $letters = $this->skSubsidizedHousing->findLetterByVillageHead();
        } else if(auth()->user()->role === Role::SECTION_HEAD) {
            $letters = $this->skSubsidizedHousing->findLetterBySectionHead();
        } else if(auth()->user()->role === Role::CITIZENT) {
            $letters = $this->skSubsidizedHousing->findLetterByCitizent();
        } else if(auth()->user()->role === Role::ENVIRONMENTAL_HEAD) {
            $letters = $this->skSubsidizedHousing->findLetterByStatus(0);
        } else {
            $letters = $this->skSubsidizedHousing->findAll();
        }

        return view('dashboard.letters.sk-subsidized-housing.index', compact('letters'));
    }

    public function create()
    { 
        $reference_number = new GenerateReferenceNumber("", 1, "Ket");

        if(auth()->user()->role === Role::ADMIN) abort(404);                                          
        return auth()->user()->role === Role::CITIZENT || auth()->user()->role === Role::SUPER_ADMIN ? 
               view('dashboard.letters.sk-subsidized-housing.crud.create', [
                    "citizents" => $this->user->findAllCitizent(),
                    "reference_number" => $reference_number->generate()
               ]) : 
               abort(404);
    }

    public function show(SkSubsidizedHousingLetter $skSubsidizedHousing)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);                                                   
        $get_letter = $this->skSubsidizedHousing->findById($skSubsidizedHousing);
        return view('dashboard.letters.sk-subsidized-housing.crud.detail', compact('get_letter'));
    }

    public function edit(SkSubsidizedHousingLetter $skSubsidizedHousing)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);  
        $get_letter = $this->skSubsidizedHousing->findById($skSubsidizedHousing);                                         
        return view('dashboard.letters.sk-subsidized-housing.crud.edit', [
            "get_letter" => $get_letter,
            "citizents" => $this->user->findAllCitizent()
        ]);
    }

    public function store(StoreSkSubsidizedHousingRequest $request)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);            
        if(auth()->user()->role === Role::CITIZENT || auth()->user()->role === Role::SUPER_ADMIN) {
            try {            
                $store = $this->skSubsidizedHousing->store($request->validated());            
    
                if($store instanceof Sk) return redirect(route("letters.sk-subsidized-housing.index"))
                                    ->with("success", $this->responseMessage->response('Surat keterangan rumah bersubsidi'));
    
                throw new Exception();
            } catch (\Exception $e) {  
                logger($e->getMessage());
    
                return redirect(route("letters.sk-subsidized-housing.create"))->with("error", $this->responseMessage->response('surat keterangan rumah bersubsidi', false));
            }
        } else {
            abort(404);
        }
    }

    public function update(UpdateSkSubsidizedHousingRequest $request, SkSubsidizedHousingLetter $skSubsidizedHousing)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skSubsidizedHousing->update($request->validated(), $skSubsidizedHousing);
            if($update == true) {
                return redirect(route('letters.sk-subsidized-housing.index'))
                                ->with('success', $this->responseMessage->response('Surat keterangan rumah bersubsidi', true, 'update'));
            }

            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-subsidized-housing.edit', $skSubsidizedHousing->id)->with('error', $this->responseMessage->response('surat keterangan rumah bersubsidi', false, 'update'));
        }
    }

    public function approveLetter(Request $request, SkSubsidizedHousingLetter $skSubsidizedHousing)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skSubsidizedHousing->confirmationLetter($skSubsidizedHousing, true);

            if($update) return redirect(route('letters.sk-subsidized-housing.show', $skSubsidizedHousing->id))
                                ->with('success', "Surat berhasil disetujui");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-subsidized-housing.show', $skSubsidizedHousing->id)->with('error', "Surat gagal disetujui");
        }
    }

    public function rejectLetter(Request $request, SkSubsidizedHousingLetter $skSubsidizedHousing)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skSubsidizedHousing->confirmationLetter($skSubsidizedHousing, false);

            if($update) return redirect(route('letters.sk-subsidized-housing.show', $skSubsidizedHousing->id))
                                ->with('success', "Surat berhasil ditolak");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-subsidized-housing.show', $skSubsidizedHousing->id)->with('error', "Surat gagal ditolak");
        }
    }

    public function preview(SkSubsidizedHousingLetter $skSubsidizedHousing)
    {
        $skSubsidizedHousing = $this->skSubsidizedHousing->findById($skSubsidizedHousing);

        if(auth()->user()->role === Role::ADMIN) abort(404);
        $generated = Pdf::loadView('dashboard.letters.sk-subsidized-housing.letter-template', ['letter' => $skSubsidizedHousing, "user" => auth()->user()]);        

        return $generated->stream("sk-rumah-bersubsidi-" . $skSubsidizedHousing->sk->citizent->name . ".pdf");
    }
    
    public function download(SkSubsidizedHousingLetter $skSubsidizedHousing, $type = "pdf")
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        $generated = Pdf::loadView('dashboard.letters.sk-subsidized-housing.letter-template', ['letter' => $skSubsidizedHousing]);        

        return $generated->download("sk-rumah-bersubsidi-" . $skSubsidizedHousing->sk->citizent->name . ".$type");
    }

    public function destroy(SkSubsidizedHousingLetter $skSubsidizedHousing)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {
            $delete = $this->skSubsidizedHousing->delete($skSubsidizedHousing);  

            if(!isset($delete["status"])) {
                return redirect()->route('letters.sk-subsidized-housing.index')->with('success', $this->responseMessage->response('Surat keterangan rumah bersubsidi', true, 'delete'));
            } else if(isset($delete["status"])) {
                return redirect()->route('letters.sk-subsidized-housing.index')->with('error', $delete["message"]);
            }

            throw new Exception();
        } catch (\Exception $e) {            
            return redirect()->route('letters.sk-subsidized-housing.index')->with('error', $this->responseMessage->response('surat keterangan rumah bersubsidi', false, 'delete'));
        }
    }
}
