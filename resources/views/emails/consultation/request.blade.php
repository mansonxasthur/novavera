@component('mail::message')
<h4>Email</h4>
<p>{{ $consultationRequest->email }}</p>
<h4>Phone</h4>
<p>{{ $consultationRequest->phone }}</p>



Send from a contact form on <a href="https://novaverarealestate.com" style="text-decoration: none; font-weight: bold; color: darkslategray" target="_blank">Novavera Real Estate</a>,<br>
{{ config('app.name') }}
@endcomponent
