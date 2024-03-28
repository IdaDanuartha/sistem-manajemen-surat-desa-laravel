<?php

namespace App\Repositories;

use App\Enums\Role;
use App\Enums\UserStatus;
use App\Models\SubdistrictHead;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class SubdistrictHeadRepository
{
  public function __construct(
    protected readonly User $user,
    protected readonly SubdistrictHead $subdistrictHead,
  ) {}

  public function findAll($except_id = null): Collection
  {
    $query = $this->subdistrictHead->latest()->with(['user']);

    if($except_id) {
      $query->whereNot("id", $except_id);
    }

    return $query->get();
  }

  public function findAllPaginate(): LengthAwarePaginator
  {
    return $this->subdistrictHead->latest()->with(['user'])->paginate(10);
  }

  public function findById(SubdistrictHead $subdistrictHead): SubdistrictHead
  {
    return $this->subdistrictHead->with("user")->find($subdistrictHead->id);
  }

  public function store($request): SubdistrictHead|Exception
  {
    DB::beginTransaction();
    try {
      $subdistrictHead = $this->subdistrictHead->create(Arr::except($request, ['user']));
      
      $subdistrictHead->user()->create([
        'username' => Arr::get($request, 'national_identify_number'),
        'email' => Arr::get($request, 'user.email'),
        'password' => Arr::get($request, 'user.password'),
        'status' => Arr::has($request, 'user.status') ? UserStatus::ACTIVE : UserStatus::NONACTIVE,
        'role' => Role::SECTION_HEAD,
        // 'profile_image' => Arr::get($request, 'user.profile_image'),
      ]);
    } catch (\Exception $e) {  
      logger($e->getMessage());
      DB::rollBack();
      
      return $e;
    }
    DB::commit();
    return $subdistrictHead;
  }

  public function update($request, SubdistrictHead $subdistrictHead): bool
  {
    DB::beginTransaction();    
    try {       

      if(Arr::get($request, 'user.status')) $request['user']['status'] = UserStatus::ACTIVE;			
      else $request['user']['status'] = UserStatus::NONACTIVE;			
      
      if(is_null(Arr::get($request, 'user.password'))) Arr::pull($request, 'user.password');	
      
      $subdistrictHead->updateOrFail(Arr::except($request, 'user'));
      $subdistrictHead->user->updateOrFail(Arr::get($request, 'user'));

      DB::commit();
      return true;

    } catch (\Exception $e) {  
      logger($e->getMessage());
      DB::rollBack();
      
      return $e;
    }
  }

  public function delete(SubdistrictHead $subdistrictHead): bool
  {
    DB::beginTransaction();
    try {
      $subdistrictHead->user?->deleteOrFail();
      $delete_subdistrict_head = $subdistrictHead->deleteOrFail();
    } catch (\Exception $e) {
      logger($e->getMessage());
      DB::rollBack();
      
      return $e;
    }    

    DB::commit();
    return $delete_subdistrict_head;
  }
}