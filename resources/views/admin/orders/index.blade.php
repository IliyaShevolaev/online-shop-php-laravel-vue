@extends('admin.layout')
@section('content')
    <h2>Orders</h2>

    <table class="table table-primary">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">UserID</th>
                <th scope="col">Products</th>
                <th scope="col">Quantity</th>
                <th scope="col">Sum</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <th scope="row">{{ $order->id }}</th>
                    <td><a href="{{route('users.show', $order->user_id)}}">{{ $order->user_id }}</a></td>
                    <td>
                        @foreach ($order->productsId as $id)
                            <a href="{{ route('products.show', $id) }}" style="font-size: 20px;">{{ $id }} </a>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($order->productsQuantity as $quantity)
                            {{ $quantity }}
                        @endforeach
                    </td>
                    <td>{{$order->orderSum}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
