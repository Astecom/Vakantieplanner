@component('mail::message')
# Nieuwe verlofaanvraag van {{$authUser->name}}

U kunt de aanvraag beoordelen doormiddel van de zwarte knop.<br>

Hier kunt u de status naar Goedgekeurd of Afkeurd updaten. <br>
Ook is het mogelijk om hier een toelichting aan toe te voegen

@component('mail::button', ['url' => route('login')])
Beoordelen Aanvraag
@endcomponent

<br>
<br>
Met Vriendelijke Groet,<br>
Team Astecom
@endcomponent
