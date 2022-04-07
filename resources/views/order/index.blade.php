@extends('layouts.admin')

@section('content')
<div class="container">
    <h3 class="h3 text-center mt-3">COMMANDES</h3>
    <div class="overflow-x-auto">
            <table class="table w-full">
              <!-- head -->
              <thead>
                <tr>
                  <th>id</th>
                  <th>nom complet</th>
                  <th>telephone</th>
                  <th>ville</th>
                  <th>total(sans livraison)</th>
                  <th>faite le</th>
                  <th>details</th>
                  <th>supprimer</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($orders as $order)
                <tr>
                  <th>{{ $order->id }}</th>
                  <td>{{ $order->fullname }}</td>
                  <td><a class="underline" href="tel:{{ $order->phone }}">{{ $order->phone }}</a></td>
                  <td>{{ $order->city }}</td>
                  <td>{{ $order->total }} DH</td>
                  <td>{{ $order->created_at }}</td>
                  <td><a href="/admin/order/{{ $order->id }}" class="btn btn-xs">details</a></td>
                  <td>
                    <form action="/admin/order/{{ $order->id }}" method="post">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-xs btn-circle">X</button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
    <div class="flex justify-center">
        <a href="{{ $orders->previousPageUrl() }}" class="btn btn-sm rounded-0 mx-2"><</a>
        <a href="{{ $orders->nextPageUrl() }}" class="btn btn-sm rounded-0 mx-2">></a>
    </div>
</div>
@endsection