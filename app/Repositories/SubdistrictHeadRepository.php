<?php

namespace App\Repositories;

use App\Enums\Role;
use App\Enums\UserStatus;
use App\Models\SubdistrictHead;
use App\Models\User;
use App\Utils\UploadFile;
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
        protected readonly UploadFile $uploadFile,
    ) {
    }

    public function findAll($except_id = null): Collection
    {
        $query = $this->subdistrictHead->latest();

        if ($except_id) {
            $query->whereNot("id", $except_id);
        }

        return $query->get();
    }

    public function findAllPaginate(): LengthAwarePaginator
    {
        return $this->subdistrictHead->latest()->paginate(10);
    }

    public function findById(SubdistrictHead $subdistrictHead): SubdistrictHead
    {
        return $this->subdistrictHead->with("user")->find($subdistrictHead->id);
    }

    public function store($request): SubdistrictHead|Exception
    {
        DB::beginTransaction();
        try {

            if (Arr::has($request, 'signature_image') && Arr::get($request, 'signature_image')) {
                $filename = $this->uploadFile->uploadSingleFile(Arr::get($request, 'signature_image'), "users/signatures");
                $request['signature_image'] = $filename;
            }

            $subdistrictHead = $this->subdistrictHead->create($request);
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
            if (Arr::has($request, 'signature_image') && Arr::get($request, 'signature_image')) {
                $this->uploadFile->deleteExistFile("users/signatures/" . $subdistrictHead->signature_image);
        
                $image = Arr::get($request, 'signature_image');
        
                $filename = $this->uploadFile->uploadSingleFile($image, "users/signatures");
                $request['signature_image'] = $filename;
              }

            $subdistrictHead->updateOrFail($request);

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
