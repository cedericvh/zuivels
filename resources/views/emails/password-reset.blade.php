@component('mail::message')
# Paswoord reset

        $url = url('/api/password/find/'.$this->token);
        
        url($url)
            


Bedankt,<br>
{{ config('app.name') }}
@endcomponent