@extends('layouts.admin')

@section('content')
    <div class="container my-4">
        <div class="grid grid-cols-1 md:grid-cols-3">
            @foreach ($items as $item)
            <div class="card card-compact w-96 bg-base-100 shadow-xl h-full">
              <figure><img src="{{ $item->image_url }}" alt="Shoes" /></figure>
              <div class="card-body">
                <input class="input w-full max-w-xs input-sm" type="text" name="link" value="{{ $item->link }}">
                <div class="card-actions justify-end">
                  <button class="btn btn-primary btn-sm">Modifier</button>
                  <form action="/admin/slider/{{ $item->id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-warning btn-sm">Supprimer</button>
                  </form>
                </div>
              </div>
            </div>
            @endforeach
            <form action="/admin/slider" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card card-compact w-96 bg-base-100 shadow-xl  h-full">
                  <figure class="bg-base-200">
                    <input type="file" name="image" id="image-upload" hidden>
                    <label for="image-upload" class="text-lg h-48 cursor-pointer w-full flex justify-center align-items-center flex-col">
                        <i class="fa-solid fa-circle-plus"></i>
                        <p>selectionnez une photo</p>
                        <span id="file-chosen">No file chosen</span>
                    </label>
                  </figure>
                  <div class="card-body">
                    <input class="input w-full max-w-xs mx-auto input-sm border" placeholder="entrez le lien..." type="text" name="link">
                    <div class="card-actions justify-end">
                      <button class="btn btn-primary btn-sm">ajouter</button>
                    </div>
                  </div>
                </div>
            </form>
        </div>
    </div>

<script>
    const actualBtn = document.getElementById('image-upload');
    const fileChosen = document.getElementById('file-chosen');
    actualBtn.addEventListener('change', function(){
    fileChosen.textContent = this.files[0].name
    })
</script>
@endsection