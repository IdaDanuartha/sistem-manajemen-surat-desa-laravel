<?php

namespace App\Http\Controllers\Letters;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Letter\SkMove\StoreSkMoveRequest;
use App\Http\Requests\Letter\SkMove\UpdateSkMoveRequest;
use App\Models\Sk;
use App\Models\SkMoveLetter;
use App\Repositories\Letters\SkMoveRepository;
use App\Repositories\UserRepository;
use App\Utils\ResponseMessage;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;

class SkMoveController extends Controller
{
    public function __construct(
        protected readonly SkMoveRepository $skMove,
        protected readonly UserRepository $user,
        protected readonly ResponseMessage $responseMessage
    ) {}

    public function index(Request $request)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);     
        if(auth()->user()->role === Role::VILLAGE_HEAD) {
            $letters = $this->skMove->findLetterByVillageHead();
        } else if(auth()->user()->role === Role::SECTION_HEAD) {
            $letters = $this->skMove->findLetterBySectionHead();
        } else if(auth()->user()->role === Role::CITIZENT) {
            $letters = $this->skMove->findLetterByCitizent();
        } else {
            $letters = $this->skMove->findLetterByStatus(0);
        }
        return view('dashboard.letters.sk-move.index', compact('letters'));
    }

    public function create()
    { 
        if(auth()->user()->role === Role::ADMIN) abort(404);                                          
        return auth()->user()->role === Role::CITIZENT ? 
               view('dashboard.letters.sk-move.crud.create', [
                    "citizents" => $this->user->findAll()
               ]) : 
               abort(404);
    }

    public function show(SkMoveLetter $skMove)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);                                                   
        $get_letter = $this->skMove->findById($skMove);
        return view('dashboard.letters.sk-move.crud.detail', compact('get_letter'));
    }

    public function edit(SkMoveLetter $skMove)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);  
        $get_letter = $this->skMove->findById($skMove);                                         
        return view('dashboard.letters.sk-move.crud.edit', [
            "get_letter" => $get_letter,
            "citizents" => $this->user->findAll()
        ]);
    }

    public function store(StoreSkMoveRequest $request)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);            
        if(auth()->user()->role === Role::CITIZENT) {
            try {            
                $store = $this->skMove->store($request->validated());            
    
                if($store instanceof Sk) return redirect(route("letters.sk-move.index"))
                                    ->with("success", $this->responseMessage->response('Surat keterangan pindah'));
    
                throw new Exception();
            } catch (\Exception $e) {  
                logger($e->getMessage());
    
                return redirect(route("letters.sk-move.create"))->with("error", $this->responseMessage->response('surat keterangan pindah', false));
            }
        } else {
            abort(404);
        }
    }

    public function update(UpdateSkMoveRequest $request, SkMoveLetter $skMove)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skMove->update($request->validated(), $skMove);
            if($update == true) {
                return redirect(route('letters.sk-move.index'))
                                ->with('success', $this->responseMessage->response('Surat keterangan pindah', true, 'update'));
            }

            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-move.edit', $skMove->id)->with('error', $this->responseMessage->response('surat keterangan pindah', false, 'update'));
        }
    }

    public function approveLetter(Request $request, SkMoveLetter $skMove)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skMove->confirmationLetter($skMove, true);

            if($update) return redirect(route('letters.sk-move.show', $skMove->id))
                                ->with('success', "Surat berhasil disetujui");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-move.show', $skMove->id)->with('error', "Surat gagal disetujui");
        }
    }

    public function rejectLetter(Request $request, SkMoveLetter $skMove)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->skMove->confirmationLetter($skMove, false);

            if($update) return redirect(route('letters.sk-move.show', $skMove->id))
                                ->with('success', "Surat berhasil ditolak");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.sk-move.show', $skMove->id)->with('error', "Surat gagal ditolak");
        }
    }

    public function preview(SkMoveLetter $skMove)
    {
        $skMove = $this->skMove->findById($skMove);

        if(auth()->user()->role === Role::ADMIN) abort(404);
        $generated = Pdf::loadView('dashboard.letters.sk-move.letter-template', ['letter' => $skMove, "user" => auth()->user()]);        

        return $generated->stream("SK Pindah " . $skMove->sk->citizent->name . ".pdf");
    }
    
    public function download(SkMoveLetter $skMove, $type = "pdf")
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        $generated = Pdf::loadView('dashboard.letters.sk-move.letter-template', ['letter' => $skMove]);        

        return $generated->download("SK Pindah " . $skMove->sk->citizent->name . ".$type");
    }

    public function destroy(SkMoveLetter $skMove)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {
            $delete = $this->skMove->delete($skMove);  

            if(!isset($delete["status"])) {
                return redirect()->route('letters.sk-move.index')->with('success', $this->responseMessage->response('Surat keterangan pindah', true, 'delete'));
            } else if(isset($delete["status"])) {
                return redirect()->route('letters.sk-move.index')->with('error', $delete["message"]);
            }

            throw new Exception;
        } catch (\Exception $e) {            
            return redirect()->route('letters.sk-move.index')->with('error', $this->responseMessage->response('surat keterangan pindah', false, 'delete'));
        }
    }
}
