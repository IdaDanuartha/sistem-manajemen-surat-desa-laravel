<?php

namespace App\Repositories;

use App\Models\Environmental;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class EnvironmentalRepository
{
  public function __construct(
    protected readonly Environmental $environmental,
  ) {}

  public function findAll(): Collection
  {
    return $this->environmental->latest()->get();
  }

  public function findAllPaginate(): LengthAwarePaginator
  {
    return $this->environmental->latest()->paginate(10);
  }

  public function findById(Environmental $environmental): Environmental
  {
    return $environmental;
  }

  public function store($request): Environmental|Exception
  {
    DB::beginTransaction();
    try {
      $environmental = $this->environmental->create($request);
      
    } catch (\Exception $e) {  
      logger($e->getMessage());
      DB::rollBack();
      
      return $e;
    }
    DB::commit();
    return $environmental;
  }

  public function update($request, Environmental $environmental): bool
  {
    DB::beginTransaction();    
    try {       
      $environmental->updateOrFail($request);

      DB::commit();
      return true;

    } catch (\Exception $e) {  
      logger($e->getMessage());
      DB::rollBack();
      
      return $e;
    }
  }

  public function delete(Environmental $environmental): bool
  {
    DB::beginTransaction();
    try {
      $delete_environmental = $environmental->deleteOrFail();
    } catch (\Exception $e) {
      logger($e->getMessage());
      DB::rollBack();
      
      return $e;
    }    

    DB::commit();
    return $delete_environmental;
  }
}