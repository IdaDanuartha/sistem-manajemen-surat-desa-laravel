<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\SectionHeads\StoreSectionHeadRequest;
use App\Http\Requests\User\SectionHeads\UpdateSectionHeadRequest;
use App\Models\SectionHead;
use App\Models\User;
use App\Repositories\SectionHeadRepository;
use App\Utils\ResponseMessage;
use Exception;
use Illuminate\Http\Request;

class SectionHeadController extends Controller
{
    public function __construct(
        protected readonly SectionHeadRepository $sectionHead,
        protected readonly User $user,
        protected readonly ResponseMessage $responseMessage
    ) {}

    public function index(Request $request)
    {     
        $users = $this->sectionHead->findAll();
        
        return view('dashboard.users.section-heads.index', compact('users'));
    }

    public function create()
    {           
        return view('dashboard.users.section-heads.create');                          
    }

    public function show(SectionHead $sectionHead)
    {                         
        return view('dashboard.users.section-heads.detail', compact('sectionHead'));
    }

    public function edit(SectionHead $sectionHead)
    {                          
        return view('dashboard.users.section-heads.edit', compact('sectionHead'));
    }

    public function store(StoreSectionHeadRequest $request)
    {        
        try {
            $store = $this->sectionHead->store($request->validated());

            if($store instanceof SectionHead) {
                return redirect(route("section-heads.index"))
                            ->with("success", $this->responseMessage->response('Pengguna'));
            } 
            throw new Exception();
        } catch (\Exception $e) {  
            logger($e->getMessage());

            return redirect(route("section-heads.create"))->with("error", $this->responseMessage->response('pengguna', false));
        }
    }

    public function update(UpdateSectionHeadRequest $request, SectionHead $sectionHead)
    {
        try { 
            $update = $this->sectionHead->update($request->validated(), $sectionHead);

            if($update) {
                return redirect(route('section-heads.index'))
                            ->with('success', $this->responseMessage->response('Pengguna', true, 'update'));
            }
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('section-heads.edit', $sectionHead->id)->with('error', $this->responseMessage->response('pengguna', false, 'update'));
        }
    }

    public function destroy(SectionHead $sectionHead)
    {
        try {
            $this->sectionHead->delete($sectionHead);

            return redirect()->route('section-heads.index')->with('success', $this->responseMessage->response('Pengguna', true, 'delete'));
        } catch (\Exception $e) {         
            return redirect()->route('section-heads.index')->with('error', $this->responseMessage->response('pengguna', false, 'delete'));
        }
    }
}
