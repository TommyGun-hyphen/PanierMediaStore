@extends('layouts.app') @section('content')

<div class="container mt-3 col-span-2">
    <div class="justify-between flex">
        <h2 class="font-bold h2">{{ $category->name }}</h2>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-4">
        <div class="div border p-3">
            <h4 class="h4">Filtres:</h4>
            <form action="/category/{{ $category->slug }}" method="GET">
                <ul class="grid grid-cols-2 lg:grid-cols-1">
                    <li>
                        prix maximum:
                        <input
                            class="input input-bordered max-w-xs"
                            type="number"
                            name="price_max"
                            id="input_price_max"
                            value="{{ Request::get('price_max') }}"
                        /><span>DH</span>
                    </li>
                    <li>
                        <input
                            type="range"
                            id="range_price_max"
                            min="0"
                            max="20000"
                            class="range range-primary"
                            value="{{ Request::get('price_max') ? Request::get('price_max') : '0' }}"
                        />
                    </li>
                    <li>sous categories:</li>
                    <ul>
                        @foreach($subcategories as $subcategory)
                        <li>
                            <input
                                type="checkbox"
                                name="subcategory[]"
                                value="{{ $subcategory->id }}"
                                id="chk_cat_{{ $subcategory->id }}"
                                class="subcategory-checkbox checkbox checkbox-sm"
                            />
                            <label
                                for="chk_cat_{{ $subcategory->id }}"
                                class="text-lg"
                                >{{ $subcategory->name }}</label
                            >
                        </li>
                        @endforeach
                    </ul>
                    <button type="submit" class="btn btn-sm mt-3 mx-auto">
                        Filtrer
                    </button>
                </ul>
            </form>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 col-span-3">
            @foreach($products as $product)
            @include('product.partials.card')
            @endforeach
        </div>
        {{ $products->links() }}
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
