@component('mail::message')
# Status Update Verlofaanvraag

Beste, De status van uw verlof aanvraag is geupdate.<br>
U kunt de aanvraag bekijken doormiddel van de onderste knop<br>

Hierin staat de nieuwe status naar Afgekeurd of Goedgekeurd<br>

@component('mail::button', ['url' => route('history')])
Aanvraag Bekijken
@endcomponent

<br>
<br>
Met Vriendelijke Groet,<br>
Team Astecom
@endcomponent
