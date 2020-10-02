@component('mail::message')
# Instellen Wachtwoord

Beste Gebruiker, er is succsesvol een wachtwoord aangevraagd voor uw account.
Onderstaand kunt u doormiddel van de knop het nieuwe wachtwoord instellen

Na het instellen hiervan is uw account klaar voor gebruik.

<br>



@component('mail::button', ['url' => route('newpassword',['token'=>$token,'email'=>$email])])

Wachtwoord Instellen
@endcomponent

<br>
<br>
Met Vriendelijke Groet,<br>
Team Astecom
@endcomponent
