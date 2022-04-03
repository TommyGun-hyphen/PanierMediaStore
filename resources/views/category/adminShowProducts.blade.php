@extends('layouts/admin')

@section('content')

<div class="container mt-4">
    <div class="justify-between flex">
        <h2 class="font-bold h2">category: {{ $category->name }}</h2>
        <label for="add_cat_modal" class="btn modal-button btn-primary">+ Ajouter une sous categorie</label>
    </div>
    <div class="border-2 border-indigo-200 overflow-x-auto w-2/3 mx-auto">
      <div class="flex justify-center">
        <a href="/admin/category/{{ $category->slug }}" class="bg-indigo-200 hover:bg-indigo-300 px-4 py-2 rounded-tl-lg font-semibold">sous categories</a>
        <a href="/admin/category/{{ $category->slug }}/products" class="bg-indigo-300 hover:bg-indigo-400 px-4 py-2 rounded-tr-lg font-semibold">produits</a>
      </div>
      <table class="table table-zebra w-full">
        <!-- head -->
        <thead>
          <tr>
            <th></th>
            <th>Name</th>
            <th>slug</th>
            <th>description</th>
            <th>prix</th>
            <th>prix ancien</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <th>{{ $product->id }}</th>
                <td>{{ $product->name }}</td>
                <td>{{ $product->slug }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->price°old }}</td>
                <td><div class="card-actions justify-center">
                    <button type="submit" class="btn btn btn-circle btn-warning btn-sm"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button></td>
            </tr>
            @endforeach
        </tbody>
      </table>
    </div>
</div>    

@endsection