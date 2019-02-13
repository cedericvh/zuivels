@component('mail::message')

Bedankt voor jouw order !<br><br>
Volgende producten werden besteld <br><br>

  @foreach ($orderData['products'] as $product)
      {{ $product['quantity'] }} {{ $product['title'] }} <br>
  @endforeach

  Ronde : {{$orderData['shippinground']}}<br><br>

 Extra opmerking :  {{$orderData['remark']}}<br><br>

Bedankt,<br><br>
{{ config('app.name') }}


