<?php

namespace App\Repositories;

use App\Enums\Role;
use App\Enums\UserStatus;
use App\Models\Citizent;
use App\Models\User;
use App\Utils\UploadFile;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class CitizentRepository
{
  public function __construct(
    protected readonly User $user,
    protected readonly Citizent $citizent,
    protected readonly UploadFile $uploadFile
  ) {}

  public function findAll($except_id = null): Collection
  {
    $query = $this->citizent->latest()->with(['user', 'environmental']);

    if($except_id) {
      $query->whereNot("id", $except_id);
    }

    return $query->get();
  }

  public function findByFamilyNumber($family_card_number, $except_id): Collection
  {
    return $this->citizent->latest()->where("family_card_number", $family_card_number)->whereNot("id", $except_id)->with(['user', 'environmental'])->get();
  }

  public function findAllPaginate(): LengthAwarePaginator
  {
    return $this->citizent->latest()->with(['user', 'environmental'])->paginate(10);
  }

  public function findById(Citizent $citizent): Citizent
  {
    return $this->citizent->with(["user", "environmental"])->find($citizent->id);
  }

  public function store($request): Citizent|Exception
  {
    DB::beginTransaction();
    try {

      if (Arr::has($request, 'user.signature_image') && Arr::get($request, 'user.signature_image')) {         
        $filename = $this->uploadFile->uploadSingleFile(Arr::get($request, 'user.signature_image'), "users/signatures");
        $request['user']['signature_image'] = $filename;
      }  

      $citizent = $this->citizent->create(Arr::except($request, ['user']));
      
      $citizent->user()->create([
        'username' => Arr::get($request, 'national_identify_number'),
        'email' => Arr::get($request, 'user.email'),
        'password' => Arr::get($request, 'user.password'),
        'status' => Arr::has($request, 'user.status') ? UserStatus::ACTIVE : UserStatus::NONACTIVE,
        'role' => Role::CITIZENT,
        'signature_image' => Arr::get($request, 'user.signature_image'),
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
      if (Arr::has($request, 'user.signature_image') && Arr::get($request, 'user.signature_image')) {
        $this->uploadFile->deleteExistFile("users/signatures/" . $citizent->user->signature_image);

        $image = Arr::get($request, 'user.signature_image');

        $filename = $this->uploadFile->uploadSingleFile($image, "users/signatures");
        $request['user']['signature_image'] = $filename;
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
      // $this->uploadFile->deleteExistFile("users/$citizent->profile_image");

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