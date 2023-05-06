@component('mail::message')
# Bonjour Narjiss

 Vous avez recu un message de la part de : {{$data['name']}}


<b>Mail Emmetteur :</b> {{$data['email']}}<br>
<b>Sujet  :</b> {{$data['subject']}}<br>
<b>Contenu du Mail :</b> <br> {{$data['message']}}


Cordialement.<br>

@endcomponent
