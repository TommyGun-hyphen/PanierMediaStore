<div class="hover:shadow-2xl card mx-auto w-64 bg-base-100 shadow-xl">
    <figure>
        {{-- <img class="object-cover" src="" alt="Shoes" /> --}}
        <a  href="/admin/product/{{ $product->slug }}"  class="w-100 h-48 bg-cover bg-center" style="background-image:url({{ $product->image_url }})"></a>
    </figure>
    <div class="card-body">
        <a  href="/admin/product/{{ $product->slug }}" class="card-title">
            {{ $product->name }}
            <div class="badge badge-secondary">{{ $product->price }}</div>
        </a>
        <div class="card-actions justify-end">
            <div class="badge badge-outline">{{ $product->subCategory()->first()->category()->first()->name }}</div>
        </div>
        <a href="/admin/product/{{ $product->slug }}" class="btn btn-sm btn-primary">Modifier</a>
        <form action="/admin/product/{{ $product->id }}" method="post">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm bg-red-600 border-red-600 hover:bg-red-700 w-full">supprimer</button>
        </form>
    </div>
</div>