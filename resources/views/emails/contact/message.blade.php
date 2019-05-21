@component('mail::message')
<h4>Email</h4>
<p>{{ $contact->email }}</p>
<h4>Phone</h4>
<p>{{ $contact->phone }}</p>
<h4>Inquiry</h4>
<p>{{ $contact->inquiry }}</p>

<h4 style="margin-top: 20px">Message</h4>
<p>{{ $contact->message }}</p>



Send from a contact form on <a href="https://novaverarealestate.com"
                               style="text-decoration: none; font-weight: bold; color: darkslategray"
                               target="_blank">Novavera Real Estate</a>,<br>
{{ config('app.name') }}
@endcomponent
