<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPassword\ResetPasswordRequest;
use App\Http\Requests\ForgotPassword\StoreForgotPasswordRequest;
use App\Jobs\SendResetPasswordLinkQueueJob;
use App\Mail\ForgotPasswordMail;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function forgotPasswordForm(StoreForgotPasswordRequest $request)
    {
        try {
            $token = Str::random(64);
            PasswordReset::create([
                'email' => $request->email,
                'token' => $token,
            ]);

            Mail::to($request->email)->send(new ForgotPasswordMail($token));

            return back()->with('success', 'We have e-mailed your password reset link!');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return back()->with('error', 'Failed to send your password reset link!');
        }
    }

    public function resetPassword($token)
    {
        $user = PasswordReset::where('token', $token)->first();
        if ($user) {
            return view('auth.reset-password', [
                'token' => $token,
            ]);
        } else {
            return redirect()->route('login')->with('failed', 'Token Invalid');
        }
    }

    public function resetPasswordForm(ResetPasswordRequest $request)
    {
        try {
            $userResetPass = PasswordReset::where('token', $request->token)->first();

            $updatePassword = PasswordReset::where([
                'email' => $userResetPass->email,
                'token' => $request->token
            ])->first();

            if (!$updatePassword) {
                return back()->withInput()->with('failed', 'Invalid token!');
            }

            $auth = User::where('email', $userResetPass->email)
                ->update(['password' => bcrypt($request->password)]);

            PasswordReset::where(['email' => $userResetPass->email])->delete();

            return redirect(route('login'))->with('success', 'Your password has been changed!');
        } catch (\Exception $e) {
            return back()->with('failed', 'Failed to send your password reset link!');
        }
    }
}
