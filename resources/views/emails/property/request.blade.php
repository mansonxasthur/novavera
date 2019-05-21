@component('mail::message')
<h4>Email</h4>
<p>{{ $propertyRequest->email }}</p>
<h4>Phone</h4>
<p>{{ $propertyRequest->phone }}</p>
<h4>Project</h4>
<p>{{ $propertyRequest->project->name }}</p>
<h4>Property Type</h4>
<p>{{ $propertyRequest->propertyType->name }}</p>

<h4 style="margin-top: 20px">Message</h4>
<p>{{ $propertyRequest->message }}</p>





Send from a contact form on <a href="https://novaverarealestate.com" style="text-decoration: none; font-weight: bold; color: darkslategray" target="_blank">Novavera Real Estate</a>,<br>
{{ config('app.name') }}
@endcomponent
