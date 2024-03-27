@component("mail::message")

<div class="flex justify-center">
    <p style="margin-bottom: 0 !important; color: black !important;">Hi, </p>
    <div class="" style="margin-top: 14px;">
        <p style="margin-bottom: 0 !important; color: black !important;">Forgot Your Password?</p>
        <p style="margin-bottom: 0 !important; color: black !important;">We received a request to reset the password for your account.</p>
    </div>
    <div class="" style="margin-top: 14px;">
        <p style="margin-bottom: 8px !important; color: black !important;">To reset the password, click on the button below:</p>
        <a href="{{ config('app.url') }}/auth/reset-password/{{ $token }}" class="button button-primary">
            Reset Password
        </a>
    </div>
    <div style="margin-top: 18px;">
        <p style="font-size: 14px; color: black">If you did not request a password reset, you can safely ignore this email. </p>
    </div>
</div>

@endcomponent
