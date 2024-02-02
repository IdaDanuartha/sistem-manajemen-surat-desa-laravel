@component("mail::message")

<div class="flex justify-center">
    <a href="{{ config('app.url') }}/auth/reset-password/{{ $token }}" class="button button-primary">
        Reset Password
    </a>
</div>

@endcomponent