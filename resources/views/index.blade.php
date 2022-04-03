@extends('layouts/app')
@section('title', 'PanierMedia')
@section('content')

<div class="container mt-3 col-span-2">
        <div class="grid grid-cols-1 lg:grid-cols-4">
            <div class="div border p-3">
                <h4 class="h4">Filtres:</h4>
                <form action="{{ url()->current() }}" method="GET">
                    <ul class="grid grid-cols-2 lg:grid-cols-1">
                        <li>prix maximum: <input class="input input-bordered max-w-xs" name="price_max" type="number" id="input_price_max"/><span>DH</span></li>
                        <li><input type="range" id="range_price_max" value="{{ Request::get('price_max') }}"  min="0" max="20000" value="0" class="range range-primary">
                        </li>
                        <li>categories:</li>
                        <ul>
                            @foreach($categories as $category)
                            <li>
                                <input type="checkbox" name="category[]" value="{{ $category->id }}"
                                    id="chk_cat_{{ $category->id }}" class="category-checkbox checkbox checkbox-sm">
                                <label for="chk_cat_{{ $category->id }}" class="text-lg">{{ $category->name }}</label>
                                <ul class="hidden ml-2 py-3 px-2 border-l-2">
                                    @foreach($category->subCategories()->get() as $subCategory)
                                    <li>
                                        <input type="checkbox" name="subcategory[]" value="{{ $subCategory->id }}"
                                            id="chk_subcat_{{ $subCategory->id }}"
                                            class="subcategory-checkbox checkbox checkbox-xs">
                                        <label for="chk_subcat_{{ $subCategory->id }}">{{ $subCategory->name }}</label>
                                    </li>
                                    @endforeach
                                </ul>
                            </li>
                            @endforeach
                        </ul>
                        <button type="submit" class="btn btn-sm mt-3 mx-auto">Filtrer</button>
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
    <div id="alert-success" class="hidden fixed right-0 bottom-0 w-full md:w-1/3 alert alert-success shadow-lg">
      <div>
        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        <span>l'article a été ajouté au panier! <a href="/cart" class="underline">aller au panier</a></span>
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
    if($(this).val()){
        $("#range_price_max").val($(this).val());
    }
})
$('.category-checkbox').on('change', function(){
    let ul = $(this).siblings('ul');
    if($(this).is(':checked')){
        ul.show()
    }else{
        ul.hide()
        ul.find('input').prop('checked', false);
    }
});
</script>
@endsection