@extends('layouts.app') 
@section('title',  $product->name.' - ')
@section('content')
<link rel="stylesheet" href="/css/splide.min.css" />
<style>
#radioBtn .notActive{
    color: #3276b1;
    background-color: #fff;
}
#description-content *{
    margin-top: 10px;
    margin-bottom: 10px;
}
</style>
<div class="container my-5">
    <div class="grid grid-cols-1 lg:grid-cols-2 ">
        <div class="container px-3">
                <div id="main-slider" class="splide">
                        <div class="splide__track">
                            <ul class="splide__list">
                                <li class="splide__slide">
                                    <img src="{{ $product->image_url }}" />
                                </li>
                                @foreach($product->images()->get() as $image)
                                    <li class="splide__slide">
                                        <img src="{{ $image->image_url }}" />
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
            <div id="thumbnail-slider" class="splide">
                <div class="splide__track">
                    <ul class="splide__list">
                        <li class="splide__slide">
                            <img src="{{ $product->image_url }}" />
                        </li>
                        @foreach($product->images()->get() as $image)
                            <li class="splide__slide">
                                <img class="object-cover" src="{{ $image->image_url }}" />
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="my-4">
            <h2 class="h2 uppercase">{{ $product->name }}</h2>
            <h3 class="h3">
                {{ $product->price }} DH
                <span
                    class="text-red-500 line-through"
                    >{{ ($product->price_old)? $product->price_old .' DH' :'' }}</span
                >
            </h3>
            <h5 class="h5 my-4">Condition: {{ ($product->used)?'utilisé':'neuf' }}</h5>
            <h5 class="h5 my-4">Categorie: <a class="underline" href="/category/{{ $product->subCategory()->first()->category()->first()->slug }}">{{ $product->subCategory()->first()->category()->first()->name }}</a></h5>
            <h5 class="h5 my-4">Description:</h5>
            <div id="description-content" class="prose px-5 py-3 my-3 bg-base-200">

            </div>
            <div>
                @if ($product->extragroups()->get()->first())
                    <h3 class="h3">Extras:</h3>
                @endif
                @foreach ($product->extragroups()->get() as $extragroup)
                <div class="input-group my-2">
                    <div id="radioBtn" class="btn-group">
                        <a class="btn btn-primary btn-sm active" data-toggle="extragroup-{{ $extragroup->id }}" data-title="">Non merci</a>
                        @foreach ($extragroup->extras()->get() as $extra)
                        <a class="btn btn-primary btn-sm notActive" data-price="{{ $extra->price }}" data-toggle="extragroup-{{ $extragroup->id }}" data-title="{{ $extra->id }}">{{ $extra->name }}</a>
                        @endforeach
                    </div>
                    <h5 class="h5 mx-3 extra-price"></h5>
                    <input type="hidden" name="extras[]" class="extra" id="extragroup-{{ $extragroup->id }}">
                </div>
                @endforeach
            </div>
            <div class="custom-number-input h-10 w-32 my-4">
              <div class="flex flex-row h-10 w-full rounded-lg relative bg-transparent mt-1">
                <button type="button" data-action="decrement" class=" bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-l cursor-pointer outline-none">
                  <span class="m-auto text-2xl font-thin">−</span>
                </button>
                <input type="number" class="outline-none focus:outline-none text-center w-full bg-gray-300 font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-gray-700  outline-none" name="quantity" value="1" min="1"/>
                <input type="hidden" name="product_id[]" value="{{ $product->id }}">
                <button type="button" data-action="increment" class="bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-r cursor-pointer">
                <span class="m-auto text-2xl font-thin">+</span>
              </button>
              </div>
            </div>
            <button class="btn bg-red-500 hover:bg-red-600 rounded-0 btn-addtocart" data-id="{{ $product->id }}">Ajouter au panier</button>
        </div>
    </div>
</div>
<div id="alert-success" class="hidden fixed right-0 bottom-0 w-full md:w-1/3 alert alert-success shadow-lg">
  <div>
    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
    <span>l'article a été ajouté au panier! <a href="/cart" class="underline">aller au panier</a></span>
  </div>
</div>
<script src="/js/splide.min.js"></script>
<script src="/js/marked.min.js"></script>
<script>
    $('#radioBtn a').on('click', function(){
    var sel = $(this).data('title');
    var tog = $(this).data('toggle');
    $('#'+tog).prop('value', sel);
    if($(this).data('price')){
        $(this).closest('.input-group').find('.extra-price').text("+ " +$(this).data('price') + " DH" );
    }else{
        $(this).closest('.input-group').find('.extra-price').text('');
    }
    $('a[data-toggle="'+tog+'"]').not('[data-title="'+sel+'"]').removeClass('active').addClass('notActive');
    $('a[data-toggle="'+tog+'"][data-title="'+sel+'"]').removeClass('notActive').addClass('active');
})
    $('#description-content').html(marked.parse(`{{ $product->description }}`));
    
    document.addEventListener("DOMContentLoaded", function() {
        var main = new Splide("#main-slider", {
            type: "fade",
            rewind: true,
            pagination: false,
            arrows: false,
            fixedHeight: 400,
            cover: true,
            breakpoints: {
                1030:{
                    fixedHeight: 400
                },
                800: {
                    fixedHeight: 250
                }
            }
        });

        var thumbnails = new Splide("#thumbnail-slider", {
            fixedWidth: 200,
            fixedHeight: 120,
            gap: 10,
            rewind: true,
            pagination: false,
            cover: true,
            isNavigation: true,
            breakpoints: {
                800: {
                    fixedWidth: 120,
                    fixedHeight: 88
                }
            }
        });

        main.sync(thumbnails);
        main.mount();
        thumbnails.mount();
    });
    
</script>
@endsection
