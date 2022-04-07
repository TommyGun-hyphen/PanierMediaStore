@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <h1 class="h1 text-green-600 text-2lg"><i class="fa-solid fa-check"></i></h1>
        <h1 class="h1 text-green-600">Merci
@if (session('fullname'))
, {{ session('fullname') }}
@endif

        </h1>
        <h3 class="h3">nous avons bien reçu votre commande !</h3>
        <h3 class="h3">nous vous contacterons dès que possible.</h3>
        <h5 class="h5">si vous avez des questions <br> appelez-nous au <a class="underline" href="tel:0670-133676">0670-133676</a></h3>
    </div>
@endsection