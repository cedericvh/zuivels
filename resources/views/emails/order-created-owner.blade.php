@component('mail::message')
# Order Created

New order has been created!<br>

@component('mail::button', ['url' => url('/admin/orders')])
    View Orders
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent