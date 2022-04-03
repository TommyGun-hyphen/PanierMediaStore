<div class="hover:shadow-2xl card mx-auto w-64 bg-base-100 shadow-xl">
    <figure>
        {{-- <img class="object-cover" src="" alt="Shoes" /> --}}
        <a a href="/product/{{ $product->slug }}"  class="w-100 h-48 bg-cover bg-center" style="background-image:url({{ $product->image_url }})"></a>
    </figure>
    <div class="card-body">
        <a a href="/product/{{ $product->slug }}" class="card-title">
            {{ $product->name }}
            <div class="badge badge-secondary">{{ $product->price }}</div>
        </a>
        <div class="card-actions justify-end">
            <div class="badge badge-outline">{{ $product->subCategory()->first()->category()->first()->name }}</div>
            <div data-id="{{ $product->id }}" class="btn-addtocart btn btn-sm btn-primary">Ajouter Au Panier</div>
        </div>
    </div>
</div>