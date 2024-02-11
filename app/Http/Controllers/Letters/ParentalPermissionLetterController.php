<?php

namespace App\Http\Controllers\Letters;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Letter\ParentalPermissionLetter\StoreParentalPermissionLetterRequest;
use App\Http\Requests\Letter\ParentalPermissionLetter\UpdateParentalPermissionLetterRequest;
use App\Models\ParentalPermissionLetter;
use App\Models\Sk;
use App\Repositories\Letters\ParentalPermissionLetterRepository;
use App\Utils\ResponseMessage;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;

class ParentalPermissionLetterController extends Controller
{
    public function __construct(
        protected readonly ParentalPermissionLetterRepository $parentalPermissionLetter,
        protected readonly ResponseMessage $responseMessage
    ) {}

    public function index(Request $request)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);     
        if(auth()->user()->role === Role::VILLAGE_HEAD) {
            $letters = $this->parentalPermissionLetter->findLetterByVillageHead();
        } else if(auth()->user()->role === Role::SECTION_HEAD) {
            $letters = $this->parentalPermissionLetter->findLetterBySectionHead();
        } else if(auth()->user()->role === Role::CITIZENT) {
            $letters = $this->parentalPermissionLetter->findLetterByCitizent();
        } else {
            $letters = $this->parentalPermissionLetter->findLetterByStatus(0);
        }
        return view('dashboard.letters.parental-permission.index', compact('letters'));
    }

    public function create()
    { 
        if(auth()->user()->role === Role::ADMIN) abort(404);                                          
        return auth()->user()->role === Role::CITIZENT ? 
               view('dashboard.letters.parental-permission.crud.create') : 
               abort(404);
    }

    public function show(ParentalPermissionLetter $parentalPermission)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);                                                   
        $get_letter = $this->parentalPermissionLetter->findById($parentalPermission);
        return view('dashboard.letters.parental-permission.crud.detail', compact('get_letter'));
    }

    public function edit(ParentalPermissionLetter $parentalPermission)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);  
        $get_letter = $this->parentalPermissionLetter->findById($parentalPermission);                                         
        return view('dashboard.letters.parental-permission.crud.edit', compact('get_letter'));
    }

    public function store(StoreParentalPermissionLetterRequest $request)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);            
        if(auth()->user()->role === Role::CITIZENT) {
            try {            
                $store = $this->parentalPermissionLetter->store($request->validated());            
    
                if($store instanceof Sk) return redirect(route("letters.parental-permission.index"))
                                    ->with("success", $this->responseMessage->response('Surat izin orang tua'));
    
                throw new Exception();
            } catch (\Exception $e) {  
                logger($e->getMessage());
    
                return redirect(route("letters.parental-permission.create"))->with("error", $this->responseMessage->response('surat izin orang tua', false));
            }
        } else {
            abort(404);
        }
    }

    public function update(UpdateParentalPermissionLetterRequest $request, ParentalPermissionLetter $parentalPermission)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->parentalPermissionLetter->update($request->validated(), $parentalPermission);
            if($update == true) {
                return redirect(route('letters.parental-permission.index'))
                                ->with('success', $this->responseMessage->response('Surat izin orang tua', true, 'update'));
            }

            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.parental-permission.edit', $parentalPermission->id)->with('error', $this->responseMessage->response('surat izin orang tua', false, 'update'));
        }
    }

    public function approveLetter(Request $request, ParentalPermissionLetter $parentalPermission)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->parentalPermissionLetter->confirmationLetter($parentalPermission, true);

            if($update) return redirect(route('letters.parental-permission.show', $parentalPermission->id))
                                ->with('success', "Surat berhasil disetujui");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.parental-permission.show', $parentalPermission->id)->with('error', "Surat gagal disetujui");
        }
    }

    public function rejectLetter(Request $request, ParentalPermissionLetter $parentalPermission)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->parentalPermissionLetter->confirmationLetter($parentalPermission, false);

            if($update) return redirect(route('letters.parental-permission.show', $parentalPermission->id))
                                ->with('success', "Surat berhasil ditolak");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.parental-permission.show', $parentalPermission->id)->with('error', "Surat gagal ditolak");
        }
    }

    public function preview(ParentalPermissionLetter $parentalPermission)
    {
        $parentalPermission = $this->parentalPermissionLetter->findById($parentalPermission);

        if(auth()->user()->role === Role::ADMIN) abort(404);
        $generated = Pdf::loadView('dashboard.letters.parental-permission.letter-template', ['letter' => $parentalPermission, "user" => auth()->user()]);        

        return $generated->stream("Surat Izin Orang Tua " . $parentalPermission->sk->citizent->name . ".pdf");
    }
    
    public function download(ParentalPermissionLetter $parentalPermission, $type = "pdf")
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        $generated = Pdf::loadView('dashboard.letters.parental-permission.letter-template', ['letter' => $parentalPermission]);        

        return $generated->download("Surat Izin Orang Tua " . $parentalPermission->sk->citizent->name . ".$type");
    }

    public function destroy(ParentalPermissionLetter $parentalPermission)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {
            $delete = $this->parentalPermissionLetter->delete($parentalPermission);  

            if(!isset($delete["status"])) {
                return redirect()->route('letters.parental-permission.index')->with('success', $this->responseMessage->response('Surat izin orang tua', true, 'delete'));
            } else if(isset($delete["status"])) {
                return redirect()->route('letters.parental-permission.index')->with('error', $delete["message"]);
            }

            throw new Exception;
        } catch (\Exception $e) {            
            return redirect()->route('letters.parental-permission.index')->with('error', $this->responseMessage->response('surat izin orang tua', false, 'delete'));
        }
    }
}
