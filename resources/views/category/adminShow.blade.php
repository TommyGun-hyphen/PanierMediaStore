@extends('layouts/admin')

@section('content')

<div class="container mt-4">
    <div class="justify-between flex">
        <h2 class="font-bold h2">category: {{ $category->name }}</h2>
        <label for="add_modal" class="btn modal-button btn-primary">+ Ajouter une sous categorie</label>
        <input type="checkbox" id="add_modal" class="modal-toggle">
        <div class="modal">
            <div class="modal-box">
                <div class="flex justify-center">
                    <div>
                        <label for="name">Nom du sous categorie</label>
                        <input type="text" id="txt_subcat_name" name="name" placeholder="nom du categorie" class="input input-bordered input-primary w-full max-w-xs">
                        <label class="text-red-500" id="txt_error_cat"></label>
                    </div>
                </div>
                <div class="modal-action">
                    <label class="btn btn-primary" id="btn_add">Ajouter</label>
                    <label for="add_modal" id="btn_close_cat" class="btn">annuler</label>
                </div>
            </div>
        </div>
    
    
      </div>
    <div class="overflow-x-auto w-2/3 mx-auto">
      <div class="flex justify-center">
        <a href="/admin/category/{{ $category->slug }}" class="bg-indigo-300 hover:bg-indigo-400 px-4 py-2 rounded-tl-lg font-semibold">sous categories</a>
        <a href="/admin/category/{{ $category->slug }}/products" class="bg-indigo-200 hover:bg-indigo-300 px-4 py-2 rounded-tr-lg font-semibold">produits</a>
      </div>
      <table class="border-3 border-indigo-300 rounded table table-zebra w-full">
        <!-- head -->
        <thead>
          <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Slug</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
            @foreach ($subcategories as $subcategory)
            <tr>
              <form action="/admin/subcategory/{{ $subcategory->id }}" method="post">
                @method('delete')
                @csrf
                <th>{{ $subcategory->id }}</th>
                <td>{{ $subcategory->name }}</td>
                <td>{{ $subcategory->slug }}</td>
                <td><a class="btn" href="/admin/subcategory/{{ $subcategory->slug }}">produits</a></td>
                <td><div class="card-actions justify-center">
                  <button type="submit" class="ml-auto btn btn btn-circle btn-warning btn-sm"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button></td>
              </form>
            </tr>
            @endforeach
        </tbody>
      </table>
    </div>
</div>    
<script>
  $("#btn_add").on('click', ()=>{
      $.ajax({
          url:'/category/{{ $category->id }}/subcategory',
          method:'POST',
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: {name:$("#txt_subcat_name").val()},
          success:(data, textStatus, xhr)=>{
              $("#btn_close_cat").trigger('click');
             location.reload();
             console.log(data.msg)
          },
          complete:(data, xhr, textStatus)=>{
              $("#txt_error_cat").text(data.responseJSON.msg);
          },
          
      });
  })
  </script>
@endsection