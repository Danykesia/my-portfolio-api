@component('mail::message')

The following message was sent from the contact page of your portfolio<br>

Guest: {{ $name }}<br>
Email: {{ $email }}<br>
Message: {{ $message }}<br>

Sincerely,<br>
{{ config('app.name') }}
@endcomponent
