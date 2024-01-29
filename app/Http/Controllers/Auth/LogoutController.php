<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\AuthRepository;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function __construct(
        private readonly AuthRepository $authRepository
    ) {}

    public function __invoke(Request $request)
    {
        $logout = $this->authRepository->logout($request);
        if($logout) return redirect()->route('login')->withSuccess('You have logged out successfully!');        
    }
}
