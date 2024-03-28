<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAdminRequest;
use App\Http\Requests\Admin\UpdateAdminRequest;
use App\Models\Admin;
use App\Models\User;
use App\Repositories\AdminRepository;
use App\Utils\ResponseMessage;
use Exception;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(
        protected readonly AdminRepository $adminRepository,
        protected readonly ResponseMessage $responseMessage
    ) {}

    public function index(Request $request)
    {     
        if(auth()->user()->role === Role::SUPER_ADMIN) {
            $admins = $this->adminRepository->findAll();
        } else {
            abort(404);
        }
        
        return view('dashboard.users.admins.index', compact('admins'));
    }

    public function create()
    {      
        if(auth()->user()->role === Role::SUPER_ADMIN) {
            return view('dashboard.users.admins.create');
        } else {
            abort(404);
        }                                     
    }

    public function show(Admin $admin)
    {    
        if(auth()->user()->role === Role::SUPER_ADMIN) {
            return view('dashboard.users.admins.detail', compact('admin'));
        } else {
            abort(404);
        }                                               
    }

    public function edit(Admin $admin)
    {      
        if(auth()->user()->role === Role::SUPER_ADMIN) {
            return view('dashboard.users.admins.edit', compact('admin'));
        } else {
            abort(404);
        }                                     
    }

    public function store(StoreAdminRequest $request)
    {        
        try {
            $store = $this->adminRepository->store($request->validated());

            if($store instanceof Admin) {
                return redirect(route("admins.index"))
                            ->with("success", $this->responseMessage->response('Admin'));
            } 
            throw new Exception;
        } catch (\Exception $e) {  
            logger($e->getMessage());

            return redirect(route("admins.create"))->with("error", $this->responseMessage->response('admin', false));
        }
    }

    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        try {                     
            $update = $this->adminRepository->update($request->validated(), $admin);

            if($update) return redirect(route('admins.index'))
                                ->with('success', $this->responseMessage->response('Admin', true, 'update'));
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('admins.edit', $admin->id)->with('error', $this->responseMessage->response('admin', false, 'update'));
        }
    }

    public function destroy(Admin $admin)
    {
        try {
            $this->adminRepository->delete($admin);

            return redirect()->route('admins.index')->with('success', $this->responseMessage->response('Admin', true, 'delete'));
        } catch (\Exception $e) {            
            return redirect()->route('admins.index')->with('error', $this->responseMessage->response('admin', false, 'delete'));
        }
    }
}
