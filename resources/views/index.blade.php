@extends('layouts/app') 
@section('title', 'Acceuil - ') 
@section('content')
<link rel="stylesheet" href="/css/splide.min.css" />
<style>
.splide__slide img {
  width: 100%;
  object-fit: cover;
  object-position:center center;
  position: relative;
  top:-25%;
  /* transform: translateY(50%) */
}
</style>
<div class="container mt-3 col-span-2">
    <section id="image-carousel" class="splide mx-auto mb-3" aria-label="Beautiful Images">
        <div class="splide__track">
              <ul class="splide__list">
                  
                  @foreach (\App\Models\SliderItem::all() as $item)
                  <li class="splide__slide">
                      <a href="{{ $item->link }}"><img src="{{ $item->image_url }}" alt=""></a>
                  </li>
                  @endforeach
              </ul>
        </div>
    </section>
    {{-- news --}}
    <h3 class="h3 text-center">Nouveates</h3>
    @if (App\Models\Setting::where('key', 'default-news-slider')->first()->value == 'true')
    <section id="news-slider" class="splide mb-3">
      <div class="splide__track">
            <ul class="splide__list">
                @foreach (App\Models\Product::orderBy('created_at', 'DESC')->limit(9)->get() as $product)
                <li class="splide__slide">
                        @include('product.partials.sliderCard')
                </li>
                @endforeach

            </ul>
      </div>
    </section>
    @endif
    {{-- pro and gamer --}}
    @foreach (App\Models\ProductList::all() as $list)
    <h3 class="h3 text-center">{{ $list->name }}</h3>
    <section id="{{ $list->name }}-slider" class="splide mb-3">
      <div class="splide__track">
            <ul class="splide__list">
                @foreach ($list->products()->get() as $product)
                <li class="splide__slide">
                        @include('product.partials.sliderCard')
                </li>
                @endforeach

            </ul>
      </div>
    </section>
    @endforeach
    {{-- <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
        {{-- INCLUDE for each product --}}
    {{-- </div> --}}
    <br />
    
</div>

<div
    id="alert-success"
    class="hidden fixed right-0 bottom-0 w-full md:w-1/3 alert alert-success shadow-lg"
>
    <div>
        <svg
            xmlns="http://www.w3.org/2000/svg"
            class="stroke-current flex-shrink-0 h-6 w-6"
            fill="none"
            viewBox="0 0 24 24"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
            />
        </svg>
        <span
            >l'article a été ajouté au panier!
            <a href="/cart" class="underline">aller au panier</a></span
        >
    </div>
</div>
<script src="/js/splide.min.js"></script>

<script>
    new Splide( '#image-carousel', {
        heightRatio:0.4,
        autoplay: true,
        interval: 5000,
        rewind:true
    } ).mount();

    new Splide('#news-slider', {
        perPage: 5,
        breakpoints: {
            1030: {
                perPage: 4,
            },
            770:{
                perPage:3
            },
            600:{
                perPage:2
            }
  }
    }).mount();
    @foreach(App\Models\ProductList::all() as $list)
    new Splide('#{{ $list->name }}-slider', {
        perPage: 5,
        breakpoints: {
            1030: {
                perPage: 4,
            },
            770:{
                perPage:3
            },
            600:{
                perPage:2
            }
  }
    }).mount();
    @endforeach
    $("#range_price_max").on("input", function () {
        if ($(this).val() > 0) {
            $("#input_price_max").val($(this).val());
        } else {
            $("#input_price_max").val("");
        }
    });
    $("#input_price_max").on("input", function () {
        if ($(this).val()) {
            $("#range_price_max").val($(this).val());
        }
    });
    $(".category-checkbox").on("change", function () {
        let ul = $(this).siblings("ul");
        if ($(this).is(":checked")) {
            ul.show();
        } else {
            ul.hide();
            ul.find("input").prop("checked", false);
        }
    });
</script>
@endsection
