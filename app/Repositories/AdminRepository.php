<?php

namespace App\Repositories;

use App\Enums\Role;
use App\Enums\UserStatus;
use App\Models\Admin;
use App\Models\User;
use App\Utils\UploadFile;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class AdminRepository
{
  public function __construct(
    protected readonly User $user,
    protected readonly Admin $admin,
    protected readonly UploadFile $uploadFile
  ) {}

  public function findAll(): Collection
  {
    return $this->admin->latest()->with(['user'])->get();
  }

  public function findAllPaginate(): LengthAwarePaginator
  {
    return $this->admin->latest()->with(['user'])->paginate(10);
  }

  public function findById(Admin $admin): Admin
  {
    return $admin;
  }

  public function store($request): Admin|Exception
  {
    DB::beginTransaction();
    try {  
      if (Arr::has($request, 'user.profile_image') && Arr::get($request, 'user.profile_image')) {         
        $filename = $this->uploadFile->uploadSingleFile(Arr::get($request, "user.profile_image"), "users");
        $request['user']['profile_image'] = $filename;
      }  

      $admin = $this->admin->create(Arr::only($request, "name"));
      
      $admin->user()->create([
        'username' => Arr::get($request, 'user.username'),
        'email' => Arr::get($request, 'user.email'),
        'password' => Arr::get($request, 'user.password'),
        'status' => Arr::has($request, 'user.status') ? UserStatus::ACTIVE : UserStatus::NONACTIVE,
        'role' => Role::ADMIN,
        'profile_image' => Arr::get($request, 'user.profile_image'),
      ]);
    } catch (\Exception $e) {  
      logger($e->getMessage());
      DB::rollBack();
      
      return $e;
    }
    DB::commit();
    return $admin;
  }

  public function update($request, Admin $admin): bool
  {
    DB::beginTransaction();    
    try {              
      if (Arr::has($request, 'user.profile_image') && Arr::get($request, 'user.profile_image')) {
        $this->uploadFile->deleteExistFile("users/" . $admin->user->profile_image);

        $image = Arr::get($request, 'user.profile_image');

        $filename = $this->uploadFile->uploadSingleFile($image, "users");
        $request['user']['profile_image'] = $filename;
      }  
      
      if(Arr::get($request, 'user.status')) $request['user']['status'] = UserStatus::ACTIVE;			
      else $request['user']['status'] = UserStatus::NONACTIVE;			
      
      if(is_null(Arr::get($request, 'user.password'))) Arr::pull($request, 'user.password');			

      $admin->updateOrFail(Arr::only($request, 'name'));
      $admin->user->updateOrFail(Arr::get($request, 'user'));

      DB::commit();
      return true;

    } catch (\Exception $e) {  
      logger($e->getMessage());
      DB::rollBack();
      
      return $e;
    }
  }

  public function delete(Admin $admin): bool
  {
    DB::beginTransaction();
    try {
      $this->uploadFile->deleteExistFile("users/" . $admin->user->profile_image);

      $admin->user?->deleteOrFail();
      $delete_admin = $admin->deleteOrFail();
    } catch (\Exception $e) {
      logger($e->getMessage());
      DB::rollBack();
      
      return $e;
    }    

    DB::commit();
    return $delete_admin;
  }
}