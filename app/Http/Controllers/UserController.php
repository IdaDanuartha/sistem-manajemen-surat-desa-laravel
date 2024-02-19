<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\Citizent;
use App\Models\EnvironmentalHead;
use App\Models\SectionHead;
use App\Models\User;
use App\Models\VillageHead;
use App\Repositories\AdminRepository;
use App\Repositories\UserRepository;
use App\Utils\ResponseMessage;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
        protected readonly UserRepository $userRepository,
        protected readonly User $user,
        protected readonly ResponseMessage $responseMessage
    ) {}

    public function index(Request $request)
    {     
        if(request()->route()->getName() === "staff.index") $users = $this->userRepository->findAllStaff();
        else $users = $this->userRepository->findAllCitizent();
        
        return view('dashboard.users.index-citizent', compact('users'));
    }

    public function create()
    {                                           
        return view('dashboard.users.crud.create');
    }

    public function show(Citizent $citizent)
    {          
        // if($citizent->villageHead) {
        //     $citizent = $this->user->where("role", Role::VILLAGE_HEAD)->first();
        // } else if($citizent->environmentalHead) {
        //     $citizent = $this->user->where("role", Role::ENVIRONMENTAL_HEAD)->first();
        // } else if($citizent->sectionHead) {
        //     $citizent = $this->user->where("role", Role::SECTION_HEAD)->first();
        // } else {
        //     $citizent = $this->user->with("authenticatable")->where("role", Role::CITIZENT)->whereRelation("authenticatable", "id", $citizent->id)->first();  
        // }

        // dd($citizent->user);
                                                 
        return view('dashboard.users.crud.detail', compact('citizent'));
    }

    public function edit(Citizent $citizent)
    {                          
        return view('dashboard.users.crud.edit', compact('citizent'));
    }

    public function store(StoreUserRequest $request)
    {        
        try {
            $store = $this->userRepository->store($request->validated());

            if($store instanceof Citizent ||
            $store instanceof VillageHead ||
            $store instanceof EnvironmentalHead ||
            $store instanceof SectionHead) {
                if(request()->route()->getName() === "staff.store") {
                    return redirect(route("staff.index"))
                            ->with("success", $this->responseMessage->response('Pengguna'));
                } else {
                    return redirect(route("citizents.index"))
                            ->with("success", $this->responseMessage->response('Pengguna'));
                }
            } 
            throw new Exception;
        } catch (\Exception $e) {  
            logger($e->getMessage());

            if(request()->route()->getName() === "staff.store") {
                return redirect(route("staff.create"))->with("error", $this->responseMessage->response('pengguna', false));
            } else {
                return redirect(route("citizents.create"))->with("error", $this->responseMessage->response('pengguna', false));
            }
        }
    }

    public function update(UpdateUserRequest $request, Citizent $citizent)
    {
        try { 
            $update = $this->userRepository->update($request->validated(), $citizent);

            if($update) {
                if(request()->route()->getName() === "staff.update") {
                    return redirect(route('staff.index'))
                                ->with('success', $this->responseMessage->response('Pengguna', true, 'update'));
                } else {
                    return redirect(route('citizents.index'))
                                ->with('success', $this->responseMessage->response('Pengguna', true, 'update'));
                }
            }
            throw new Exception;
        } catch (\Exception $e) {
            if(request()->route()->getName() === "staff.update") {
                return redirect()->route('staff.edit', $citizent->id)->with('error', $this->responseMessage->response('pengguna', false, 'update'));
            } else {
                return redirect()->route('citizents.edit', $citizent->id)->with('error', $this->responseMessage->response('pengguna', false, 'update'));
            }
        }
    }

    public function destroy(Citizent $citizent)
    {
        try {
            $this->userRepository->delete($citizent);

            if(request()->route()->getName() === "staff.destroy") {
                return redirect()->route('staff.index')->with('success', $this->responseMessage->response('Pengguna', true, 'delete'));
            } else {
                return redirect()->route('citizents.index')->with('success', $this->responseMessage->response('Pengguna', true, 'delete'));
            }
        } catch (\Exception $e) {    
            if(request()->route()->getName() === "staff.destroy") {
                return redirect()->route('staff.index')->with('error', $this->responseMessage->response('pengguna', false, 'delete'));
            } else {
                return redirect()->route('citizents.index')->with('error', $this->responseMessage->response('pengguna', false, 'delete'));
            }        
        }
    }
}
