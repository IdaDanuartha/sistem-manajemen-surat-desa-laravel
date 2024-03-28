<?php

namespace App\Repositories;

use App\Enums\Role;
use App\Enums\UserStatus;
use App\Models\SectionHead;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class SectionHeadRepository
{
  public function __construct(
    protected readonly User $user,
    protected readonly SectionHead $sectionHead,
  ) {}

  public function findAll($except_id = null): Collection
  {
    $query = $this->sectionHead->latest()->with(['user']);

    if($except_id) {
      $query->whereNot("id", $except_id);
    }

    return $query->get();
  }

  public function findAllPaginate(): LengthAwarePaginator
  {
    return $this->sectionHead->latest()->with(['user'])->paginate(10);
  }

  public function findById(SectionHead $sectionHead): SectionHead
  {
    return $this->sectionHead->with("user")->find($sectionHead->id);
  }

  public function store($request): SectionHead|Exception
  {
    DB::beginTransaction();
    try {
      $sectionHead = $this->sectionHead->create(Arr::except($request, ['user']));
      
      $sectionHead->user()->create([
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
    return $sectionHead;
  }

  public function update($request, SectionHead $sectionHead): bool
  {
    DB::beginTransaction();    
    try {       

      if(Arr::get($request, 'user.status')) $request['user']['status'] = UserStatus::ACTIVE;			
      else $request['user']['status'] = UserStatus::NONACTIVE;			
      
      if(is_null(Arr::get($request, 'user.password'))) Arr::pull($request, 'user.password');	
      
      $sectionHead->updateOrFail(Arr::except($request, 'user'));
      $sectionHead->user->updateOrFail(Arr::get($request, 'user'));

      DB::commit();
      return true;

    } catch (\Exception $e) {  
      logger($e->getMessage());
      DB::rollBack();
      
      return $e;
    }
  }

  public function delete(SectionHead $sectionHead): bool
  {
    DB::beginTransaction();
    try {
      $sectionHead->user?->deleteOrFail();
      $delete_section_head = $sectionHead->deleteOrFail();
    } catch (\Exception $e) {
      logger($e->getMessage());
      DB::rollBack();
      
      return $e;
    }    

    DB::commit();
    return $delete_section_head;
  }
}