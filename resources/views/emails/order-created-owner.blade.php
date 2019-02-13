@component('mail::message')

  # Een nieuw order

  Er werd een bestelling gedaan vanop de site :<br>

  @foreach ($orderData['products'] as $product)
      {{ $product['quantity'] }} {{ $product['title'] }}
  @endforeach

  Naam klant : {{$orderData['name']}}

  Adres : {{$orderData['address2']}}, {{$orderData['address1']}} {{$orderData['city']}}
  
  Telephone : {{$orderData['telephone']}}

  Ronde : {{$orderData['shippinground']}}

  Extra opmerking :  {{$orderData['remark']}}

@endcomponent
