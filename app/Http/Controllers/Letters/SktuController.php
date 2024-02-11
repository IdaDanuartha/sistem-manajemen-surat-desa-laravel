<?php

namespace App\Http\Controllers\Letters;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Letter\Sktu\StoreSktuRequest;
use App\Http\Requests\Letter\Sktu\UpdateSktuRequest;
use App\Models\Sk;
use App\Models\SktuLetter;
use App\Repositories\Letters\SktuRepository;
use App\Utils\ResponseMessage;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;

class SktuController extends Controller
{
    public function __construct(
        protected readonly SktuRepository $sktu,
        protected readonly ResponseMessage $responseMessage
    ) {}

    public function index(Request $request)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);     
        if(auth()->user()->role === Role::VILLAGE_HEAD) {
            $letters = $this->sktu->findLetterByVillageHead();
        } else if(auth()->user()->role === Role::SECTION_HEAD) {
            $letters = $this->sktu->findLetterBySectionHead();
        } else if(auth()->user()->role === Role::CITIZENT) {
            $letters = $this->sktu->findLetterByCitizent();
        } else {
            $letters = $this->sktu->findLetterByStatus(0);
        }
        return view('dashboard.letters.sktu.index', compact('letters'));
    }

    public function create()
    { 
        if(auth()->user()->role === Role::ADMIN) abort(404);                                          
        return auth()->user()->role === Role::CITIZENT ? 
               view('dashboard.letters.sktu.crud.create') : 
               abort(404);
    }

    public function show(SktuLetter $sktu)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);                                                   
        $get_letter = $this->sktu->findById($sktu);
        return view('dashboard.letters.sktu.crud.detail', compact('get_letter'));
    }

    public function edit(SktuLetter $sktu)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);  
        $get_letter = $this->sktu->findById($sktu);                                         
        return view('dashboard.letters.sktu.crud.edit', compact('get_letter'));
    }

    public function store(StoreSktuRequest $request)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);            
        if(auth()->user()->role === Role::CITIZENT) {
            try {            
                $store = $this->sktu->store($request->validated());            
    
                if($store instanceof Sk) return redirect(route("letters.sktu.index"))
                                    ->with("success", $this->responseMessage->response('Surat keterangan tempat usaha'));
    
                throw new Exception();
            } catch (\Exception $e) {  
                logger($e->getMessage());
    
                return redirect(route("letters.sktu.create"))->with("error", $this->responseMessage->response('surat keterangan tempat usaha', false));
            }
        } else {
            abort(404);
        }
    }

    public function update(UpdateSktuRequest $request, SktuLetter $sktu)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->sktu->update($request->validated(), $sktu);
            if($update == true) {
                return redirect(route('letters.sktu.index'))
                                ->with('success', $this->responseMessage->response('Surat keterangan tempat usaha', true, 'update'));
            }

            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sktu.edit', $sktu->id)->with('error', $this->responseMessage->response('surat keterangan tempat usaha', false, 'update'));
        }
    }

    public function approveLetter(Request $request, SktuLetter $sktu)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->sktu->confirmationLetter($sktu, true);

            if($update) return redirect(route('letters.sktu.show', $sktu->id))
                                ->with('success', "Surat berhasil disetujui");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sktu.show', $sktu->id)->with('error', "Surat gagal disetujui");
        }
    }

    public function rejectLetter(Request $request, SktuLetter $sktu)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->sktu->confirmationLetter($sktu, false);

            if($update) return redirect(route('letters.sktu.show', $sktu->id))
                                ->with('success', "Surat berhasil ditolak");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sktu.show', $sktu->id)->with('error', "Surat gagal ditolak");
        }
    }

    public function preview(SktuLetter $sktu)
    {
        $sktu = $this->sktu->findById($sktu);

        if(auth()->user()->role === Role::ADMIN) abort(404);
        $generated = Pdf::loadView('dashboard.letters.sktu.letter-template', ['letter' => $sktu, "user" => auth()->user()]);        

        return $generated->stream("SKTU " . $sktu->sk->citizent->name . ".pdf");
    }
    
    public function download(SktuLetter $sktu, $type = "pdf")
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        $generated = Pdf::loadView('dashboard.letters.sktu.letter-template', ['letter' => $sktu]);        

        return $generated->download("SKTU " . $sktu->sk->citizent->name . ".$type");
    }

    public function destroy(SktuLetter $sktu)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {
            $delete = $this->sktu->delete($sktu);  

            if(!isset($delete["status"])) {
                return redirect()->route('letters.sktu.index')->with('success', $this->responseMessage->response('Surat keterangan tempat usaha', true, 'delete'));
            } else if(isset($delete["status"])) {
                return redirect()->route('letters.sktu.index')->with('error', $delete["message"]);
            }

            throw new Exception();
        } catch (\Exception $e) {            
            return redirect()->route('letters.sktu.index')->with('error', $this->responseMessage->response('surat keterangan tempat usaha', false, 'delete'));
        }
    }
}
