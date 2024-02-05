<?php

namespace App\Repositories;

use App\Enums\Role;
use App\Jobs\SendEmailQueueJob;
use App\Jobs\SendEmailToCitizentQueueJob;
use App\Jobs\SendEmailToEnvironmentalHeadQueueJob;
use App\Jobs\SendEmailToSectionHeadQueueJob;
use App\Jobs\SendEmailToVillageHeadQueueJob;
use App\Mail\SendLetterMail;
use App\Models\Letter;
use App\Models\User;
use App\Utils\UploadFile;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
                ->where('citizent_id', auth()->user()->authenticatable->id)
                ->where('approved_by_village_head', 0)
                ->with(['villageHead', 'environmentalHead', 'sectionHead'])
                ->get();
  }

  public function findLetterByVillageHead(): Collection
  {
    return $this->letter
                ->latest()
                ->where('approved_by_environmental_head', 1)
                ->where('approved_by_section_head', 1)
                ->where('is_published', 1)
                ->with(['villageHead', 'environmentalHead', 'sectionHead'])
                ->get();
  }

  public function findLetterBySectionHead(): Collection
  {
    return $this->letter
                ->latest()
                ->where('approved_by_environmental_head', 1)
                ->where('is_published', 1)
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
                ->where('is_published', 1)
                ->where('citizent_id', auth()->user()->authenticatable->id)
                ->with(['villageHead', 'environmentalHead', 'sectionHead'])
                ->get() : 
           $this->letter
                ->latest()
                ->where('approved_by_village_head', 1)                
                ->where('approved_by_environmental_head', 1)
                ->where('approved_by_section_head', 1)
                ->where('is_published', 1)
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
                ->with(['citizent', 'villageHead', 'environmentalHead', 'sectionHead'])
                ->first();
  }

  public function store($request): Letter|Exception
  {
    DB::beginTransaction();
    try {
      // if (Arr::has($request, 'letter_file') && Arr::get($request, 'letter_file')) {         
      //   $filename = $this->uploadFile->uploadSingleFile($request['letter_file'], "letters/files");
      //   $request['letter_file'] = $filename;
      // }
      $request["code"] = strtoupper(Str::random(8));
      if(isset($request["is_published"])) $request["is_published"] = true;
      $letter = $this->letter->create($request);
      
      if($letter->is_published) {
        $users = $this->user->where('role', Role::ENVIRONMENTAL_HEAD)->get();

        foreach($users as $user) {
          // Mail::to($user->email)->send(new SendLetterMail($user));
          dispatch(new SendEmailToEnvironmentalHeadQueueJob($user->email, $user, $letter->code));
        }
      }
      
    } catch (\Exception $e) {  
      logger($e->getMessage());
      DB::rollBack();
      
      return $e;
    }
    DB::commit();
    return $letter;
  }

  public function update($request, Letter $letter): bool|array|Exception
  {
    DB::beginTransaction();    
    try {                    
      // if(!$letter->approvedByVillageHead()) {
        // if (Arr::has($request, 'signature_image') && Arr::get($request, 'signature_image')) {
        //   $this->uploadFile->deleteExistFile("letters/signatures/$letter->signature_image");
  
        //   $image = Arr::get($request, 'signature_image');
  
        //   $filename = $this->uploadFile->uploadSingleFile($image, "letters/signatures");
        //   $request['signature_image'] = $filename;
        // }  
        if(isset($request["is_published"])) $request["is_published"] = true;
        $letter->updateOrFail($request);			
  
        if(isset($request["is_published"])) {
          $users = $this->user->where('role', Role::ENVIRONMENTAL_HEAD)->get();
  
          foreach($users as $user) {
            // Mail::to($user->email)->send(new SendLetterMail($user));
            dispatch(new SendEmailToEnvironmentalHeadQueueJob($user->email, $user, $letter->code));
          }
        }

        DB::commit();
        return true;
      // } else {
      //   return [
      //     "status" => "error",
      //     "message" => "Surat tidak bisa diubah karena sudah disetujui oleh kepala kelurahan"
      //   ];        
      // }
    } catch (\Exception $e) {  
      logger($e->getMessage());
      DB::rollBack();
      
      return $e;
    }
  }

  // public function addSignature($signature_image, Letter $letter): bool|Exception
  // {
  //   DB::beginTransaction();    
  //   try {  
  //     $folderPath = public_path('uploads/letters/signatures/');
  //     $image_parts = explode(";base64,", $signature_image);
  //     $image_type_aux = explode("image/", $image_parts[0]);
  //     $image_type = $image_type_aux[1];
  //     $image_base64 = base64_decode($image_parts[1]);
  //     $filename = uniqid() . '.'.$image_type;
  //     $file = $folderPath . $filename;

  //     file_put_contents($file, $image_base64);
      
  //     $letter->updateOrFail([
  //       "village_head_id" => auth()->user()->authenticatable->villageHead->id,
  //       "approved_by_village_head" => 1,
  //       "signature_image" => $filename
  //     ]);
          
  //     dispatch(new SendEmailQueueJob($letter->citizent->user->email, $letter->citizent->user, $letter->code));
  
  //     DB::commit();
  //     return true;      
  //   } catch (\Exception $e) {  
  //     logger($e->getMessage());
  //     DB::rollBack();
      
  //     return $e;
  //   }
  // }

  public function updateLetterStatus(Letter $letter): bool|Exception
  {
    DB::beginTransaction();    
    try {  	
      if(auth()->user()->role === Role::ENVIRONMENTAL_HEAD) {
        $letter->updateOrFail([
          "environmental_head_id" => auth()->user()->authenticatable->id,
          "approved_by_environmental_head" => true
        ]);	

        $users = $this->user->where('role', Role::SECTION_HEAD)->get();
        foreach($users as $user) {          
          dispatch(new SendEmailToSectionHeadQueueJob($user->email, $user, $letter->code));
        }
      } else if(auth()->user()->role === Role::SECTION_HEAD) {
        $letter->updateOrFail([
          "section_head_id" => auth()->user()->authenticatable->id,
          "approved_by_section_head" => true
        ]);	
        
        $users = $this->user->where('role', Role::VILLAGE_HEAD)->get();
        foreach($users as $user) {          
          dispatch(new SendEmailToVillageHeadQueueJob($user->email, $user, $letter->code));
        }
      } else if(auth()->user()->role === Role::VILLAGE_HEAD) {
        $letter->updateOrFail([
          "village_head_id" => auth()->user()->authenticatable->id,
          "approved_by_village_head" => true
        ]); 
        
        dispatch(new SendEmailToCitizentQueueJob($letter->citizent->user->email, $letter->citizent->user, $letter->code));
      }                                 
  
      db::commit();
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