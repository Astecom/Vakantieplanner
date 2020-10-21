@component('mail::message')
# Instellen Wachtwoord

Beste,

Er is een wachtwoord aangevraagd voor uw account. Klik op onderstaande knop om een nieuw wachtwoord in te stellen.

<br>



@component('mail::button', ['url' => route('newpassword',['token'=>$token,'email'=>$email])])

Wachtwoord Instellen
@endcomponent

<br>
<br>
Met Vriendelijke Groet,<br>
Team Astecom
@endcomponent
