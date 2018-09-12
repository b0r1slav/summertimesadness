@component('mail::message')

{!! $request['body'] !!}

@component('mail::button', ['url' => config('app.url')])
Go to {{ config('app.name') }}
@endcomponent

@endcomponent
