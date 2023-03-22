@extends('../admin.layouts.master')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="container-fluid d-flex flex-column justify-content-center align-items-center">
                <form action="{{route('order#manageOrderStatus')}}" method="post" class="card d-flex flex-column justify-content-center p-4 col-sm-6">
                    @csrf
                        <p class="title-4 mb-4">Order Info</p>
                        <div class="mb-4 d-flex flex-row align-items-center">
                            <h5 class="me-2" style="width: 120px">User ID</h5>
                            <p>{{$orderInfoData->user_id}}</p>
                        </div>
                        <div class="mb-4 d-flex flex-row align-items-center">
                            <h5 class="me-2" style="width: 120px">Name</h5>
                            <p>{{$orderInfoData->user_name}}</p>
                        </div>
                        <div class="mb-4 d-flex flex-row align-items-center">
                            <h5 class="me-2" style="width: 120px">User Address</h5>
                            <p> {{$orderInfoData->user_address}} </p>
                        </div>
                        <div class="mb-4 d-flex flex-row align-items-center">
                            <h5 class="me-2" style="width: 120px">User Phone</h5>
                            <p>{{$orderInfoData->user_phone}}</p>
                        </div>
                        <div class="mb-4 d-flex flex-row align-items-center">
                            <h5 class="me-2" style="width: 120px">Order Code</h5>
                            <a class="text-primary">{{$orderInfoData->order_code}}</a>
                        </div>
                        <div class="mb-4 d-flex flex-row align-items-center">
                            <h5 class="me-2" style="width: 120px">Order Date</h5>
                            {{$orderInfoData->created_at->format('d - F - Y')}}
                        </div>
                        <div class="mb-4 d-flex flex-row align-items-center">
                            <h5 class="me-2" style="width: 120px">Total Amount</h5>
                            <p>{{$orderInfoData->final_total_price}} Kyats</p>
                        </div>
                        <div class="mb-4 d-flex flex-row align-items-center">
                            <h5 class="me-2" style="width: 180px">Status</h5>
                            <select class="form-select" name="manageStatus">
                                <option value="0" @if ($orderInfoData->status == 0 ) selected @endif>Pending Order</option>
                                <option value="1" @if ($orderInfoData->status == 1 ) selected @endif>Accept Order</option>
                                <option value="2" @if ($orderInfoData->status == 2 ) selected @endif>Reject Order</option>
                            </select>
                        </div>

                        {{-- Get Hidden Data --}}
                        <input type="hidden" name="orderCode" value="{{$orderInfoData->order_code}}">

                        <button type="submit" class="btn btn-primary">Save Status</button>
                </form>
            </div>

            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>IMAGE</th>
                                <th>PRODUCT NAME</th>
                                <th>QUANTITY</th>
                                <th>AMOUNT</th>
                                <th>ORDER DATE</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($orderProducts as $orderItems)
                                <tr class="tr-shadow">
                                    <td> <img src="{{asset('storage/' .$orderItems->product_image)}}" class="img-thumbnail" style="width: 180px; height: 120px"> </td>
                                    <td> {{$orderItems->product_name}} </td>
                                    <td> {{$orderItems->qty}} </td>
                                    <td> {{$orderItems->total_price}} Kyats</td>
                                    <td> {{$orderItems->created_at->format('d - F - Y')}} </td>
                                </tr>
                                <tr class="spacer"></tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection
