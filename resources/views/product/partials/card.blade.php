<div class="hover:shadow-2xl card my-3 rounded-0 mx-auto h-full w-full bg-base-100 shadow-xl">
    <figure>
        {{-- <img class="object-cover" src="" alt="Shoes" /> --}}
        <a a href="/product/{{ $product->slug }}"  class="block m-1 w-full hover:scale-120 h-40 bg-cover bg-center" style="background-image:url({{ $product->image_url }})"></a>
    </figure>
    <div class="card-body flex flex-col justify-between">
        <div class="flex justify-between">
            <a a href="/product/{{ $product->slug }}" class="text-left block h5">
                {{ $product->name }}
            </a>
            <div class="flex flex-col grow">
                <span class=" text-right font-bold whitespace-nowrap">{{ $product->price }} DH </span>
                @if ($product->price_old)
                   <span class="text-slate-400 line-through text-sm text-right font-normal whitespace-nowrap">{{ $product->price_old }} DH</span>
                @endif
            </div>
        </div>
        <div class="card-actions justify-center">
            <a href="/category/{{ $product->subCategory()->first()->category()->first()->slug }}" class="badge badge-outline">{{ $product->subCategory()->first()->category()->first()->name }}</a>
            <div data-id="{{ $product->id }}" class="btn-addtocart rounded-0 btn btn-sm btn-primary">Ajouter Au Panier</div>
        </div>
    </div>
</div>