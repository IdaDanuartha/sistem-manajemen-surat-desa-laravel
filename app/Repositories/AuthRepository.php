<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class AuthRepository 
{
  public function __construct(
    protected readonly User $user
  ) {}

  public function login($credentials)
  {
    try {
      if(isset($credentials["remember"]) && !empty($credentials["remember"])) {
        setcookie("email", $credentials["email"], time() + (7 * 24 * 60 * 60));
        setcookie("password", $credentials["password"], time() + (7 * 24 * 60 * 60));        
      } else {
        setcookie("email", "");
        setcookie("password", "");
      }
      return auth()->attempt(Arr::except($credentials, "remember"), Arr::only($credentials, "remember"));
    } catch (\Exception $e) {
      logger($e->getMessage());
      throw $e;
    }            
  }    

  public function logout($request): bool
  {
    auth()->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return true;
  }
}