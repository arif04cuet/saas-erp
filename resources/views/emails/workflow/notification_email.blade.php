@component('mail::message')
# {{ $title }}
{{ $message }}
@if($url !== '#')
@component('mail::button', ['url' => $url])
@lang('labels.details')
@endcomponent
@endif
<br>
@lang('labels.thanks'),<br>
{{ config('app.name') }}
@endcomponent