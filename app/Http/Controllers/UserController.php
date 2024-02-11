<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\Citizent;
use App\Models\EnvironmentalHead;
use App\Models\SectionHead;
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
        protected readonly AdminRepository $adminRepository,
        protected readonly ResponseMessage $responseMessage
    ) {}

    public function index(Request $request)
    {     
        $admins = [];
        if(auth()->user()->role === Role::SUPER_ADMIN) $admins = $this->adminRepository->findAll();
        $users = $this->userRepository->findAll();
        
        return view('dashboard.users.index', compact('users', 'admins'));
    }

    public function create()
    {                                           
        return view('dashboard.users.crud.create');
    }

    public function show(Citizent $citizent)
    {                                                   
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
                return redirect(route("users.index"))
                            ->with("success", $this->responseMessage->response('Pengguna'));
            } 
            throw new Exception;
        } catch (\Exception $e) {  
            logger($e->getMessage());

            return redirect(route("citizents.create"))->with("error", $this->responseMessage->response('pengguna', false));
        }
    }

    public function update(UpdateUserRequest $request, Citizent $citizent)
    {
        try {                     
            $update = $this->userRepository->update($request->validated(), $citizent);

            if($update) return redirect(route('users.index'))
                                ->with('success', $this->responseMessage->response('Pengguna', true, 'update'));
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('citizents.edit', $citizent->id)->with('error', $this->responseMessage->response('pengguna', false, 'update'));
        }
    }

    public function destroy(Citizent $citizent)
    {
        try {
            $this->userRepository->delete($citizent);

            return redirect()->route('users.index')->with('success', $this->responseMessage->response('Pengguna', true, 'delete'));
        } catch (\Exception $e) {            
            return redirect()->route('users.index')->with('error', $this->responseMessage->response('pengguna', false, 'delete'));
        }
    }
}
