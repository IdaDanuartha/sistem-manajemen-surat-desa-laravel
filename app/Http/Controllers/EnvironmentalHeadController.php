<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\EnvironmentalHeads\StoreEnvironmentalHeadRequest;
use App\Http\Requests\User\EnvironmentalHeads\UpdateEnvironmentalHeadRequest;
use App\Models\EnvironmentalHead;
use App\Models\User;
use App\Repositories\EnvironmentalHeadRepository;
use App\Utils\ResponseMessage;
use Exception;
use Illuminate\Http\Request;

class EnvironmentalHeadController extends Controller
{
    public function __construct(
        protected readonly EnvironmentalHeadRepository $environmentalHead,
        protected readonly User $user,
        protected readonly ResponseMessage $responseMessage
    ) {}

    public function index(Request $request)
    {     
        $users = $this->environmentalHead->findAll();
        
        return view('dashboard.users.environmental-heads.index', compact('users'));
    }

    public function create()
    {           
        return view('dashboard.users.environmental-heads.create');                          
    }

    public function show(EnvironmentalHead $environmentalHead)
    {                         
        return view('dashboard.users.environmental-heads.detail', compact('environmentalHead'));
    }

    public function edit(EnvironmentalHead $environmentalHead)
    {                          
        return view('dashboard.users.environmental-heads.edit', compact('environmentalHead'));
    }

    public function store(StoreEnvironmentalHeadRequest $request)
    {        
        try {
            $store = $this->environmentalHead->store($request->validated());

            if($store instanceof EnvironmentalHead) {
                return redirect(route("environmental-heads.index"))
                            ->with("success", $this->responseMessage->response('Pengguna'));
            } 
            throw new Exception();
        } catch (\Exception $e) {  
            logger($e->getMessage());

            return redirect(route("environmental-heads.create"))->with("error", $this->responseMessage->response('pengguna', false));
        }
    }

    public function update(UpdateEnvironmentalHeadRequest $request, EnvironmentalHead $environmentalHead)
    {
        try { 
            $update = $this->environmentalHead->update($request->validated(), $environmentalHead);

            if($update) {
                return redirect(route('environmental-heads.index'))
                            ->with('success', $this->responseMessage->response('Pengguna', true, 'update'));
            }
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('environmental-heads.edit', $environmentalHead->id)->with('error', $this->responseMessage->response('pengguna', false, 'update'));
        }
    }

    public function destroy(EnvironmentalHead $environmentalHead)
    {
        try {
            $this->environmentalHead->delete($environmentalHead);

            return redirect()->route('environmental-heads.index')->with('success', $this->responseMessage->response('Pengguna', true, 'delete'));
        } catch (\Exception $e) {         
            return redirect()->route('environmental-heads.index')->with('error', $this->responseMessage->response('pengguna', false, 'delete'));
        }
    }
}
