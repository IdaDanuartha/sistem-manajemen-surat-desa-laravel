<?php

namespace App\Repositories\Letters;

use App\Enums\Role;
use App\Mail\SendLetterToCitizent;
use App\Mail\SendLetterToEnvironmentalHead;
use App\Mail\SendLetterToSectionHead;
use App\Mail\SendLetterToVillageHead;
use App\Models\DieselPurchaseLetter;
use App\Models\Sk;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SkMarryRepository
{
  public function __construct(
    protected readonly Sk $sk,    
    protected readonly DieselPurchaseLetter $letter,    
    protected readonly User $user,
  ) {}

  public function findAll(): Collection
  {
    return $this->letter
            ->latest()
            ->with(['sk.villageHead', 'sk.environmentalHead', 'sk.sectionHead', 'sk.citizent'])
            ->get();
  }

  public function findLetterByCitizent(): Collection
  {
    return $this->letter
                ->latest()
                ->with(['sk.villageHead', 'sk.environmentalHead', 'sk.sectionHead', 'sk.citizent'])
                ->whereRelation('sk', 'citizent_id', auth()->user()->authenticatable->id)
                ->whereRelation('sk', 'status_by_village_head', 0)
                ->get();
  }

  public function findLetterByVillageHead(): Collection
  {
    return $this->letter
                ->latest()
                ->with(['sk.villageHead', 'sk.environmentalHead', 'sk.sectionHead', 'sk.citizent'])
                ->whereRelation('sk', 'status_by_environmental_head', 1)
                ->whereRelation('sk', 'status_by_section_head', 1)
                ->whereRelation('sk', 'is_published', 1)
                ->get();
  }

  public function findLetterBySectionHead(): Collection
  {
    return $this->letter
                ->latest()
                ->with(['sk.villageHead', 'sk.environmentalHead', 'sk.sectionHead', 'sk.citizent'])
                ->whereRelation('sk', 'status_by_environmental_head', 1)
                ->whereRelation('sk', 'is_published', 1)
                ->get();
  }

  public function findLetterByStatus($status = 1): Collection
  {
    return auth()->user()->role === Role::CITIZENT ? 
           $this->letter
                ->latest()
                ->with(['sk.villageHead', 'sk.environmentalHead', 'sk.sectionHead', 'sk.citizent'])
                ->whereRelation('sk', 'status_by_village_head', $status)
                ->whereRelation('sk', 'is_published', 1)
                ->whereRelation('sk', 'citizent_id', auth()->user()->authenticatable->id)
                ->get() : 
           $this->letter
                ->latest()
                ->with(['sk.villageHead', 'sk.environmentalHead', 'sk.sectionHead', 'sk.citizent'])
                ->whereRelation('sk', 'status_by_village_head', $status)
                ->whereRelation('sk', 'is_published', 1)
                ->get();
  }

  public function findAllPaginate(): LengthAwarePaginator
  {
    return $this->letter->latest()->paginate(10);
  }

  public function findById(DieselPurchaseLetter $dieselPurchase): DieselPurchaseLetter
  {
    return $this->letter
                ->where('id', $dieselPurchase->id)
                ->with(['sk.villageHead', 'sk.environmentalHead', 'sk.sectionHead', 'sk.citizent'])
                ->first();
  }

  public function store($request): Sk|Exception
  {
    DB::beginTransaction();
    try {
      $request["sk"]["code"] = strtoupper(Str::random(8));

      if(isset($request["sk"]["is_published"])) $request["sk"]["is_published"] = true;
      $sk_letter = $this->sk->create(Arr::get($request, "sk"));

      $request["sk"]["sk_id"] = $sk_letter->id;
      $this->letter->create(Arr::except($request, "sk"));
      
      if($sk_letter->is_published) {
        $user = $this->user->where('role', Role::ENVIRONMENTAL_HEAD)->first();
        Mail::to($user->email)->send(new SendLetterToEnvironmentalHead($user, $sk_letter->code));
      }
      
    } catch (\Exception $e) {  
      logger($e->getMessage());
      DB::rollBack();
      
      return $e;
    }
    DB::commit();
    return $sk_letter;
  }

  public function update($request, DieselPurchaseLetter $dieselPurchase): bool|array|Exception
  {
    DB::beginTransaction();    

    try {
        if(isset($request["sk"]["is_published"])) {
            $user = $this->user->where('role', Role::ENVIRONMENTAL_HEAD)->first();
            Mail::to($user->email)->send(new SendLetterToEnvironmentalHead($user, $dieselPurchase->sk->code));

            $request["sk"]["is_published"] = true;
          }

        $dieselPurchase->sk->updateOrFail(Arr::get($request, "sk"));
        $dieselPurchase->updateOrFail(Arr::except($request, "sk"));

        DB::commit();
        return true;
    } catch (\Exception $e) {  
      logger($e->getMessage());
      DB::rollBack();
      
      return $e;
    }
  }

  public function confirmationLetter(DieselPurchaseLetter $dieselPurchase, $status): bool|Exception
  {
    DB::beginTransaction();    
    try {  	
      $letter = $this->findById($dieselPurchase);

      if(auth()->user()->role === Role::ENVIRONMENTAL_HEAD) {
        $letter->sk->updateOrFail([
          "environmental_head_id" => auth()->user()->authenticatable->id,
          "status_by_environmental_head" => $status ? 1 : 2
        ]);	

        $user = $this->user->where('role', Role::SECTION_HEAD)->first();
        if($status) {
          Mail::to($user->email)->send(new SendLetterToSectionHead($user, $letter->sk->code));
        }
      } else if(auth()->user()->role === Role::SECTION_HEAD) {
        $letter->sk->updateOrFail([
          "section_head_id" => auth()->user()->authenticatable->id,
          "status_by_section_head" => $status ? 1 : 2
        ]);	
        
        $user = $this->user->where('role', Role::VILLAGE_HEAD)->first();

        if($status) {
          Mail::to($user->email)->send(new SendLetterToVillageHead($user, $letter->sk->code));
        }
      } else if(auth()->user()->role === Role::VILLAGE_HEAD) {
        $letter->sk->updateOrFail([
          "village_head_id" => auth()->user()->authenticatable->id,
          "status_by_village_head" => $status ? 1 : 2
        ]); 
        
        if($status) {
          Mail::to($letter->sk->citizent->user->email)->send(new SendLetterToCitizent($letter->sk->citizent->user, $letter->sk->code, "disetujui"));
        }
      }
      
      if(!$status) {
        Mail::to($letter->sk->citizent->user->email)->send(new SendLetterToCitizent($letter->sk->citizent->user, $letter->sk->code, "ditolak"));
      } 
  
      DB::commit();
      return true;      
    } catch (\Exception $e) {  
      logger($e->getMessage());
      DB::rollBack();
      
      return $e;
    }
  }

  public function delete(DieselPurchaseLetter $dieselPurchase): bool|Array|Exception
  {
    DB::beginTransaction();
    try {           
      if(!$dieselPurchase->status_by_environmental_head) {    
        $delete_letter = $dieselPurchase->sk->deleteOrFail();
        
        DB::commit();
        return $delete_letter;
      } else {
        return [
          "status" => "error",
          "message" => "Surat tidak bisa dihapus karena sudah disetujui oleh kepala lingkungan"
        ];        
      }
    } catch (\Exception $e) {
      logger($e->getMessage());
      DB::rollBack();
      
      return $e;
    }        
  }
}