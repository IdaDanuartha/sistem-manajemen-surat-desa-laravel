<?php

namespace App\Repositories\Letters;

use App\Enums\Role;
use App\Mail\SendLetterToCitizent;
use App\Mail\SendLetterToEnvironmentalHead;
use App\Mail\SendLetterToSectionHead;
use App\Mail\SendLetterToVillageHead;
use App\Models\Sk;
use App\Models\SkMoveFamilyLetter;
use App\Models\SkMoveLetter;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SkMoveRepository
{
  public function __construct(
    protected readonly Sk $sk,    
    protected readonly SkMoveLetter $letter,    
    protected readonly SkMoveFamilyLetter $skMoveFamilyLetter,
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

  public function findById(SkMoveLetter $letter): SkMoveLetter
  {
    return $this->letter
                ->where('id', $letter->id)
                ->with(['families', 'sk.villageHead', 'sk.environmentalHead', 'sk.sectionHead', 'sk.citizent'])
                ->first();
  }

  public function store($request): Sk|Exception
  {
    DB::beginTransaction();
    try {
      $request["sk"]["code"] = strtoupper(Str::random(8));
      $request["sk"]["mode"] = 7;

      if(isset($request["sk"]["is_published"])) $request["sk"]["is_published"] = true;
      $sk_letter = $this->sk->create(Arr::get($request, "sk"));
      
      $request["sk_id"] = $sk_letter->id;
      $sk_move = $this->letter->create(Arr::except($request, "sk"));

      if (Arr::get($request, "family_citizent_id")[0]) {
        foreach(Arr::get($request, "family_citizent_id") as $index => $item) {
          $this->skMoveFamilyLetter->create([
            "sk_move_letter_id" => $sk_move->id,
            "citizent_id" => $item,
            "relationship_status" => $request["family_relationship_status"][$index]
          ]);
        }
      }

      
      // if($sk_letter->is_published) {
      //   $user = $this->user->where('role', Role::ENVIRONMENTAL_HEAD)->first();
      //   Mail::to($user->email)->send(new SendLetterToEnvironmentalHead($user, $sk_letter->code));
      // }
      
    } catch (\Exception $e) {  
      logger($e->getMessage());
      DB::rollBack();
      
      return $e;
    }
    DB::commit();
    return $sk_letter;
  }

  public function update($request, SkMoveLetter $letter): bool|array|Exception
  {
    DB::beginTransaction();    

    try {
        // if(isset($request["sk"]["is_published"])) {
        //   $user = $this->user->where('role', Role::ENVIRONMENTAL_HEAD)->first();
        //   Mail::to($user->email)->send(new SendLetterToEnvironmentalHead($user, $letter->sk->code));

        //   $request["sk"]["is_published"] = true;
        // }

        $letter->sk->updateOrFail(Arr::get($request, "sk"));
        $letter->updateOrFail(Arr::except($request, "sk"));

        $sk_move = $this->skMoveFamilyLetter->where("sk_move_letter_id", $letter->id)->get();

        foreach($sk_move as $item) {
          $item->delete();
        }

        foreach(Arr::get($request, "family_citizent_id") as $index => $item) {
          $this->skMoveFamilyLetter->create([
            "sk_move_letter_id" => $letter->id,
            "citizent_id" => $item,
            "relationship_status" => $request["family_relationship_status"][$index]
          ]);
        }

        DB::commit();
        return true;
    } catch (\Exception $e) {  
      logger($e->getMessage());
      DB::rollBack();
      
      return $e;
    }
  }

  public function confirmationLetter(SkMoveLetter $letter, $status): bool|Exception
  {
    DB::beginTransaction();    
    try {  	
      $letter = $this->findById($letter);

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

  public function delete(SkMoveLetter $letter): bool|Array|Exception
  {
    DB::beginTransaction();
    try {           
      if(!$letter->status_by_environmental_head) {    
        $delete_letter = $letter->sk->deleteOrFail();
        
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