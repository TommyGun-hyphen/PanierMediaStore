@extends('layouts.admin')

@section('content')
<div class="container">
    <h3 class="h3 text-center">Listes des produits</h3>
    <ul class="menu w-80 mx-auto bg-slate-200 p-3">
    @forelse ($lists as $list)
        <li>
            <div class="w-full">
                <a class="w-full" href="/admin/list/{{ $list->id }}">{{ $list->name }}</a>
                <form  action="/admin/list/{{ $list->id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-xs btn-warning float-right">X</button>
                </form>
            </div>
        </li>
    @empty
        <li class="disabled"><a>aucune liste</a></li>
    @endforelse
        <li class="disabled">
        <form action="/admin/list" method="post">
            @csrf
            <input name="name" type="text" placeholder="nom du liste" class="text-black input-sm input input-bordered w-full max-w-xs">
            <button class="btn btn-xs">ajouter</button>
        </form>
        </li>
    </ul>
        
</div>
@endsection