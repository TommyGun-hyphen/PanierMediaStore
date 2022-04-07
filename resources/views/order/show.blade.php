@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="my-4">
        <h3 class="h3">ID commande: {{ $order->id }}</h3>
        <h3 class="h3">nom complet: {{ $order->fullname }}</h3>
        <h3 class="h3">telephone: <a class="underline" href="tel{{ $order->phone }}">{{ $order->phone }}</a></h3>
        <h3 class="h3">ville: {{ $order->city }}</h3>
    </div>
    <div class="overflow-x-auto w-full">
            <table class="table w-full">
            <!-- head -->
            <thead>
                <tr>
                <th>produit</th>
                <th>prix</th>
                <th>quantité</th>
                </tr>
            </thead>
            <tbody>
                <!-- row 1 -->
    @foreach ($order->details()->get() as $detail)
                <tr> 
                <td>
                    <div class="flex items-center space-x-3">
                    <div class="avatar">
                        <div class="mask mask-squircle w-24 h-24">
                        <img src="{{ $detail->product()->first()->image_url }}" alt="Avatar Tailwind CSS Component" />
                        </div>
                    </div>
                    <div>
                        <div class="font-bold">{{ $detail->product()->first()->name }}</div>
                        <div class="text-sm opacity-50">{{ $detail->product()->first()->subCategory()->first()->category()->first()->name }}</div>
                    </div>
                    </div>
                </td>
                <td>
                        {{ $detail->price }} DH
                    <br>
                    @foreach ($detail->extras()->get() as $extra)
                    <span class="badge badge-ghost badge-sm">{{ $extra->name }} + {{ $extra->price }} DH</span>
                    @endforeach
                </td>
                <td>{{ $detail->quantity }}</td>
                </tr>
    @endforeach
        
            
        </tbody>
        <!-- foot -->
        <tfoot>
            <tr>
            <th>produit</th>
            <th>prix</th>
            <th>quantité</th>
            </tr>
        </tfoot>
        
        </table>
    </div>
    <div class="flex justify-end">
        <h3 class="h3 mx-5">Total: {{ $order->total }} DH</h3>
    </div>
   
</div>
@endsection