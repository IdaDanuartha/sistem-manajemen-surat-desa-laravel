<?php

namespace App\Repositories;

use App\Enums\Role;
use App\Enums\UserStatus;
use App\Models\Citizent;
use App\Models\EnvironmentalHead;
use App\Models\SectionHead;
use App\Models\User;
use App\Models\VillageHead;
use App\Utils\UploadFile;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class UserRepository
{
  public function __construct(
    protected readonly User $user,
    protected readonly Citizent $citizent,
    protected readonly VillageHead $villageHead,
    protected readonly EnvironmentalHead $environmentalHead,
    protected readonly SectionHead $sectionHead,
    protected readonly UploadFile $uploadFile
  ) {}

  private function getRole($role)
  {
    return match($role) {
      '2' => Role::VILLAGE_HEAD,
      '3' => Role::ENVIRONMENTAL_HEAD,
      '4' => Role::SECTION_HEAD,
      '5' => Role::CITIZENT,
    };
  }

  public function findAllAdmin(): Collection
  {
    return $this->user->latest()->with(['authenticatable'])->where("role", Role::ADMIN)->get();
  }

  public function findAll($except_id = null): Collection
  {
    $query = $this->citizent->latest()->with(['user', 'villageHead', 'environmentalHead', 'sectionHead']);

    if($except_id) {
      $query->whereNot("id", $except_id);
    }

    return $query->get();
  }

  public function findAllStaff()
  {
    return collect([
      $this->villageHead->with(['citizent.user'])->latest()->get(),
      $this->environmentalHead->with(['citizent.user'])->latest()->get(),
      $this->sectionHead->with(['citizent.user'])->latest()->get()
    ]);
  }

  public function findAllCitizent(): Collection
  {
    return $this->citizent->with(['user'])->whereRelation("user", "role", Role::CITIZENT)->latest()->get();
  }

  public function findByFamilyNumber($family_card_number, $except_id): Collection
  {
    return $this->citizent->latest()->where("family_card_number", $family_card_number)->whereNot("id", $except_id)->with(['user', 'villageHead', 'environmentalHead', 'sectionHead'])->get();
  }

  public function findAllPaginate(): LengthAwarePaginator
  {
    return $this->citizent->latest()->with(['user', 'villageHead', 'environmentalHead', 'sectionHead'])->paginate(10);
  }

  public function findById(Citizent $citizent): Citizent
  {
    return $citizent;
  }

  public function store($request): Citizent|VillageHead|EnvironmentalHead|SectionHead|Exception
  {
    DB::beginTransaction();
    try {  
      if (Arr::has($request, 'user.profile_image') && Arr::get($request, 'user.profile_image')) {         
        $filename = $this->uploadFile->uploadSingleFile(Arr::get($request, 'user.profile_image'), "users");
        $request['user']['profile_image'] = $filename;
      }  

      $citizent = $this->citizent->create(Arr::except($request, ['user']));
      if(Arr::get($request, 'user.role') != 5) {
        match(Arr::get($request, 'user.role')) {
          '2' => $this->villageHead->create(['citizent_id' => $citizent->id]),
          '3' => $this->environmentalHead->create(['citizent_id' => $citizent->id]),
          '4' => $this->sectionHead->create(['citizent_id' => $citizent->id]),
        };
      }
      
      $citizent->user()->create([
        'username' => Arr::get($request, 'national_identify_number'),
        'email' => Arr::get($request, 'user.email'),
        'password' => Arr::get($request, 'user.password'),
        'status' => Arr::has($request, 'user.status') ? UserStatus::ACTIVE : UserStatus::NONACTIVE,
        'role' => $this->getRole(Arr::get($request, 'user.role')),
        'profile_image' => Arr::get($request, 'user.profile_image'),
      ]);
    } catch (\Exception $e) {  
      logger($e->getMessage());
      DB::rollBack();
      
      return $e;
    }
    DB::commit();
    return $citizent;
  }

  public function update($request, Citizent $citizent): bool
  {
    DB::beginTransaction();    
    try {              
      if (Arr::has($request, 'user.profile_image') && Arr::get($request, 'user.profile_image')) {
        $this->uploadFile->deleteExistFile("users/$citizent->profile_image");

        $image = Arr::get($request, 'user.profile_image');

        $filename = $this->uploadFile->uploadSingleFile($image, "users");
        $request['user']['profile_image'] = $filename;
      }  
      
      if(Arr::get($request, 'user.status')) $request['user']['status'] = UserStatus::ACTIVE;			
      else $request['user']['status'] = UserStatus::NONACTIVE;			
      
      if(is_null(Arr::get($request, 'user.password'))) Arr::pull($request, 'user.password');			

      $citizent->updateOrFail(Arr::except($request, 'user'));
			$citizent->user->updateOrFail(Arr::get($request, 'user'));

      DB::commit();
      return true;

    } catch (\Exception $e) {  
      logger($e->getMessage());
      DB::rollBack();
      
      return $e;
    }
  }

  public function delete(Citizent $citizent): bool
  {
    DB::beginTransaction();
    try {
      $this->uploadFile->deleteExistFile("users/$citizent->profile_image");

      $citizent->user?->deleteOrFail();
      $delete_citizent = $citizent->deleteOrFail();
    } catch (\Exception $e) {
      logger($e->getMessage());
      DB::rollBack();
      
      return $e;
    }    

    DB::commit();
    return $delete_citizent;
  }
}