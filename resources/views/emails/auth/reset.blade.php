@component('mail::message')
# Introduction

 Sofra Reset Password.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

<p>Your Reset Code Is :{{$code}}</p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
