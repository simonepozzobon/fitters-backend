@component('mail::message')
# È arrivato un messaggio dal sito
### Nome: {{ $request->name }}
### Cognome: {{ $request->surname }}
### Oggetto: {{ $request->subject }}
### Messaggio:

@component('mail::panel')
{{ $request->message }}
@endcomponent

@component('mail::button', ['url' => 'mailto:'.$request->email] )
Rispondi
@endcomponent
@endcomponent
