<?php

namespace App\Http\Controllers\Letters;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Letter\SkName\StoreSkNameRequest;
use App\Http\Requests\Letter\SkName\UpdateSkNameRequest;
use App\Models\Sk;
use App\Models\SkNameLetter;
use App\Repositories\Letters\SkNameRepository;
use App\Utils\ResponseMessage;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;

class SkNameController extends Controller
{
    public function __construct(
        protected readonly SkNameRepository $skName,
        protected readonly ResponseMessage $responseMessage
    ) {}

    public function index(Request $request)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);     
        if(auth()->user()->role === Role::VILLAGE_HEAD) {
            $letters = $this->skName->findLetterByVillageHead();
        } else if(auth()->user()->role === Role::SECTION_HEAD) {
            $letters = $this->skName->findLetterBySectionHead();
        } else if(auth()->user()->role === Role::CITIZENT) {
            $letters = $this->skName->findLetterByCitizent();
        } else {
            $letters = $this->skName->findLetterByStatus(0);
        }
        return view('dashboard.letters.sk-name.index', compact('letters'));
    }

    public function create()
    { 
        if(auth()->user()->role === Role::ADMIN) abort(404);                                          
        return auth()->user()->role === Role::CITIZENT ? 
               view('dashboard.letters.sk-name.crud.create') : 
               abort(404);
    }

    public function show(SkNameLetter $skName)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);                                                   
        $get_letter = $this->skName->findById($skName);
        return view('dashboard.letters.sk-name.crud.detail', compact('get_letter'));
    }

    public function edit(SkNameLetter $skName)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);  
        $get_letter = $this->skName->findById($skName);                                         
        return view('dashboard.letters.sk-name.crud.edit', compact('get_letter'));
    }

    public function store(StoreSkNameRequest $request)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);            
        if(auth()->user()->role === Role::CITIZENT) {
            try {            
                $store = $this->skName->store($request->validated());            
    
                if($store instanceof Sk) return redirect(route("letters.sk-name.index"))
                                    ->with("success", $this->responseMessage->response('Surat keterangan beda nama'));
    
                throw new Exception();
            } catch (\Exception $e) {  
                logger($e->getMessage());
    
                return redirect(route("letters.sk-name.create"))->with("error", $this->responseMessage->response('surat keterangan beda nama', false));
            }
        } else {
            abort(404);
        }
    }

    public function update(UpdateSkNameRequest $request, SkNameLetter $skName)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skName->update($request->validated(), $skName);
            if($update == true) {
                return redirect(route('letters.sk-name.index'))
                                ->with('success', $this->responseMessage->response('Surat keterangan beda nama', true, 'update'));
            }

            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-name.edit', $skName->id)->with('error', $this->responseMessage->response('surat keterangan beda nama', false, 'update'));
        }
    }

    public function approveLetter(Request $request, SkNameLetter $skName)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skName->confirmationLetter($skName, true);

            if($update) return redirect(route('letters.sk-name.show', $skName->id))
                                ->with('success', "Surat berhasil disetujui");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-name.show', $skName->id)->with('error', "Surat gagal disetujui");
        }
    }

    public function rejectLetter(Request $request, SkNameLetter $skName)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skName->confirmationLetter($skName, false);

            if($update) return redirect(route('letters.sk-name.show', $skName->id))
                                ->with('success', "Surat berhasil ditolak");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-name.show', $skName->id)->with('error', "Surat gagal ditolak");
        }
    }

    public function preview(SkNameLetter $skName)
    {
        $skName = $this->skName->findById($skName);

        if(auth()->user()->role === Role::ADMIN) abort(404);
        $generated = Pdf::loadView('dashboard.letters.sk-name.letter-template', ['letter' => $skName, "user" => auth()->user()]);        

        return $generated->stream("SK Beda Nama " . $skName->sk->citizent->name . ".pdf");
    }
    
    public function download(SkNameLetter $skName, $type = "pdf")
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        $generated = Pdf::loadView('dashboard.letters.sk-name.letter-template', ['letter' => $skName]);        

        return $generated->download("SK Beda Nama " . $skName->sk->citizent->name . ".$type");
    }

    public function destroy(SkNameLetter $skName)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {
            $delete = $this->skName->delete($skName);  

            if(!isset($delete["status"])) {
                return redirect()->route('letters.sk-name.index')->with('success', $this->responseMessage->response('Surat keterangan beda nama', true, 'delete'));
            } else if(isset($delete["status"])) {
                return redirect()->route('letters.sk-name.index')->with('error', $delete["message"]);
            }

            throw new Exception;
        } catch (\Exception $e) {            
            return redirect()->route('letters.sk-name.index')->with('error', $this->responseMessage->response('surat keterangan beda nama', false, 'delete'));
        }
    }
}
