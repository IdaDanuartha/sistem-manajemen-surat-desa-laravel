<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\Citizent;
use App\Models\EnvironmentalHead;
use App\Models\SectionHead;
use App\Models\VillageHead;
use App\Repositories\UserRepository;
use App\Utils\ResponseMessage;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
        protected readonly UserRepository $userRepository,
        protected readonly ResponseMessage $responseMessage
    ) {}

    public function index(Request $request)
    {     
        $users = $this->userRepository->findAll();
        return view('dashboard.users.index', compact('users'));
    }

    public function create()
    {                                           
        return view('dashboard.users.crud.create');
    }

    public function show(Citizent $user)
    {                                                   
        return view('dashboard.users.crud.detail', compact('user'));
    }

    public function edit(Citizent $user)
    {                                           
        return view('dashboard.users.crud.edit', compact('user'));
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

            return redirect(route("users.create"))->with("error", $this->responseMessage->response('pengguna', false));
        }
    }

    public function update(UpdateUserRequest $request, Citizent $user)
    {
        try {                     
            $update = $this->userRepository->update($request->validated(), $user);

            if($update) return redirect(route('users.index'))
                                ->with('success', $this->responseMessage->response('Pengguna', true, 'update'));
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('users.edit', $user->id)->with('error', $this->responseMessage->response('pengguna', false, 'update'));
        }
    }

    public function destroy(Citizent $user)
    {
        try {
            $this->userRepository->delete($user);

            return redirect()->route('users.index')->with('success', $this->responseMessage->response('Pengguna', true, 'delete'));
        } catch (\Exception $e) {            
            return redirect()->route('users.index')->with('error', $this->responseMessage->response('pengguna', false, 'delete'));
        }
    }
}
