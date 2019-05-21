@component('mail::message')
<h4>Email</h4>
<p>{{ $applicant->email }}</p>
<h4>Phone</h4>
<p>{{ $applicant->phone }}</p>
<h4>Department</h4>
<p>{{ $applicant->department->name }}</p>
<h4>LinkedIn</h4>
<p>{{ $applicant->linkedin_link ?? 'Did not submit a link' }}</p>





Send from a contact form on <a href="https://novaverarealestate.com" style="text-decoration: none; font-weight: bold; color: darkslategray" target="_blank">Novavera Real Estate</a>,<br>
{{ config('app.name') }}
@endcomponent
