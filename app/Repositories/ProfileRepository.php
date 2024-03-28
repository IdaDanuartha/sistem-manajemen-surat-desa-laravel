<?php

namespace App\Repositories;

use App\Enums\Role;
use App\Models\Admin;
use App\Models\Citizent;
use App\Models\EnvironmentalHead;
use App\Models\SectionHead;
use App\Models\SuperAdmin;
use App\Models\VillageHead;
use App\Utils\UploadFile;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class ProfileRepository
{
  public function __construct(
    protected readonly SuperAdmin $superAdmin,
    protected readonly Admin $admin,
    protected readonly Citizent $citizent,
    protected readonly EnvironmentalHead $environmentalHead,
    protected readonly SectionHead $sectionHead,
    protected readonly VillageHead $villageHead,
    protected readonly UploadFile $uploadFile
  ) {}

  public function update($request): bool|Exception
  {    
    DB::beginTransaction();    
    try {    
      // if (Arr::has($request, 'user.profile_image') && Arr::get($request, 'user.profile_image')) {
      //   $this->uploadFile->deleteExistFile("users/" . auth()->user()->authenticatable->profile_image);

      //   $image = Arr::get($request, 'user.profile_image');

      //   $filename = $this->uploadFile->uploadSingleFile($image, "users");
      //   $request['user']['profile_image'] = $filename;
      // }		
      if (Arr::has($request, 'user.signature_image') && Arr::get($request, 'user.signature_image')) {
        $this->uploadFile->deleteExistFile("users/signatures/" . auth()->user()->signature_image);

        $image = Arr::get($request, 'user.signature_image');

        $filename = $this->uploadFile->uploadSingleFile($image, "users/signatures");
        $request['user']['signature_image'] = $filename;
      }		
      
      if(is_null(Arr::get($request, 'user.password'))) Arr::pull($request, 'user.password');			

      if(auth()->user()->role === Role::SUPER_ADMIN) {
        $admin = $this->superAdmin->find(auth()->user()->authenticatable->id);
        $admin->updateOrFail(Arr::only($request, "name"));
        $admin->user->updateOrFail(Arr::get($request, 'user'));
      } else if(auth()->user()->role === Role::ADMIN) {
        $admin = $this->admin->find(auth()->user()->authenticatable->id);
        $admin->updateOrFail(Arr::only($request, "name"));
        $admin->user->updateOrFail(Arr::get($request, 'user'));
      } else if(auth()->user()->role === Role::CITIZENT) {
        $citizent = $this->citizent->find(auth()->user()->authenticatable->id);
        $citizent->updateOrFail(Arr::except($request, 'user'));
        $citizent->user->updateOrFail(Arr::get($request, 'user'));
      } else if(auth()->user()->role === Role::ENVIRONMENTAL_HEAD) {
        $environmentalHead = $this->environmentalHead->find(auth()->user()->authenticatable->id);
        $environmentalHead->updateOrFail(Arr::except($request, 'user'));
        $environmentalHead->user->updateOrFail(Arr::get($request, 'user'));
      }	else if(auth()->user()->role === Role::SECTION_HEAD) {
        $sectionHead = $this->sectionHead->find(auth()->user()->authenticatable->id);
        $sectionHead->updateOrFail(Arr::except($request, 'user'));
        $sectionHead->user->updateOrFail(Arr::get($request, 'user'));
      }	else if(auth()->user()->role === Role::VILLAGE_HEAD) {
        $villageHead = $this->villageHead->find(auth()->user()->authenticatable->id);
        $villageHead->updateOrFail(Arr::except($request, 'user'));
        $villageHead->user->updateOrFail(Arr::get($request, 'user'));
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