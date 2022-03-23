@component('mail::message')
# Email Verification

Thank you for signing up.
Your six-digit code is: <strong>{{ $pin }}</strong>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
