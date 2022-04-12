@extends('layouts/app') 
@section('title', 'Recherche - ') 
@section('content')

<div class="container mt-3 col-span-2">
   <h2 class="h2 text-center">recherche pour: {{ request()->input('q') }}</h2>
    <div>
        <button
            class="btn btn-primary btn-sm rounded-0 ml-5"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#filterCollapse"
            aria-expanded="false"
            aria-controls="filterCollapse"
        >
            Filtrer
        </button>
        <div class="div border p-3 mt-3 collapse" id="filterCollapse">
            <h4 class="h4">Filtres:</h4>
            <form action="{{ url()->current() }}" method="GET">
                <input type="hidden" name="q" value="{{ request()->input('q') }}">
                <ul class="grid grid-cols-2">
                    <li class="my-3">
                        prix maximum:
                        <input
                            class="w-3/4 input-sm mr-3 input input-bordered max-w-xs"
                            name="price_max"
                            value="{{ (Request::get('price_max')?Request::get('price_max'):'0' )}}"
                            type="number"
                            id="input_price_max"
                        /><span>DH</span>
                    </li>
                    <li class="my-3">categories:</li>
                    <li>
                        <input
                            type="range"
                            id="range_price_max"
                            value="{{ (Request::get('price_max')?Request::get('price_max'):'0' )}}"
                            min="0"
                            max="20000"
                            class="range range-xs w-4/5 range-primary"
                        />
                    </li>

                    <li class="flex flex-col md:flex-row">
                            @foreach($categories as $category)
                            <div class="inline">
                                <div class="inline">
                                    <input
                                        type="checkbox"
                                        name="category[]"
                                        value="{{ $category->id }}"
                                        id="chk_cat_{{ $category->id }}"
                                        class="category-checkbox checkbox mx-2 checkbox-sm"
                                    />
                                    <label
                                        for="chk_cat_{{ $category->id }}"
                                        class="text-lg"
                                        >{{ $category->name }}</label
                                    >
                                    <ul class="hidden ml-2 py-3 px-2 border-l-2">
                                        @foreach($category->subCategories()->get()
                                        as $subCategory)
                                        <li>
                                            <input
                                                type="checkbox"
                                                name="subcategory[]"
                                                value="{{ $subCategory->id }}"
                                                id="chk_subcat_{{ $subCategory->id }}"
                                                class="subcategory-checkbox checkbox checkbox-xs"
                                            />
                                            <label
                                                for="chk_subcat_{{ $subCategory->id }}"
                                                >{{ $subCategory->name }}</label
                                            >
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            @endforeach
                    </li>
                    <button
                        type="submit"
                        class="btn rounded-0 btn-sm mt-3 mx-auto"
                    >
                        Filtrer
                    </button>
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

<script>
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
