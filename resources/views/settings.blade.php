@extends('layouts.admin')

@section('content')
<div class="container">
    <form action="/admin/settings/logo" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="image"/>
    <button class="btn btn-primary">Changer le logo</button>
    </form>
    <form action="/admin/settings" method="post">
        @csrf
    <table class="mx-auto table text-center">
        <tr>
            <th>Key</th>
            <th>Value</th>
        </tr>
    @foreach ($settings as $setting)
        <tr>
            <td>{{ $setting->key }}</td>
            <td>
                <input type="text" placeholder="Type here" name="{{ $setting->key }}" value="{{ $setting->value }}" class="input input-sm input-bordered w-full max-w-xs">
            </td>
        </tr>
    @endforeach
    <tr>
        <td></td>
        <td><button class="btn btn-sm btn-primary">enregistrer les paramètres</button></td>
    </tr>
    </table>
    </form>
</div>

@endsection