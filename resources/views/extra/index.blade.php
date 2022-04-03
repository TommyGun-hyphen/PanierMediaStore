@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="grid grid-cols-1 md grid-cols-2 w-4/5 md:w-1/2 mx-auto bg-slate-300 p-5 m-5">
        @foreach ($extraGroups as $extraGroup)
            <div class="my-3">
                <h3  class="h3 inline">{{ $extraGroup->name }}</h3>
                <form action="/admin/extragroup/{{ $extraGroup->id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="float-right btn btn-xs btn-circle">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </form>
            </div>
            <ul class="my-3">
                <li><label for="add_extra_modal" class="btn_add_extra btn modal-button btn-xs float-right" data-id="{{ $extraGroup->id }}">+</label></li>

            @foreach ($extraGroup->extras()->get() as $extra)
                <li class="rounded-lg p-3 bg-slate-500 my-3 mx-2">{{ $extra->name }} | {{ $extra->price }} DH
                    <form action="/admin/extra/{{ $extra->id }}" method="post">
                        @csrf
                        @method('DELETE');
                        <button class="float-right btn btn-xs btn-circle">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </form>
                </li>
            @endforeach
            </ul>
            <hr>
            <hr>
        @endforeach
        <label for="add_group_modal" class="btn modal-button col-span-2">Ajouter un Extra Group</label>
        </div>

    </div>
<input type="checkbox" id="add_group_modal" class="modal-toggle">
<div class="modal">
  <div class="modal-box relative">
    <label for="add_group_modal" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
    <form action="/admin/extragroup" method="post">
        @csrf
        <input type="text" name="name" class="input w-full input-primary max-w-xs" placeholder="nom du Extra Group" required>
        <button type="submit" class="btn rounded-0">Ajouter</button>
    </form>
    </div>
</div>

<input type="checkbox" id="add_extra_modal" class="modal-toggle">
<div class="modal">
  <div class="modal-box relative">
    <label for="add_extra_modal" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
    <form action="" id="add_extra_form" method="post">
        @csrf
        <input type="text" name="name" class="input w-full input-primary max-w-xs" placeholder="nom du Extra" required>
        <input type="numeric" name="price" class="input w-full input-primary max-w-xs" placeholder="prix du Extra" required>
        <button type="submit" class="btn rounded-0">Ajouter</button>
    </form>
    </div>
</div>

<script>
$('.btn_add_extra').on('click', function(){
    $('#add_extra_form').attr('action', '/admin/extragroup/'+$(this).data('id')+'/extra');
});
</script>
@endsection