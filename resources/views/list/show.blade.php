@extends('layouts.admin')

@section('content')
<div class="container">
    <h3 class="h3 text-center">Liste des produits: {{ $list->name }}</h3>
    <div class="card rounded-0 w-full md:w-1/2 mx-auto py-4 text-center">
        <label>ajouter un produit au liste</label>
        <form action="/admin/list/{{ $list->id }}" method="post">
            @csrf
            <input name="slug" type="text" placeholder="slug du produit" class="text-black input-sm input input-bordered w-full max-w-xs">
            <button class="btn btn-xs">ajouter</button>
        </form>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-4">
        @foreach ($list->products()->get() as $product)
            <form action="/admin/list/{{ $list->id }}/{{ $product->id }}" method="post">
                @method('DELETE')
                @csrf
                <div class="text-center py-2 border">
                    <button class="btn btn-xs btn-warning mx-auto">supprimer</button>
                    @include('product.partials.sliderCard')
                </div>
            </form>
        @endforeach
    </div>
</div>
@endsection