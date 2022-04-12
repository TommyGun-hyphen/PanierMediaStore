@extends('layouts.admin')

@section('content')
<div class="container grid grid-cols-1 md:grid-cols-2">

<div class="overflow-x-auto w-full m-3">
 <h3 class="h3">les produit les plus visités</h3>
  <table class="table w-full border">
    <!-- head -->
    <thead>
      <tr>
        <th>Produit</th>
        <th>Visites</th>
      </tr>
    </thead>
    <tbody>
      <!-- row 1 -->
      @foreach ($topVisited as $product)
        <tr>
            <td>
            <a href="/admin/product/{{$product->slug}}">
              <div class="flex items-center space-x-3">
                <div class="avatar">
                  <div class="mask mask-squircle w-24 h-24">
                    <img src="{{$product->image_url}}" />
                  </div>
                </div>
                <div>
                  <div class="font-bold">{{$product->name}}</div>
                  <div class="opacity-50">{{$product->price}} DH</div>
                </div>
              </div>
            </a>
            </td>
            <td>
              {{$product->visitLogs()->count();}}
              <br>
            </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

</div>
@endsection