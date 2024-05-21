<?php

namespace App\Repositories\Letters;

use App\Enums\Role;
use App\Mail\SendLetterToCitizent;
use App\Mail\SendLetterToEnvironmentalHead;
use App\Mail\SendLetterToSectionHead;
use App\Mail\SendLetterToVillageHead;
use App\Models\Citizent;
use App\Models\EnvironmentalHead;
use App\Models\Sk;
use App\Models\SkDomicileLetter;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SkDomicileRepository
{
  public function __construct(
    protected readonly Sk $sk,
    protected readonly SkDomicileLetter $letter,
    protected readonly Citizent $citizent,
    protected readonly EnvironmentalHead $environmentalHead,
    protected readonly User $user,
  ) {
  }

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
      ->whereRelation('sk.citizent', 'environmental_id', auth()->user()->authenticatable->environmental_id)
      ->get();
  }

  public function findAllPaginate(): LengthAwarePaginator
  {
    return $this->letter->latest()->paginate(10);
  }

  public function findById(SkDomicileLetter $letter): SkDomicileLetter
  {
    return $this->letter
      ->where('id', $letter->id)
      ->with(['sk.villageHead', 'sk.environmentalHead', 'sk.sectionHead', 'sk.citizent'])
      ->first();
  }

  public function store($request): Sk|Exception
  {
    DB::beginTransaction();
    try {
      $request["sk"]["code"] = strtoupper(Str::random(8));
      $request["sk"]["mode"] = 6;

      if (isset($request["sk"]["is_published"])) $request["sk"]["is_published"] = true;
      $sk_letter = $this->sk->create(Arr::get($request, "sk"));

      $request["sk_id"] = $sk_letter->id;
      $this->letter->create(Arr::except($request, "sk"));

      $citizent = $this->citizent->find($request["sk"]["citizent_id"]);

      if ($sk_letter->is_published) {
        $environmentalHead = $this->environmentalHead->where("environmental_id", $citizent->environmental_id)->first();

        Mail::to($environmentalHead->user->email)->send(new SendLetterToEnvironmentalHead($environmentalHead->user, $sk_letter->code));
        // dispatch(new SendEmailToEnvironmentalHeadQueueJob($user->email, $user, $letter->code));
      }
    } catch (\Exception $e) {
      logger($e->getMessage());
      DB::rollBack();

      return $e;
    }
    DB::commit();
    return $sk_letter;
  }

  public function update($request, SkDomicileLetter $letter): bool|array|Exception
  {
    DB::beginTransaction();

    try {
      if (isset($request["sk"]["is_published"])) {
        $environmentalHead = $this->environmentalHead->where("environmental_id", $letter->sk->citizent->environmental_id)->first();
        Mail::to($environmentalHead->user->email)->send(new SendLetterToEnvironmentalHead($environmentalHead->user, $letter->sk->code));

        $request["sk"]["is_published"] = true;
        $request["sk"]["environmental_head_id"] = null;
        $request["sk"]["section_head_id"] = null;
        $request["sk"]["village_head_id"] = null;
        $request["sk"]["status_by_environmental_head"] = 0;
        $request["sk"]["status_by_section_head"] = 0;
        $request["sk"]["status_by_village_head"] = 0;
        $request["sk"]["reject_reason"] = null;
      }

      $letter->sk->updateOrFail(Arr::get($request, "sk"));
      $letter->updateOrFail(Arr::except($request, "sk"));

      DB::commit();
      return true;
    } catch (\Exception $e) {
      logger($e->getMessage());
      DB::rollBack();

      return $e;
    }
  }

  public function confirmationLetter(SkDomicileLetter $letter, $status, $reject_reason = null): bool|Exception
  {
    DB::beginTransaction();
    try {
      $letter = $this->findById($letter);

      if (auth()->user()->role === Role::ENVIRONMENTAL_HEAD) {
        $letter->sk->updateOrFail([
          "environmental_head_id" => auth()->user()->authenticatable->id,
          "status_by_environmental_head" => $status ? 1 : 2,
          "reject_reason" => $status ? null : $reject_reason
        ]);

        $section_heads = $this->user->where('role', Role::SECTION_HEAD)->get();
        $village_head = $this->user->where('role', Role::VILLAGE_HEAD)->first();
        if ($status) {
          foreach($section_heads as $section_head) {
            Mail::to($section_head->email)->send(new SendLetterToSectionHead($section_head, $letter->sk->code));
          }
          Mail::to($village_head->email)->send(new SendLetterToSectionHead($village_head, $letter->sk->code));
        }
      } else if (auth()->user()->role === Role::SECTION_HEAD || auth()->user()->role === Role::VILLAGE_HEAD) {
        if(auth()->user()->role === Role::SECTION_HEAD) {
          $letter->sk->updateOrFail([
            "section_head_id" => auth()->user()->authenticatable->id,
            "status_by_section_head" => $status ? 1 : 2
          ]);
        } else {
          $letter->sk->updateOrFail([
            "village_head_id" => auth()->user()->authenticatable->id,
            "status_by_village_head" => $status ? 1 : 2
          ]);
        }

        if ($status) {
          Mail::to($letter->sk->citizent->user->email)->send(new SendLetterToCitizent($letter->sk->citizent->user, $letter->sk->code, "disetujui"));
        }
      }

      if (!$status) {
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

  public function delete(SkDomicileLetter $letter): bool|array|Exception
  {
    DB::beginTransaction();
    try {
      if (!$letter->status_by_environmental_head) {
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
