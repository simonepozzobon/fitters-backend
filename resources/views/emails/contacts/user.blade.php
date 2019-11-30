@component('mail::message')
# Grazie {{ $request->name }} {{ $request->surname }} per averci contattato!
Ti risponderemo il prima possibile.

### Oggetto: {{ $request->subject }}
### Messaggio:
@component('mail::panel')
{{ $request->message }}
@endcomponent
@endcomponent
