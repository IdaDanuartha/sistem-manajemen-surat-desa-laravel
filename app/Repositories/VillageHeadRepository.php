<?php

namespace App\Repositories;

use App\Enums\Role;
use App\Enums\UserStatus;
use App\Models\User;
use App\Models\VillageHead;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class VillageHeadRepository
{
  public function __construct(
    protected readonly User $user,
    protected readonly VillageHead $villageHead,
  ) {}

  public function findAll($except_id = null): Collection
  {
    $query = $this->villageHead->latest()->with(['user']);

    if($except_id) {
      $query->whereNot("id", $except_id);
    }

    return $query->get();
  }

  public function findAllPaginate(): LengthAwarePaginator
  {
    return $this->villageHead->latest()->with(['user'])->paginate(10);
  }

  public function findById(VillageHead $villageHead): VillageHead
  {
    return $this->villageHead->with("user")->find($villageHead->id);
  }

  public function store($request): VillageHead|Exception
  {
    DB::beginTransaction();
    try {
      $villageHead = $this->villageHead->create(Arr::except($request, ['user']));
      
      $villageHead->user()->create([
        'username' => Arr::get($request, 'national_identify_number'),
        'email' => Arr::get($request, 'user.email'),
        'password' => Arr::get($request, 'user.password'),
        'status' => Arr::has($request, 'user.status') ? UserStatus::ACTIVE : UserStatus::NONACTIVE,
        'role' => Role::VILLAGE_HEAD,
        // 'profile_image' => Arr::get($request, 'user.profile_image'),
      ]);
    } catch (\Exception $e) {  
      logger($e->getMessage());
      DB::rollBack();
      
      return $e;
    }
    DB::commit();
    return $villageHead;
  }

  public function update($request, VillageHead $villageHead): bool
  {
    DB::beginTransaction();    
    try {       

      if(Arr::get($request, 'user.status')) $request['user']['status'] = UserStatus::ACTIVE;			
      else $request['user']['status'] = UserStatus::NONACTIVE;			
      
      if(is_null(Arr::get($request, 'user.password'))) Arr::pull($request, 'user.password');	
      
      $villageHead->updateOrFail(Arr::except($request, 'user'));
      $villageHead->user->updateOrFail(Arr::get($request, 'user'));

      DB::commit();
      return true;

    } catch (\Exception $e) {  
      logger($e->getMessage());
      DB::rollBack();
      
      return $e;
    }
  }

  public function delete(VillageHead $villageHead): bool
  {
    DB::beginTransaction();
    try {
      $villageHead->user?->deleteOrFail();
      $delete_village_head = $villageHead->deleteOrFail();
    } catch (\Exception $e) {
      logger($e->getMessage());
      DB::rollBack();
      
      return $e;
    }    

    DB::commit();
    return $delete_village_head;
  }
}