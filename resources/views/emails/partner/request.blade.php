@component('mail::message')
<h4>Email</h4>
<p>{{ $partner->email }}</p>
<h4>Phone</h4>
<p>{{ $partner->phone }}</p>
<h4>Company Name</h4>
<p>{{ $partner->companyName}}</p>
<h4>Job Title</h4>
<p>{{ $partner->jobTitle }}</p>

<h4 style="margin-top: 20px">Message</h4>
<p>{{ $partner->message }}</p>





Send from a contact form on <a href="https://novaverarealestate.com" style="text-decoration: none; font-weight: bold; color: darkslategray" target="_blank">Novavera Real Estate</a>,<br>
{{ config('app.name') }}
@endcomponent
