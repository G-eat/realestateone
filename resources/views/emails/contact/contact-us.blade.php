@component('mail::message')
# Introduction

<strong>Name : </strong>{{ $data['name'] }}
<br>
<strong>Email : </strong>{{ $data['email'] }}
<br>
<strong>Subject : </strong>{{ $data['subject'] }}
<br>
<strong>Message : </strong>{{ $data['message'] }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
