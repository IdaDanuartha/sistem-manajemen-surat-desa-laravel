<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\VillageHeads\StoreVillageHeadRequest;
use App\Http\Requests\User\VillageHeads\UpdateVillageHeadRequest;
use App\Models\EnvironmentalHead;
use App\Models\User;
use App\Models\VillageHead;
use App\Repositories\VillageHeadRepository;
use App\Utils\ResponseMessage;
use Exception;
use Illuminate\Http\Request;

class VillageHeadController extends Controller
{
    public function __construct(
        protected readonly VillageHeadRepository $villageHead,
        protected readonly User $user,
        protected readonly ResponseMessage $responseMessage
    ) {}

    public function index(Request $request)
    {     
        $users = $this->villageHead->findAll();
        
        return view('dashboard.users.village-heads.index', compact('users'));
    }

    public function create()
    {           
        if(count($this->villageHead->findAll()) == 0) return view('dashboard.users.village-heads.create');
        abort(404);                          
    }

    public function show(VillageHead $villageHead)
    {                         
        return view('dashboard.users.village-heads.detail', compact('villageHead'));
    }

    public function edit(VillageHead $villageHead)
    {                          
        return view('dashboard.users.village-heads.edit', compact('villageHead'));
    }

    public function store(StoreVillageHeadRequest $request)
    {        
        try {
            $store = $this->villageHead->store($request->validated());

            if($store instanceof VillageHead) {
                return redirect(route("village-heads.index"))
                            ->with("success", $this->responseMessage->response('Pengguna'));
            } 
            throw new Exception();
        } catch (\Exception $e) {  
            logger($e->getMessage());

            return redirect(route("village-heads.create"))->with("error", $this->responseMessage->response('pengguna', false));
        }
    }

    public function update(UpdateVillageHeadRequest $request, VillageHead $villageHead)
    {
        try { 
            $update = $this->villageHead->update($request->validated(), $villageHead);

            if($update) {
                return redirect(route('village-heads.index'))
                            ->with('success', $this->responseMessage->response('Pengguna', true, 'update'));
            }
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('village-heads.edit', $villageHead->id)->with('error', $this->responseMessage->response('pengguna', false, 'update'));
        }
    }

    public function destroy(VillageHead $villageHead)
    {
        try {
            $this->villageHead->delete($villageHead);

            return redirect()->route('village-heads.index')->with('success', $this->responseMessage->response('Pengguna', true, 'delete'));
        } catch (\Exception $e) {         
            return redirect()->route('village-heads.index')->with('error', $this->responseMessage->response('pengguna', false, 'delete'));
        }
    }
}
