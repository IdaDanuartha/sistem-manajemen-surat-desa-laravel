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

      if (Arr::has($request, 'id_card_file') && Arr::get($request, 'id_card_file')) {
        $this->uploadFile->deleteExistFile("users/id_cards/" . auth()->user()->authenticatable->id_card_file);

        $image = Arr::get($request, 'id_card_file');

        $filename = $this->uploadFile->uploadSingleFile($image, "users/id_cards");
        $request['id_card_file'] = $filename;
      }		

      if (Arr::has($request, 'family_card_file') && Arr::get($request, 'family_card_file')) {
        $this->uploadFile->deleteExistFile("users/family_cards/" . auth()->user()->authenticatable->family_card_file);

        $image = Arr::get($request, 'family_card_file');

        $filename = $this->uploadFile->uploadSingleFile($image, "users/family_cards");
        $request['family_card_file'] = $filename;
      }	

      if (Arr::has($request, 'birth_certificate_file') && Arr::get($request, 'birth_certificate_file')) {
        $this->uploadFile->deleteExistFile("users/birth_certificates/" . auth()->user()->authenticatable->birth_certificate_file);

        $image = Arr::get($request, 'birth_certificate_file');

        $filename = $this->uploadFile->uploadSingleFile($image, "users/birth_certificates");
        $request['birth_certificate_file'] = $filename;
      }	

      if (Arr::has($request, 'marriage_certificate_file') && Arr::get($request, 'marriage_certificate_file')) {
        $this->uploadFile->deleteExistFile("users/marriage_certificates/" . auth()->user()->authenticatable->marriage_certificate_file);

        $image = Arr::get($request, 'marriage_certificate_file');

        $filename = $this->uploadFile->uploadSingleFile($image, "users/marriage_certificates");
        $request['marriage_certificate_file'] = $filename;
      }	

      if (Arr::has($request, 'land_certificate_file') && Arr::get($request, 'land_certificate_file')) {
        $this->uploadFile->deleteExistFile("users/land_certificates/" . auth()->user()->authenticatable->land_certificate_file);

        $image = Arr::get($request, 'land_certificate_file');

        $filename = $this->uploadFile->uploadSingleFile($image, "users/land_certificates");
        $request['land_certificate_file'] = $filename;
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
        $citizent->updateOrFail(Arr::except($request, ["name", "employee_number", "position", "environmental_id"]));
        $citizent->user->updateOrFail(Arr::get($request, 'user'));
      } else if(auth()->user()->role === Role::ENVIRONMENTAL_HEAD) {
        $environmentalHead = $this->environmentalHead->find(auth()->user()->authenticatable->id);
        $environmentalHead->updateOrFail(Arr::only($request, ["name", "phone_number", "environmental_id"]));
        $environmentalHead->user->updateOrFail(Arr::get($request, 'user'));
      }	else if(auth()->user()->role === Role::SECTION_HEAD) {
        $sectionHead = $this->sectionHead->find(auth()->user()->authenticatable->id);
        $sectionHead->updateOrFail(Arr::only($request, ["name", "employee_number", "position"]));
        $sectionHead->user->updateOrFail(Arr::get($request, 'user'));
      }	else if(auth()->user()->role === Role::VILLAGE_HEAD) {
        $villageHead = $this->villageHead->find(auth()->user()->authenticatable->id);
        $villageHead->updateOrFail(Arr::only($request, ["name", "employee_number"]));
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