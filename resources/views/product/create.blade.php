@extends('layouts/admin')

@section('content')
<style>
    #description-content *{
    margin-top: 10px;
    margin-bottom: 10px;
}
</style>
<div class="container">
    <div class="card w-1/2 text-center mx-auto my-4">
        <div class="cart-title">
            <h2 class="h2 my-2 uppercase">Ajouter un produit</h2>
            
        </div>
        <form action="/admin/product" method="post" enctype="multipart/form-data">
            @csrf
            <table>
                <tr>
                    <td>
                        <label>Nom du produit:</label>
                    </td>
                    <td>
                        <input value="{{ old('name') }}" type="text" placeholder="entrez le nom..." class="my-3 rounded-0 input input-bordered input-primary w-full max-w-xs" name="name">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Description:
                            <button tabindex="-1" type="button" class="btn btn-circle btn-xs btn-neutral" data-bs-toggle="tooltip" data-bs-placement="top" title="Ce champ utilise MarkDown syntax">
                              ?
                            </button>
                        </label>
                    </td>
                    <td>
                        <textarea value="{{ old('description') }}" id="description-textarea" class="textarea textarea-primary w-full" placeholder="description..." name="description">{{ old('description') }}</textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>prix du produit:</label>
                    </td>
                    <td>
                        <input value="{{ old('price') }}" type="text" placeholder="entrez le prix..." class="my-3 rounded-0 input input-bordered input-primary w-full max-w-xs" name="price">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>prix ancien du produit*:</label>
                    </td>
                    <td>
                        <input value="{{ old('price_old') }}" type="text" placeholder="entrez le prix ancien (facultatif)..." class="my-3 rounded-0 input input-bordered input-primary w-full max-w-xs" name="price_old">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>image du produit:</label>
                    </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>categorie:</label>
                    </td>
                    <td>
                        <select class="my-3 select select-primary w-full max-w-xs" name="category" id="category">
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>sous-categorie du produit:</label>
                    </td>
                    <td>
                        <select  class="my-3 select select-primary w-full max-w-xs"  name="sub_category" id="sub_category">
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>condition:</label>
                    </td>
                    <td>
                        <div class="form-check inline">
                            <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="is_used" id="" value="0" checked>
                           neuf
                          </label>
                        </div>
                        <div class="form-check inline">
                            <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="is_used" id="" value="1">
                           utilisé
                          </label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <button type="submit" class="btn btn-primary">Creer</button>
                    </td>
                </tr>
            </table>
            
        </form>
        <h3 class="h3">Apercu description</h3>
        <div id="description-content" class="text-left prose mb-4 px-3">

        </div>
    </div>
    
</div>

<script src="/js/marked.min.js"></script>

<script>
    $("#description-textarea").on('input', function(){
    $('#description-content').html(marked.parse($("#description-textarea").val()));
})
$.ajax({
    url:'/category/'+$("#category").val()+'/subcategory',
    method:'get',
    success:(data, textStatus, xhr)=>{
        console.log(data);
        for(cat of data){
            $("#sub_category").append(`
            <option value="`+cat.id+`" >`+cat.name+`</option>
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