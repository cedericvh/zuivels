@component('mail::message')

  # Een nieuw bericht

  Er werd een bericht gestuurd vanop de site :<br>

  Naam : {{$formData['name']}}

  E-mail : {{$formData['email']}}

  Adres : {{$formData['adres']}}

  Bericht :  {{$formData['message']}}

@endcomponent
