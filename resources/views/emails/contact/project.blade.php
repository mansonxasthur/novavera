@component('mail::message')
<h4>Email</h4>
<p>{{ $inquiry->email }}</p>
<h4>Project</h4>
<p>{{ $inquiry->project }}</p>
<h4>Location</h4>
<p>{{ $inquiry->location }}</p>

<h4 style="margin-top: 20px">Message</h4>
<p>{{ $inquiry->message }}</p>



Send from a contact form on <a href="https://novaverarealestate.com" style="text-decoration: none; font-weight: bold; color: darkslategray" target="_blank">Novavera Real Estate</a>,<br>
{{ config('app.name') }}
@endcomponent
