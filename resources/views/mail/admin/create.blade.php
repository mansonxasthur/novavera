@component('mail::message')
# Welcome {{ $user->name }}


Now you are able to access our dashboard with your email <span style="color: lightskyblue; font-style: italic">{{ $user->email }}</span> and password of <span style="color: red"><strong>{{ $password }}</strong></span>.

@component('mail::button', ['url' => \Illuminate\Support\Facades\URL::route('dashboard')])
Go to Dashboard
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
