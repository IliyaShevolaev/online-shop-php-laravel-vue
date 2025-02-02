@extends('admin.layout')
@section('content')
    <a href="{{route('orders.index')}}" class="text-decoration-none text-black"><h2>Orders</h2></a>

    <a href="{{route('orders.filter', ['filter' => 1])}}" class="btn btn-success">Closed orders</a>
    <a href="{{route('orders.filter', ['filter' => 0])}}" class="btn btn-danger">Opened orders</a>

    <table class="mt-3 table table-primary">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">UserID</th>
                <th scope="col">Products</th>
                <th scope="col">Quantity</th>
                <th scope="col">Sum</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <th scope="row">{{ $order->id }}</th>
                    <td><a href="{{ route('users.show', $order->user_id) }}">{{ $order->user_id }}</a></td>
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
                    <td>{{ $order->orderSum }}</td>
                    <td>
                        @if ($order->status)
                            <form action="{{ route('orders.close', $order->id) }}" method="POST">
                                @csrf
                                <button type="submit" style="border: none; background: none; cursor: pointer;">
                                    <i class="bi bi-check-circle-fill text-success"></i>
                                </button>
                            </form>
                        @endif

                        @if (!$order->status)
                            <form action="{{ route('orders.close', $order->id) }}" method="POST"\>
                                @csrf
                                <button type="submit" style="border: none; background: none; cursor: pointer;">
                                    <i class="bi bi-check-circle-fill text-danger"></i>
                                </button>
                            </form>
                        @endif

                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
