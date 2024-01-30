<?php

namespace App\Repositories;

use App\Enums\Role;
use App\Models\Admin;
use App\Models\Citizent;
use App\Utils\UploadFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class ProfileRepository
{
  public function __construct(
    protected readonly Admin $admin,
    protected readonly Citizent $citizent,
    protected readonly UploadFile $uploadFile
  ) {}

  public function update($request): bool
  {    
    DB::beginTransaction();    
    try {              
      if (Arr::has($request, 'profile_image') && Arr::get($request, 'profile_image')) {
        $this->uploadFile->deleteExistFile("users/" . auth()->user()->authenticatable->profile_image);

        $image = Arr::get($request, 'profile_image');

        $filename = $this->uploadFile->uploadSingleFile($image, "users");
        $request['profile_image'] = $filename;
      }		
      
      if(is_null(Arr::get($request, 'user.password'))) Arr::pull($request, 'user.password');			

      if(auth()->user()->role === Role::ADMIN) {
        $admin = Admin::find(auth()->id());
        $admin->updateOrFail(['name' => Arr::get($request, 'name')]);
        $admin->user->updateOrFail(Arr::get($request, 'user'));
      }
      else {
        $citizent = Citizent::find(auth()->id());
        $citizent->updateOrFail(Arr::except($request, 'user'));
        $citizent->user->updateOrFail(Arr::get($request, 'user'));
      }			

      DB::commit();
      return true;

    } catch (\Exception $e) {  
      logger($e->getMessage());
      DB::rollBack();
      
      return $e;
    }
  }
}