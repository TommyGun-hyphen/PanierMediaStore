@extends('layouts/admin')

@section('content')

<div class="container mt-4">
    <div class="justify-between flex">
        <h2 class="font-bold h2">sous categorie: {{ $subcategory->name }}</h2>
    </div>
    <div class="border-2 border-indigo-200 overflow-x-auto w-2/3 mx-auto">
      
      <table class="table table-zebra w-full">
        <!-- head -->
        <thead>
          <tr>
            <th></th>
            <th>Name</th>
            <th>slug</th>
            <th>prix</th>
            <th>prix ancien</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <th>{{ $product->id }}</th>
                <td><a class="underline" href="/admin/product/{{ $product->slug }}">{{ $product->name }}</a></td>
                <td>{{ $product->slug }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->price°old }}</td>
                <td>
                  <form action="/admin/subcategory/{{ $subcategory->id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn btn-circle btn-warning btn-sm"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button></td>
                  </form>

                </td>
            </tr>
            @endforeach
        </tbody>
      </table>
    </div>
</div>    

@endsection