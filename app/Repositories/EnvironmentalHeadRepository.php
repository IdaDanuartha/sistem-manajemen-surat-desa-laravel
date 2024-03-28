<?php

namespace App\Repositories;

use App\Enums\Role;
use App\Enums\UserStatus;
use App\Models\EnvironmentalHead;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class EnvironmentalHeadRepository
{
  public function __construct(
    protected readonly User $user,
    protected readonly EnvironmentalHead $environmentalHead,
  ) {}

  public function findAll($except_id = null): Collection
  {
    $query = $this->environmentalHead->latest()->with(['user']);

    if($except_id) {
      $query->whereNot("id", $except_id);
    }

    return $query->get();
  }

  public function findAllPaginate(): LengthAwarePaginator
  {
    return $this->environmentalHead->latest()->with(['user'])->paginate(10);
  }

  public function findById(EnvironmentalHead $environmentalHead): EnvironmentalHead
  {
    return $this->environmentalHead->with("user")->find($environmentalHead->id);
  }

  public function store($request): EnvironmentalHead|Exception
  {
    DB::beginTransaction();
    try {
      $environmentalHead = $this->environmentalHead->create(Arr::except($request, ['user']));
      
      $environmentalHead->user()->create([
        'username' => Arr::get($request, 'national_identify_number'),
        'email' => Arr::get($request, 'user.email'),
        'password' => Arr::get($request, 'user.password'),
        'status' => Arr::has($request, 'user.status') ? UserStatus::ACTIVE : UserStatus::NONACTIVE,
        'role' => Role::ENVIRONMENTAL_HEAD,
        // 'profile_image' => Arr::get($request, 'user.profile_image'),
      ]);
    } catch (\Exception $e) {  
      logger($e->getMessage());
      DB::rollBack();
      
      return $e;
    }
    DB::commit();
    return $environmentalHead;
  }

  public function update($request, EnvironmentalHead $environmentalHead): bool
  {
    DB::beginTransaction();    
    try {       

      if(Arr::get($request, 'user.status')) $request['user']['status'] = UserStatus::ACTIVE;			
      else $request['user']['status'] = UserStatus::NONACTIVE;			
      
      if(is_null(Arr::get($request, 'user.password'))) Arr::pull($request, 'user.password');	
      
      $environmentalHead->updateOrFail(Arr::except($request, 'user'));
      $environmentalHead->user->updateOrFail(Arr::get($request, 'user'));

      DB::commit();
      return true;

    } catch (\Exception $e) {  
      logger($e->getMessage());
      DB::rollBack();
      
      return $e;
    }
  }

  public function delete(EnvironmentalHead $environmentalHead): bool
  {
    DB::beginTransaction();
    try {
      $environmentalHead->user?->deleteOrFail();
      $delete_environmental_head = $environmentalHead->deleteOrFail();
    } catch (\Exception $e) {
      logger($e->getMessage());
      DB::rollBack();
      
      return $e;
    }    

    DB::commit();
    return $delete_environmental_head;
  }
}