@component('mail::message')
# Customer Registered

New customer has been registered!<br>

@component('mail::button', ['url' => url('/admin/users')])
View Users
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent