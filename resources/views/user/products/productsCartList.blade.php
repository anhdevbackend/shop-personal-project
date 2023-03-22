@extends('user.layouts.master')

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid py-3">
        <a href="{{ route('main#homePage') }}">
            <i class='bx bx-arrow-back fs-3 text-dark'></i>
        </a>
    </div>
    <div class="container-fluid" id="Main">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-4">
                <table class="table table-borderless table-hover text-center mb-0" style="background-color: rgb(236, 234, 234)">
                    <thead class="thead-dark">
                        <tr>
                            <th>Image</th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($cartList as $List)
                            <tr>
                                <td class="align-middle">
                                    <img src="{{asset('storage/' . $List->product_image)}}" class="rounded" style="width: 60px; height: 40px;">
                                </td>
                                <td class="align-middle"> {{$List->product_name}} </td>
                                <td class="align-middle" id="Price"> {{$List->product_price}} Kyats</td>

                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-info btn-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" id="Qtantity" value=" {{$List->qty}} ">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-info btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>

                                <td class="align-middle" id="Total">
                                    {{$List->product_price * $List->qty}} Kyats
                                </td>

                                <td class="align-middle">
                                    <a href="{{route('products#userProductsCartDataClear',$List->id)}}" method="get" class="btn btn-sm btn-danger remove_btn"><i class="fa fa-times"></i></a>
                                </td>

                                {{-- Get Hidden Data --}}
                                <input type="hidden" id="getProductId" value="{{$List->product_id}}">
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-4">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <span class='d-flex flex-row'>
                                <h6 id="Subtotal"> {{$totalPrice}} </h6>
                                <h6 class="ms-1">Kyats</h6>
                            </span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delivery fee</h6>
                            <h6 class="font-weight-medium">2000 Kyats</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total price</h5>
                                {{-- Cartdata များမရှိတော့လျှင် Final Total Price =0 ဖြစ်ရန် --}}
                                @if (count($cartDataCount) != 0)
                                    <h5 id="finalPrice">{{$totalPrice + 2000}} Kyats</h5>
                                @else
                                    <h5 id="finalPrice">0 Kyats</h5>
                                @endif
                        </div>
                        <button class="btn btn-block btn-warning rounded my-3 py-2" id="toOrderBtn">Proceed To Order</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Hidden Get Value User Id --}}
        <input type="hidden" id="getUserId" value="{{Auth::user()->id}}">
    </div>
    <!-- Cart End -->
@endsection

@section('ForjQuery')
    <script src="{{asset('user/js/cartList.js')}}"></script>

    <script>
        $('#toOrderBtn').click(function(){
            $orderList = [];
            $random = Math.floor((Math.random() * 999999999999999999));

            $('#Main tbody tr').each(function(index,row){
                $orderList.push({
                    'userId'    : $('#Main').find('#getUserId').val(),
                    'productId' : $(row).find('#getProductId').val(),
                    'qty'       : Number($(row).find('#Qtantity').val()),
                    'total'     : $(row).find('#Total').text().replace('Kyats',''),
                    'finalTotal': $('#finalPrice').text().replace('Kyats',''),
                    'orderCode' : 'E-Commerce@' + $random
                });
            });

            $.ajax({
                type : 'get',
                url : '/ajax/proceedToOrder',
                data : Object.assign({}, $orderList),
                dataType :'json',
                success : function(response){
                    if(response.status == 'true'){
                        window.location.href = "/main/homePage";
                    }
                }
            });

        });
    </script>
@endsection
