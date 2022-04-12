@extends('layouts.app') 
@section('title', 'Panier - ')
@section('content')
<div class="container">
<div class="text-center">
    <h1 class="h1">Panier</h1>
    <div class="grid grid-cols-1 md:grid-cols-3">
        <div class="col-span-2 p-4">
            <div class="overflow-x-auto">
                <form action="/cart" method="post">
                    @csrf
                    @method('put')
                <table class="table w-full text-xs md:text-base">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th></th>
                            <th>Produit</th>
                            <th>Prix</th>
                            <th>Quantité</th>
                            <th>Sous-total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                        <tr>
                            {{-- <td><img class="object-cover block h-24 w-24" src="{{ $product->image_url }}" alt="{{ $product->name }}"></td> --}}
                            <td>
                                <button type="button" class="btn btn-circle btn-xs btn_remove_item" data-id="{{ $product->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                </button>
                            </td>
                            <td>
                                <div class="flex items-center space-x-3">
                                  <div class="avatar">
                                    <a href="/product/{{ $product->slug }}" class="mask mask-squircle md:w-24 md:h-24 w-12 h-12">
                                      <img src="{{ $product->image_url }}" alt="Avatar Tailwind CSS Component" />
                                    </a>
                                  </div>
                                  <div>
                                    <a href="/product/{{ $product->slug }}" class="font-bold block">{{ $product->name }}</a>
                                    <a href="/category/{{ $product->subCategory()->first()->Category()->first()->slug }}" class="text-sm opacity-50 underline">{{ $product->subCategory()->first()->Category()->first()->name }}</a>
                                    <br>
                                    <div class="extra-badges">
                                        @foreach ($product->cart_extras as $extra)
                                        <div class="extra-badge badge badge-primary">{{ $extra->extraGroup()->first()->name }}: +{{ $extra->name }} | {{ $extra->price }} DH</div>
                                            <br>
                                        @endforeach
                                    </div>
                                  </div>
                                </div>
                            </td>
                            <td>{{ $product->total }} DH</td>
                            <td>
                                <div class="custom-number-input h-10 w-32">
                                  <div class="flex flex-row h-10 w-full rounded-lg relative bg-transparent mt-1">
                                    <button type="button" data-action="decrement" class=" bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-l cursor-pointer outline-none">
                                      <span class="m-auto text-2xl font-thin">−</span>
                                    </button>
                                    <input type="number" class="outline-none focus:outline-none text-center w-full bg-gray-300 font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-gray-700  outline-none" name="quantity[]" value="{{ $product->quantity }}" min="1"/>
                                    <input type="hidden" name="product_id[]" value="{{ $product->id }}">
                                    <button type="button" data-action="increment" class="bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-r cursor-pointer">
                                    <span class="m-auto text-2xl font-thin">+</span>
                                  </button>
                                  </div>
                                </div>
                                          
                            </td>
                            <td>{{ $product->total * $product->quantity }} DH</td>
                        </tr>
                        @empty
                            <tr>
                                <td></td>
                                <td>
                                	<h5 class="h5">Votre panier est vide!</h6>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
            </table>
            <button disabled type="submit" class="btn bg-red-200 rounded-0" id="btn_update_cart">Mettre a jour le panier</button>
            </form>

            </div>
        </div>
        <div class="">
            <div class="border border-2 border-base-300 p-3">
                <form action="/order" method="post">
                    @csrf
                    <h2 class="h2">Total Panier</h2>
                    <div class="text-left my-3">
                        <h5 class="h5 inline">Sous-total</h5>
                        <span class="float-right text-gray-500">{{ $subtotal }} DH</span>
                        <hr class="clear-both my-2">
                        <h5 class="h5 inline">Expedition</h5>
                        <div class="float-right">
                            <input type="radio" value="local" name="delivery_method" id="local">
                            <label for="local">Tanger-Tetouan</label><br>
                            <span class="text-red-500 float-right">30DH</span>
                            <br>
                            <input checked  type="radio" value="national" name="delivery_method" id="national">
                            <label for="national">Autre villes</label><br>
                            <span class="text-red-500 float-right">50DH</span>
                        </div>
                        <hr class="clear-both  my-2">
                        <h5 class="h5 inline">Total</h5>
                        <span class="float-right text-gray-500 text-lg" id="span-total">{{ $subtotal + 50 }} DH</span>
                    </div>
                    <label for="order_modal" class="btn modal-button bg-red-600 border-red-600 hover:bg-red-700 hover:border-red-700 rounded-0 clear-both">Valider la commande</label>
                    <input type="checkbox" id="order_modal" class="modal-toggle">
                    <div class="modal">
                      <div class="modal-box relative">
                        <label for="order_modal" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                        <h3 class="text-lg font-bold mb-4">Informations</h3>
                        <table class="mx-auto w-full">
                            <tr>
                                <td><label for="">Nom Complet:</label></td>
                                <td><input required type="text" name="fullname" placeholder="entrez votre nom complet..." class="input input-bordered  w-full max-w-xs"></td>
                            </tr>
                            <tr>
                                <td><label for="">telephone:</label></td>
                                <td><input required type="tel" name="phone" placeholder="entrez votre numero de telephone" class="input input-bordered  w-full max-w-xs"></td>
                            </tr>
                            <tr>
                                <td><label for="">ville:</label></td>
                                <td><input required type="text" name="city" placeholder="entrez votre ville" class="input input-bordered  w-full max-w-xs"></td>
                            </tr>
                        </table>
                        <button type="submit" class="btn modal-button bg-red-600 border-red-600 hover:bg-red-700 hover:border-red-700 mt-3 rounded-0">Valider la commande</button>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<div id="alert-success" class="hidden fixed right-0 bottom-0 w-full md:w-1/3 alert alert-success shadow-lg">
  <div>
    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
    <span>l'article a été retiré du panier! <a href="/cart/undo" class="underline">Annuler</a></span>
  </div>
</div>
<script>

$('.btn_remove_item').on('click', function(){
    $.ajax({
        url:'/cart/'+$(this).data('id'),
        type:'DELETE',
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), 
        },
        success:()=>{
            $(this).closest('tr').eq(0).remove();
            $('#alert-success').fadeIn();
            setTimeout(()=>{
                $('#alert-success').fadeOut()
            }, 15000)
        }
    });
});
$('input[name="delivery_method"]').on('click', ()=>{
    let val = $('input[name="delivery_method"]:checked').val();
    let total = {{ $subtotal }} + 30;
    if(val == 'national')
        total = {{ $subtotal }} + 50;
    $('#span-total').text( total + ' DH')
});

</script>
@endsection
