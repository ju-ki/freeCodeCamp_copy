@component('mail::message')
# welcome to freecodegram
# Introduction

This is a community of fellow developers and we love that have joined us.

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
