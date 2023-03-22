@extends('user.layouts.master')

@section('content')
    <div class="container-fluid pt-3 pb-3 d-flex flex-row">
        <a href="{{ route('order#OrderHistoryPage') }}">
            <i class='bx bx-arrow-back fs-3 text-dark'></i>
        </a>
        <h4 class="ms-2 text-dark">My Order Products</h4>
    </div>
    <div class="col-lg-12 table-responsive mb-4">
        <table class="table table-borderless table-hover text-center mb-0" style="background-color: rgb(243, 239, 239)">
            <thead class="thead-dark">
                <tr>
                    <th>IMAGE</th>
                    <th>PRODUCT NAME</th>
                    <th>QUANTITY</th>
                    <th>AMOUNT</th>
                    <th>ORDER DATE</th>
                </tr>
            </thead>
            <tbody class="align-middle">
                @foreach ($orderProducts as $orderItems)
                    <tr>
                        <td class="align-middle">
                            <img src="{{asset('storage/' .$orderItems->product_image)}}" class="rounded" style="width: 180px; height: 120px"">
                        </td>
                        <td class="align-middle"> {{$orderItems->product_name}} </td>
                        <td class="align-middle"> {{$orderItems->qty}}</td>
                        <td class="align-middle"> {{$orderItems->total_price}} Kyats </td>
                        <td class="align-middle"> {{$orderItems->created_at->format('d - F - Y')}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-2">
            {{ $orderProducts->links() }}
        </div>
    </div>
@endsection
