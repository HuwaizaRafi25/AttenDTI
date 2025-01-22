@component('mail::message')
    # Password Reset Request

    Hello {{ $user->username }},

    We received a request to reset your password. You can reset it by clicking the button below:

    @component('mail::button', ['url' => $url])
        Reset Password
    @endcomponent

    If you did not request a password reset, please ignore this email. Your password will remain unchanged.

    Thanks,
    {{ config('app.name') }}
@endcomponent
