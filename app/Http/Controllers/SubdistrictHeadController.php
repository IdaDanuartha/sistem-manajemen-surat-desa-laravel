<?php

namespace App\Http\Controllers;

use App\Models\SubdistrictHead;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\SubdistrictHeads\StoreSubdistrictHeadRequest;
use App\Http\Requests\User\SubdistrictHeads\UpdateSubdistrictHeadRequest;
use App\Models\SectionHead;
use App\Models\User;
use App\Repositories\SubdistrictHeadRepository;
use App\Utils\ResponseMessage;
use Exception;
use Illuminate\Http\Request;

class SubdistrictHeadController extends Controller
{
    public function __construct(
        protected readonly SubdistrictHeadRepository $subdistrictHead,
        protected readonly User $user,
        protected readonly ResponseMessage $responseMessage
    ) {}

    public function index(Request $request)
    {     
        $users = $this->subdistrictHead->findAll();
        
        return view('dashboard.users.subdistrict-heads.index', compact('users'));
    }

    public function create()
    {           
        return view('dashboard.users.subdistrict-heads.create');                          
    }

    public function show(SubdistrictHead $subdistrictHead)
    {                         
        return view('dashboard.users.subdistrict-heads.detail', compact('subdistrictHead'));
    }

    public function edit(SubdistrictHead $subdistrictHead)
    {                          
        return view('dashboard.users.subdistrict-heads.edit', compact('subdistrictHead'));
    }

    public function store(StoreSubdistrictHeadRequest $request)
    {        
        try {
            $store = $this->subdistrictHead->store($request->validated());

            if($store instanceof SectionHead) {
                return redirect(route("subdistrict-heads.index"))
                            ->with("success", $this->responseMessage->response('Pengguna'));
            } 
            throw new Exception();
        } catch (\Exception $e) {  
            logger($e->getMessage());

            return redirect(route("subdistrict-heads.create"))->with("error", $this->responseMessage->response('pengguna', false));
        }
    }

    public function update(UpdateSubdistrictHeadRequest $request, SubdistrictHead $subdistrictHead)
    {
        try { 
            $update = $this->subdistrictHead->update($request->validated(), $subdistrictHead);

            if($update) {
                return redirect(route('subdistrict-heads.index'))
                            ->with('success', $this->responseMessage->response('Pengguna', true, 'update'));
            }
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('subdistrict-heads.edit', $subdistrictHead->id)->with('error', $this->responseMessage->response('pengguna', false, 'update'));
        }
    }

    public function destroy(SubdistrictHead $subdistrictHead)
    {
        try {
            $this->subdistrictHead->delete($subdistrictHead);

            return redirect()->route('subdistrict-heads.index')->with('success', $this->responseMessage->response('Pengguna', true, 'delete'));
        } catch (\Exception $e) {         
            return redirect()->route('subdistrict-heads.index')->with('error', $this->responseMessage->response('pengguna', false, 'delete'));
        }
    }
}
