
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
            <div class="card mx-auto w-64 bg-base-100 shadow-xl">
                <figure><img src="{{ $product->image_url }}" alt="Shoes" /></figure>
                <div class="card-body">
                    <h2 class="card-title">
                        {{ $product->name }}
                        <div class="badge badge-secondary">{{ $product->price }}</div>
                    </h2>
                    <p>{{ $product->description }}</p>
                    <div class="card-actions justify-end">
                        <div class="badge badge-outline">{{ $product->subCategory()->first()->category()->first()->name }}</div>
                        
                        <div class="badge badge-outline">>></div>
                        <div class="badge badge-outline">{{ $product->subCategory()->first()->name }}</div>
                    </div>
                </div>
            </div>
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