<?php

namespace App\Repositories;

use App\Enums\Role;
use App\Jobs\SendEmailQueueJob;
use App\Mail\SendLetterMail;
use App\Models\Letter;
use App\Models\User;
use App\Utils\UploadFile;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class LetterRepository
{
  public function __construct(
    protected readonly Letter $letter,    
    protected readonly User $user,
    protected readonly UploadFile $uploadFile
  ) {}

  public function findAll(): Collection
  {
    return $this->letter
            ->latest()
            ->with(['villageHead', 'environmentalHead', 'sectionHead'])
            ->get();

  }

  public function findLetterByCitizent(): Collection
  {
    return $this->letter
                ->latest()
                ->where('citizent_id', auth()->id())
                ->with(['villageHead', 'environmentalHead', 'sectionHead'])
                ->get();
  }

  public function findLetterByVillageHead(): Collection
  {
    return $this->letter
                ->latest()
                ->where('approved_by_environmental_head', 1)
                ->where('approved_by_section_head', 1)
                ->with(['villageHead', 'environmentalHead', 'sectionHead'])
                ->get();
  }

  public function findLetterBySectionHead(): Collection
  {
    return $this->letter
                ->latest()
                ->where('approved_by_environmental_head', 1)
                ->with(['villageHead', 'environmentalHead', 'sectionHead'])
                ->get();
  }

  public function findLetterApproved(): Collection
  {
    return auth()->user()->role === Role::CITIZENT ? 
           $this->letter
                ->latest()
                ->where('approved_by_village_head', 1)
                ->where('approved_by_environmental_head', 1)
                ->where('approved_by_section_head', 1)
                ->where('citizent_id', auth()->id())
                ->with(['villageHead', 'environmentalHead', 'sectionHead'])
                ->get() : 
           $this->letter
                ->latest()
                ->where('approved_by_village_head', 1)                
                ->where('approved_by_environmental_head', 1)
                ->where('approved_by_section_head', 1)
                ->with(['villageHead', 'environmentalHead', 'sectionHead'])
                ->get();
  }

  public function findAllPaginate(): LengthAwarePaginator
  {
    return $this->letter->latest()->paginate(10);
  }

  public function findById(Letter $letter): Letter
  {
    return $this->letter
                ->where('id', $letter->id)
                ->with(['villageHead', 'environmentalHead', 'sectionHead'])
                ->first();
  }

  public function store($request): Letter|Exception
  {
    DB::beginTransaction();
    try {
      $letter = $this->letter->create($request);
      $users = $this->user->where('role', Role::ENVIRONMENTAL_HEAD)->get();
      
      foreach($users as $user) {
        // Mail::to($user->email)->send(new SendLetterMail($user));
        dispatch(new SendEmailQueueJob($user->email, $user));
      }
    } catch (\Exception $e) {  
      logger($e->getMessage());
      DB::rollBack();
      
      return $e;
    }
    DB::commit();
    return $letter;
  }

  public function update($request, Letter $letter): bool|Exception
  {
    DB::beginTransaction();    
    try {                    
      if(!$letter->approvedByVillageHead()) {
        if (Arr::has($request, 'signature_image') && Arr::get($request, 'signature_image')) {
          $this->uploadFile->deleteExistFile("letters/signatures/$letter->signature_image");
  
          $image = Arr::get($request, 'signature_image');
  
          $filename = $this->uploadFile->uploadSingleFile($image, "letters/signatures");
          $request['signature_image'] = $filename;
        }  
             
        $letter->updateOrFail($request);			
  
        DB::commit();
        return true;
      } else {
        return [
          "status" => "error",
          "message" => "Surat tidak bisa diubah karena sudah disetujui oleh kepala kelurahan"
        ];        
      }
    } catch (\Exception $e) {  
      logger($e->getMessage());
      DB::rollBack();
      
      return $e;
    }
  }

  public function addSignature($signature_image, Letter $letter): bool|Exception
  {
    DB::beginTransaction();    
    try {  
      $folderPath = public_path('uploads/letters/signatures/');
      $image_parts = explode(";base64,", $signature_image);
      $image_type_aux = explode("image/", $image_parts[0]);
      $image_type = $image_type_aux[1];
      $image_base64 = base64_decode($image_parts[1]);
      $filename = uniqid() . '.'.$image_type;
      $file = $folderPath . $filename;

      file_put_contents($file, $image_base64);
      
      $letter->updateOrFail([
        "village_head_id" => auth()->user()->authenticatable->villageHead->id,
        "approved_by_village_head" => 1,
        "signature_image" => $filename
      ]);
          
      dispatch(new SendEmailQueueJob($letter->citizent->user->email, $letter->citizent->user));
  
      DB::commit();
      return true;      
    } catch (\Exception $e) {  
      logger($e->getMessage());
      DB::rollBack();
      
      return $e;
    }
  }

  public function updateLetterStatus(Letter $letter): bool|Exception
  {
    DB::beginTransaction();    
    try {  	
      if(auth()->user()->role === Role::ENVIRONMENTAL_HEAD) {
        $letter->updateOrFail([
          "environmental_head_id" => !$letter->approved_by_environmental_head ? 
                                     auth()->user()->authenticatable->environmentalHead->id : 
                                     null,
          "approved_by_environmental_head" => !$letter->approved_by_environmental_head
        ]);	

        $users = $this->user->where('role', Role::SECTION_HEAD)->get();
        foreach($users as $user) {          
          dispatch(new SendEmailQueueJob($user->email, $user));
        }
      } else if(auth()->user()->role === Role::SECTION_HEAD) {
        $letter->updateOrFail([
          "section_head_id" => !$letter->approved_by_section_head ? 
                               auth()->user()->authenticatable->sectionHead->id : 
                               null,
          "approved_by_section_head" => !$letter->approved_by_section_head
        ]);	
        
        $users = $this->user->where('role', Role::VILLAGE_HEAD)->get();
        foreach($users as $user) {          
          dispatch(new SendEmailQueueJob($user->email, $user));
        }
      } 
      // else if(auth()->user()->role === Role::VILLAGE_HEAD) {
      //   $letter->updateOrFail([
      //     "village_head_id" => !$letter->approved_by_village_head ? 
      //                          auth()->user()->authenticatable->villageHead->id : 
      //                          null,
      //     "approved_by_village_head" => !$letter->approved_by_village_head
      //   ]);  
      // }                                 
  
      DB::commit();
      return true;      
    } catch (\Exception $e) {  
      logger($e->getMessage());
      DB::rollBack();
      
      return $e;
    }
  }

  public function delete(Letter $letter): bool|Array|Exception
  {
    DB::beginTransaction();
    try {           
      if(!$letter->approved_by_village_head) {
        $this->uploadFile->deleteExistFile("letters/signatures/$letter->signature_image");      
        $delete_letter = $letter->deleteOrFail();
        
        DB::commit();
        return $delete_letter;
      } else {
        return [
          "status" => "error",
          "message" => "Surat tidak bisa dihapus karena sudah disetujui oleh kepala kelurahan"
        ];        
      }
    } catch (\Exception $e) {
      logger($e->getMessage());
      DB::rollBack();
      
      return $e;
    }        
  }
}