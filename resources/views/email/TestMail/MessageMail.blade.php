@component('mail::message')
# Introduction

The body of your message.
The Laravel Message  Email Test<br>
<hr>
{{$message}}
@component('mail::button', ['url' => url('/')])
Home
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
