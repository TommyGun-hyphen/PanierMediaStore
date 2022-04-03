@extends('layouts/admin')

@section('content')

<div class="container mt-4">
    <div class="justify-between flex">
        <h2 class="font-bold h2">Categories</h2>
        <label for="add_modal" class="btn modal-button btn-primary">+ Ajouter une categorie</label>

        <input type="checkbox" id="add_modal" class="modal-toggle">
        <div class="modal">
            <div class="modal-box">
                <div class="flex justify-center">
                    <div>
                        <label for="name">Nom du categorie</label>
                        <input type="text" id="txt_cat_name" name="name" placeholder="nom du categorie" class="input input-bordered input-primary w-full max-w-xs">
                        <label class="text-red-500" id="txt_error_cat"></label>
                    </div>
                </div>
                <div class="modal-action">
                    <label class="btn btn-primary" id="btn_add_cat">Ajouter</label>
                    <label for="add_modal" id="btn_close_cat" class="btn">annuler</label>
                </div>
            </div>
        </div>
    </div>
    <div class="overflow-x-auto w-2/3 mx-auto mt-5">
        <table class="table table-zebra w-full rounded border-solid border-2">
          <!-- head -->
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>slug</th>
              <th></th>
              <th></th>
            </tr>
          </thead>
          <tbody id="categories_container">
            @foreach($categories as $category)
            
                <tr>
                    <form action="/category/{{ $category->id }}" method="POST">
                    @method('delete')
                    @csrf
                        <th>{{ $category->id }}</th>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td><a href="/admin/category/{{ $category->slug }}" class="btn">sous categories</a></td>
                        <td><div class="card-actions justify-center">
                                <button type="submit" class="btn btn btn-circle btn-warning btn-sm"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button></td>
                        
                    </form>
                </tr>
            
            @endforeach
          </tbody>
        </table>
    </div>
</div>

<script>
$("#btn_add_cat").on('click', ()=>{
    $.ajax({
        url:'/category',
        method:'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {name:$("#txt_cat_name").val()},
        success:(data, textStatus, xhr)=>{
            $("#btn_close_cat").trigger('click');
           location.reload();
        },
        complete:(data, xhr, textStatus)=>{
            $("#txt_error_cat").text(data.responseJSON.msg);
        },
        
    });
})
</script>
@endsection