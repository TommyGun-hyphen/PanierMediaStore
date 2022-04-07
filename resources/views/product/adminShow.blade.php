@extends('layouts.admin') @section('content')
<link rel="stylesheet" href="/css/splide.min.css" />
<style>
    #description-content *{
    margin-top: 10px;
    margin-bottom: 10px;
}
</style>
<div class="container">
    <div class="grid grid-cols-1 md:grid-cols-2 p-5 bg-base-200">
        <div class="px-3">
            @if($errors->any())
            <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="/admin/product/{{ $product->id }}" id="form" name="form" method="post">
                @method('put')
                @csrf
                <button tabindex="-1" type="button" class="btn btn-circle btn-xs btn-neutral" data-bs-toggle="tooltip" data-bs-placement="top" title="Ce champ utilise MarkDown syntax">
                    ?
                  </button>
                <table>
                    <tr>
                        <td>
                            <label>Nom du produit:</label>
                        </td>
                        <td>
                            <input type="text" value="{{ $product->name }}" name="name" placeholder="entrez le nom"
                            class="input input-bordered input-primary w-full max-w-xs">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>description du produit:</label>
                        </td>
                        <td>
                            <textarea form="form" id="description-textarea" name="description" class="w-full textarea textarea-primary"
                            placeholder="description">{{ $product->description }}</textarea>
        
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>prix du produit:</label>
                        </td>
                        <td>
                            <input type="numeric" value="{{ $product->price }}" name="price" placeholder="entrez le prix"
                            class="input input-bordered input-primary w-full max-w-xs">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>prix ancien du produit:</label>
                        </td>
                        <td>
                            <input type="numeric" value="{{ $product->price_old }}" name="price_old"
                            placeholder="entrez le prix ancien (facultatif)"
                            class="input input-bordered input-primary w-full max-w-xs">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>image du produit:</label>
                        </td>
                        <td>
                            <div class="flex align-items-center my-3">
                                <img width="100" class="mr-2" src="{{ $product->image_url }}" alt="">
                                <input type="file" name="image" placeholder="Type here">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>categorie:</label>
                        </td>
                        <td>
                            <select name="category" id="category">
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ ( $product->subCategory()->first()->category()->first()->id == $category->id)?'selected':'' }} >{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                        <td>
                            <label>sous-categorie:</label>
                        </td>
                        <td>
                            <select name="sub_category" id="sub_category">
                            </select>
                        </td>
                    </tr>
                    </tr>
                        <td>
                            <label>condition du produit:</label>
                        </td>
                        <td>
                            <label for="is_used">
                                <input type="checkbox" name="is_used" id="is_used" {{ ($product->is_used == 1)?'checked':'' }}
                                    class="checkbox checkbox-md">
                                <span class="label-text">Utilisé</span>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <button class="btn btn-primary" type="submit">Modifier les changements</button>
                        </td>
                    </tr>
                </table>
                
            
               
                
                
                
                {{-- cat --}}
            </form>
        </div>
        <div class="px-1 md:px-5">
            <div>
                <div>
                    <h3 class="h3 inline">extras:</h3>
                    <form action="/admin/product/{{ $product->id }}/extragroup" method="post">
                        @csrf
                        <select name="extragroup_id">
                            @forelse ($extragroups as $extragroup)
                                <option value="{{ $extragroup->id }}">{{ $extragroup->name }}</option>
                            @empty
                                <option disabled>creer des extra groups</option>
                            @endforelse
                        </select>
                        <button type="submit">ajouter</button>
                    </form>
                </div>
                <ul>
                    @foreach ($product->extragroups()->get() as $extragroup)
                        <div class="badge badge-primary p-3">{{ $extragroup->name }}
                            <form action="/admin/product/{{ $product->id }}/extragroup/{{ $extragroup->id }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-xs ml-2 btn-circle">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </ul>
            </div>
            <div>
                <h3 class="h3">Apercu Description</h3>
                <div id="description-content" class="prose">

                </div>
            </div>
            <div>
                <div class="flex justify-between">
                    <h3 class="h3 inline">Images:</h3>
                    <label for="upload_modal" class="btn modal-button btn-primary">+</label>
                </div>

                <!-- Put this part before </body> tag -->
                <input type="checkbox" id="upload_modal" class="modal-toggle">
                <div class="modal">
                    <div class="modal-box relative">
                        <label for="upload_modal" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                        <h3 class="text-lg font-bold">Ajouter des images pour produit {{ $product->name }}</h3>
                        <p class="py-4">Selectionnez une ou plusieurs images</p>
                        <form name="upload_images" enctype="multipart/form-data" action="/admin/product/{{ $product->id }}/image" method="post">
                            @csrf
                            <input type="file" name="images[]" multiple>
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </form>    


                    </div>
                </div>
            </div>
            <div class="mt-4 grid grid-cols-2 md:grid-cols-3">
                @foreach($product->images()->get() as $image)
                <div class="indicator mx-auto">
                    <button data-id="{{ $image->id }}" class="btn_delete_img indicator-item badge badge-secondary">X</button>
                    <div class="grid w-32 h-32 bg-base-300 place-items-center"><img src="{{ $image->image_url }}" alt="">
                    </div>
                </div>
                @endforeach
            </div>
            
        </div>
    </div>

</div>
<script src="/js/marked.min.js"></script>
<script>
// $("form[name='upload_images']").on("submit", function(ev) {
//   ev.preventDefault(); // Prevent browser default submit.

//   var formData = new FormData(this);
    
//   $.ajax({
//     url: "/admin/product/{{ $product->id }}/image",
//     type: "POST",
//     data: formData,
//     success: function (msg) {
//       console.log(msg)
//     },
//     error:function(){
//         console.log('err')
//     }
//     cache: false,
//     contentType: false,
//     processData: false
//   });
    
// });


$("#description-textarea").on('input', function(){
    $('#description-content').html(marked.parse($("#description-textarea").val()));
})
$('#description-content').html(marked.parse($("#description-textarea").text()));
$('.btn_delete_img').on('click', function(){
    var id = $(this).data("id");
    var token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
        url:'/admin/image/'+id,
        type: 'post',
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: {
            "id": id,
            "_token": token,
        },
        success:()=>{
            $(this).closest('.indicator').remove();
        },
    });
});
var oldSubCat = {{ $product->sub_category }};
$.ajax({
    url:'/category/'+$("#category").val()+'/subcategory',
    method:'get',
    success:(data, textStatus, xhr)=>{
        console.log(data);
        for(cat of data){
            let add = '';
            if(cat.id == oldSubCat){
                add = 'selected'
            }
            $("#sub_category").append(`
            <option value="`+cat.id+`" `+add+`>`+cat.name+`</option>
            `);
        }
    },
    complete:(data, xhr, textStatus)=>{
        $("#txt_error_cat").text(data.responseJSON.msg);
    },    
});
$("#category").on('change', function () {
    $.ajax({
    url:'/category/'+$("#category").val()+'/subcategory',
    method:'get',
    success:(data, textStatus, xhr)=>{
        console.log(data);
        $("#sub_category").html('');
        for(cat of data){
            $("#sub_category").append(`
            <option value="`+cat.id+`" >`+cat.name+`</option>
            `);
        }
    },
    error:(data, xhr, textStatus)=>{
        console.log('err')
    },    
});
})
</script>
@endsection