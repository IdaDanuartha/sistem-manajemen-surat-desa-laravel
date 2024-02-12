<?php

namespace App\Http\Controllers\Letters;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Letter\TreeFellingLetter\StoreTreeFellingRequest;
use App\Http\Requests\Letter\TreeFellingLetter\UpdateTreeFellingRequest;
use App\Models\Sk;
use App\Models\TreeFellingLetter;
use App\Repositories\Letters\TreeFellingLetterRepository;
use App\Utils\ResponseMessage;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;

class TreeFellingLetterController extends Controller
{
    public function __construct(
        protected readonly TreeFellingLetterRepository $treeFelling,
        protected readonly ResponseMessage $responseMessage
    ) {}

    public function index(Request $request)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);     
        if(auth()->user()->role === Role::VILLAGE_HEAD) {
            $letters = $this->treeFelling->findLetterByVillageHead();
        } else if(auth()->user()->role === Role::SECTION_HEAD) {
            $letters = $this->treeFelling->findLetterBySectionHead();
        } else if(auth()->user()->role === Role::CITIZENT) {
            $letters = $this->treeFelling->findLetterByCitizent();
        } else {
            $letters = $this->treeFelling->findLetterByStatus(0);
        }
        return view('dashboard.letters.tree-felling.index', compact('letters'));
    }

    public function create()
    { 
        if(auth()->user()->role === Role::ADMIN) abort(404);                                          
        return auth()->user()->role === Role::CITIZENT ? 
               view('dashboard.letters.tree-felling.crud.create') : 
               abort(404);
    }

    public function show(TreeFellingLetter $treeFelling)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);                                                   
        $get_letter = $this->treeFelling->findById($treeFelling);
        return view('dashboard.letters.tree-felling.crud.detail', compact('get_letter'));
    }

    public function edit(TreeFellingLetter $treeFelling)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);  
        $get_letter = $this->treeFelling->findById($treeFelling);                                         
        return view('dashboard.letters.tree-felling.crud.edit', compact('get_letter'));
    }

    public function store(StoreTreeFellingRequest $request)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);            
        if(auth()->user()->role === Role::CITIZENT) {
            try {            
                $store = $this->treeFelling->store($request->validated());            
    
                if($store instanceof Sk) return redirect(route("letters.tree-felling.index"))
                                    ->with("success", $this->responseMessage->response('Surat Penebangan Pohon'));
    
                throw new Exception();
            } catch (\Exception $e) {  
                logger($e->getMessage());
    
                return redirect(route("letters.tree-felling.create"))->with("error", $this->responseMessage->response('surat Penebangan Pohon', false));
            }
        } else {
            abort(404);
        }
    }

    public function update(UpdateTreeFellingRequest $request, TreeFellingLetter $treeFelling)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->treeFelling->update($request->validated(), $treeFelling);
            if($update == true) {
                return redirect(route('letters.tree-felling.index'))
                                ->with('success', $this->responseMessage->response('Surat Penebangan Pohon', true, 'update'));
            }

            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.tree-felling.edit', $treeFelling->id)->with('error', $this->responseMessage->response('surat Penebangan Pohon', false, 'update'));
        }
    }

    public function approveLetter(Request $request, TreeFellingLetter $treeFelling)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->treeFelling->confirmationLetter($treeFelling, true);

            if($update) return redirect(route('letters.tree-felling.show', $treeFelling->id))
                                ->with('success', "Surat berhasil disetujui");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.tree-felling.show', $treeFelling->id)->with('error', "Surat gagal disetujui");
        }
    }

    public function rejectLetter(Request $request, TreeFellingLetter $treeFelling)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {                     
            $update = $this->treeFelling->confirmationLetter($treeFelling, false);

            if($update) return redirect(route('letters.tree-felling.show', $treeFelling->id))
                                ->with('success', "Surat berhasil ditolak");            
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('letters.tree-felling.show', $treeFelling->id)->with('error', "Surat gagal ditolak");
        }
    }

    public function preview(TreeFellingLetter $treeFelling)
    {
        $treeFelling = $this->treeFelling->findById($treeFelling);

        if(auth()->user()->role === Role::ADMIN) abort(404);
        $generated = Pdf::loadView('dashboard.letters.tree-felling.letter-template', ['letter' => $treeFelling, "user" => auth()->user()]);        

        return $generated->stream("Surat Penebangan Pohon " . $treeFelling->sk->citizent->name . ".pdf");
    }
    
    public function download(TreeFellingLetter $treeFelling, $type = "pdf")
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        $generated = Pdf::loadView('dashboard.letters.tree-felling.letter-template', ['letter' => $treeFelling]);        

        return $generated->download("Surat Penebangan Pohon " . $treeFelling->sk->citizent->name . ".$type");
    }

    public function destroy(TreeFellingLetter $treeFelling)
    {
        if(auth()->user()->role === Role::ADMIN) abort(404);
        try {
            $delete = $this->treeFelling->delete($treeFelling);  

            if(!isset($delete["status"])) {
                return redirect()->route('letters.tree-felling.index')->with('success', $this->responseMessage->response('Surat Penebangan Pohon', true, 'delete'));
            } else if(isset($delete["status"])) {
                return redirect()->route('letters.tree-felling.index')->with('error', $delete["message"]);
            }

            throw new Exception();
        } catch (\Exception $e) {            
            return redirect()->route('letters.tree-felling.index')->with('error', $this->responseMessage->response('surat Penebangan Pohon', false, 'delete'));
        }
    }
}
