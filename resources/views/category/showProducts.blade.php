@extends('layouts/app');
@section('content')

    <div class="container">
        <div class="grid grid-cols-4">
            @foreach($products as $product)
            <div class="card w-96 bg-base-100 shadow-xl">
                <figure class="px-10 pt-10">
                    <img src="https://api.lorem.space/image/shoes?w=400&h=225" alt="Shoes" class="rounded-xl" />
                </figure>
                <div class="card-body items-center text-center">
                    <h2 class="card-title">{{ $product->name }}</h2>
                    <p>{{ $product->description }}</p>
                    <div class="card-actions justify-around align-center">
                        <h4 class="font-bold text-green-400">{{ $product->price }}</h4>
                      <button class="btn btn-primary">Buy Now</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

@endsection