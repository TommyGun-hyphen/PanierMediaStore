@extends('layouts/admin')

@section('content')
<div class="container">
    <div class="card w-1/2 text-center">
        <form action="/admin/product" method="post" enctype="multipart/form-data">
            @csrf
            <input type="text" placeholder="entrez le nom..." class="input input-bordered input-primary w-full max-w-xs" name="name">
            <br>
            <input type="text" placeholder="entrez la description..." class="input input-bordered input-primary w-full max-w-xs" name="description">
            <br>
            <input type="text" placeholder="entrez le prix..." class="input input-bordered input-primary w-full max-w-xs" name="price">
            <br>
            <input type="text" placeholder="entrez le prix ancien (facultatif)..." class="input input-bordered input-primary w-full max-w-xs" name="price_old">
            <br>
            <input type="file" name="image">
            <br>
            <div class="form-control">
                <div class="input-group">
                    <select name="category" id="category">
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-control">
                <div class="input-group">
                    <select name="sub_category" id="sub_category">
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Creer</button>
        </form>
    </div>
</div>


<script>
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