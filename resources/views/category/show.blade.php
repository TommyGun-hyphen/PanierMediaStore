@extends('layouts.app') 
@section('title', $category->name.' - ')
@section('content')
<div class="flex flex-col justify-center text-white uppercase bg-zinc-900 h-40">
    <h2 class="mb-0 font-bold h2 text-center"><a class="hover:text-gray-400" href="{{ url()->previous() }}"><i class="fa-solid fa-arrow-left"></i></a> {{ $category->name }}</h2>
</div>
<div class="container mt-3 col-span-2">
    
    <div>
        <button class="btn btn-primary btn-sm rounded-0 ml-5" type="button" data-bs-toggle="collapse" data-bs-target="#filterCollapse" aria-expanded="false" aria-controls="filterCollapse">Filtrer</button>
        <div class="div border p-3 mt-3 collapse" id="filterCollapse">
            <h4 class="h4">Filtres:</h4>
            <form action="{{ url()->current() }}" method="GET">
                <ul class="grid grid-cols-2">
                    <li class="my-3">prix maximum: <input class="w-3/4 input-sm mr-3 input input-bordered max-w-xs" name="price_max" value="{{ (Request::get('price_max')?Request::get('price_max'):'0' )}}" type="number" id="input_price_max"/><span>DH</span></li>
                    <li class="my-3">sous categories:</li>
                    
                    <li><input type="range" id="range_price_max" value="{{ (Request::get('price_max')?Request::get('price_max'):'0' )}}" min="0" max="20000" class="range range-xs w-4/5 range-primary">
                    </li>
                    
                    <ul>
                        @foreach($subcategories as $subcategory)
                        <li class="block md:inline">
                            <input
                                type="checkbox"
                                name="subcategory[]"
                                value="{{ $subcategory->id }}"
                                id="chk_cat_{{ $subcategory->id }}"
                                class="subcategory-checkbox checkbox checkbox-sm mx-2"
                            />
                            <label
                                for="chk_cat_{{ $subcategory->id }}"
                                class="text-lg"
                                >{{ $subcategory->name }}</label
                            >
                        </li>
                        @endforeach
                    </ul>
                    <br>
                    <button type="submit" class="btn rounded-0 btn-sm mt-3 w-24">Filtrer</button>
                </ul>
            </form>
        
        </div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
        @foreach($products as $product) 
            @include('product.partials.card')
        @endforeach
    </div>
    <br />
    <div class="w-full mx-auto col-span-3 flex justify-center">
        <a
            href="{{ $products->previousPageUrl() }}"
            class="btn btn-sm rounded-0 mx-2"
            ><</a
        >
        <span class="text-lg font-bold">{{ $products->currentPage() }}</span>
        <a
            href="{{ $products->nextPageUrl() }}"
            class="btn btn-sm rounded-0 mx-2"
            >></a
        >
    </div>
        
    </div>
</div>

<script>
$("#range_price_max").on('input', function(){
    if($(this).val() > 0){
        $("#input_price_max").val($(this).val());
    }else{
        $("#input_price_max").val("");
    }
})
$("#input_price_max").on('input', function(){
    $("#range_price_max").val($(this).val());
})
</script>
@endsection
