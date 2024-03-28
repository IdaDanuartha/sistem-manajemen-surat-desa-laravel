<?php

namespace App\Repositories;

use App\Enums\Role;
use App\Enums\UserStatus;
use App\Models\Environmental;
use App\Models\EnvironmentalHead;
use App\Models\User;
use App\Utils\UploadFile;
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
    protected readonly Environmental $environmental,
    protected readonly UploadFile $uploadFile,
  ) {}

  public function findAll($except_id = null): Collection
  {
    $query = $this->environmentalHead->latest()->with(['user', 'environmental']);

    if($except_id) {
      $query->whereNot("id", $except_id);
    }

    return $query->get();
  }

  public function findAllPaginate(): LengthAwarePaginator
  {
    return $this->environmentalHead->latest()->with(['user', 'environmental'])->paginate(10);
  }

  public function findById(EnvironmentalHead $environmentalHead): EnvironmentalHead
  {
    return $this->environmentalHead->with("user", "environmental")->find($environmentalHead->id);
  }

  public function store($request): EnvironmentalHead|Exception
  {
    DB::beginTransaction();
    try {
      $environmental = $this->environmental->find($request["environmental_id"]);

      $environmentalHead = $this->environmentalHead->create(Arr::except($request, ['user']));
      
      if (Arr::has($request, 'user.signature_image') && Arr::get($request, 'user.signature_image')) {         
        $filename = $this->uploadFile->uploadSingleFile(Arr::get($request, 'user.signature_image'), "users/signatures");
        $request['user']['signature_image'] = $filename;
      }  

      $environmentalHead->user()->create([
        'username' => $environmental->code,
        'email' => Arr::get($request, 'user.email'),
        'password' => Arr::get($request, 'user.password'),
        'status' => Arr::has($request, 'user.status') ? UserStatus::ACTIVE : UserStatus::NONACTIVE,
        'role' => Role::ENVIRONMENTAL_HEAD,
        'signature_image' => Arr::get($request, 'user.signature_image'),
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
      $environmental = $this->environmental->find($request["environmental_id"]);

      if(Arr::get($request, 'user.status')) $request['user']['status'] = UserStatus::ACTIVE;			
      else $request['user']['status'] = UserStatus::NONACTIVE;			
      
      if(is_null(Arr::get($request, 'user.password'))) Arr::pull($request, 'user.password');	
      
      if (Arr::has($request, 'user.signature_image') && Arr::get($request, 'user.signature_image')) {
        $this->uploadFile->deleteExistFile("users/signatures/" . auth()->user()->signature_image);

        $image = Arr::get($request, 'user.signature_image');

        $filename = $this->uploadFile->uploadSingleFile($image, "users/signatures");
        $request['user']['signature_image'] = $filename;
      }

      $request["user"]["username"] = $environmental->code;
      
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