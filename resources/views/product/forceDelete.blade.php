@extends('layouts.admin')

@section('content')
    <div class="container mt-4 text-center">
        <h3 class="h3 text-red-500 text-center uppercase">
            attention!
             <br>
             Ne supprimez pas à moins d'être sûr à 100% de votre décision.
             <br>
             cette action supprimera tous les éléments liés à ce produit.
             <br>
                (Details des commandes)
        </h3>
        <h4 class="h4">les commandes suivantes contiennent ce produit:</h4>
        @foreach ($product->orderDetails()->orderBy('created_at', 'DESC')->get() as $detail)
            <h5 class="h5">id: {{ $detail->order()->first()->id }} date: {{ $detail->order()->first()->created_at }}</h5>
        @endforeach
        <form action="/admin/product/{{ $product->id }}/force" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-warning mx-auto">SUPPRIMER</button>
        </form>
        <div class="mt-3 text-center">
            <img class="w-40 h-40 mx-auto object-cover" src="{{ $product->image_url }}">
            <h3 class="h3">{{ $product->name }}</h3>
        </div>
    </div>
@endsection 