@extends('user.layouts.master')

@section('content')
      <!-- Shop Detail Start -->
      <div class="container-fluid py-3">
        <a href="{{ route('main#homePage') }}">
            <i class='bx bx-arrow-back fs-3 text-dark'></i>
        </a>
      </div>
      <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5">
                <div class="bg-light">
                    <img class="w-100 h-100" src="{{asset('storage/'.$productData->image)}}">
                </div>
            </div>

            <div class="col-lg-7 h-auto">
                <div class="h-100 bg-light p-30">
                    <h3>{{ $productData->name }}</h3>
                    <div class="d-flex mb-2">
                        <p class="pt-1"><i class="fa-solid fa-eye me-1"></i> {{ $productData->view_count + 1 }} Views</p>
                    </div>
                    <h3 class="font-weight-semi-bold mb-4">{{ $productData->price }} Kyats</h3>
                    <p class="mb-4">{{ $productData->description }}</p>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-warning btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control bg-secondary border-0 text-center" value="1" id="countValue">
                            <div class="input-group-btn">
                                <button class="btn btn-warning btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-warning px-3" id="addToCartBtn"><i class="fa fa-shopping-cart mr-1"></i> Add To
                            Cart</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Start Reviews -->
        <div class="row px-xl-5 pt-5">
            <div class="col">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="mb-4" style="color: #404e6b">'{{$productReviews->total()}}' reviews for {{ $productData->name }}</h5>

                            @if ($productReviews->total() != 0)
                                @foreach ($productReviews as $Reviews)
                                    <div class="media mb-2">

                                        <img
                                        src="@if ($Reviews->userImage == null)
                                            {{asset('admin/images/icon/default_user.png')}}
                                        @else
                                            {{asset('storage/' . $Reviews->userImage)}}
                                        @endif"
                                        class="img-fluid mr-3 mt-1" style="width: 45px;">

                                        <div class="media-body">
                                            <h6>{{$Reviews->userName}}<small> - <a style="color: rgb(39, 39, 247)">{{$Reviews->created_at->format('d - F - Y')}}</a></small></h6>
                                            <p>{{$Reviews->reviews}}</p>
                                        </div>
                                    </div>
                                    <hr class="bg-dark">
                                @endforeach
                            @else
                                <div class="w-100 d-flex justify-content-center align-items-center" style="height: 150px">
                                    <p class="text-danger">There is no reviews for this project!</p>
                                </div>
                            @endif
                        <div class="mt-2">
                            {{ $productReviews->links() }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h4 class="mb-4">Leave Your Review</h4>
                        <form action="{{route('products#productReviews')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="message">Your Review *</label>
                                <textarea id="message" name="review" cols="30" rows="4" class="form-control @error('review') is-invalid @enderror">{{old('review')}}</textarea>
                                @error('review')
                                    <p class="text-danger mt-2">{{ $message}}</p>
                                @enderror

                                {{-- Get Hidden Data --}}
                                <input type="hidden" name="productId" value="{{ $productData->id }}">
                            </div>
                            <div class="w-100 text-end">
                                <button type="submit" class="btn btn-warning rounded px-3">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Reviews -->
    </div>
    <!-- Shop Detail End -->

    <!--Get Hidden Data -->
    <div>
        <input type="hidden" value="{{Auth::user()->id}}" id="userId">
        <input type="hidden" value="{{$productData->id}}" id="productId">
        <input type="hidden" value="{{$productData->view_count}}" id="productViewCount">
    </div>

    <!-- Products Start -->
    <div class="container-fluid pb-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach ($productList as $List)
                        <div class="product-grid mb-4">
                            <div class="product-image">
                                <img class="pic-1" src="{{asset('storage/' . $List->image)}}">
                                <ul class="social">
                                    <li><a href="" data-tip="Add to favorite"><i class="fa fa-heart"></i></a></li>
                                    <li>
                                        <a data-tip="View Detail" href="{{route('products#userProductsViewPage',$List->id)}}" method="get">
                                            <i class="fa-solid fa-circle-info"></i>
                                        </a>
                                    </li>
                                </ul>
                                <span class="product-new-label">Sale</span>
                                <span class="product-discount-label">50%</span>
                            </div>
                            <div class="product-content">
                                <h3 class="title">{{$List->name}}</h3>
                                <div class="price">{{$List->price}} MMK
                                    <span>$10.00</span>
                                </div>
                                <a class="add-to-cart" href="{{route('main#addToCart',$List->id)}}">+ Add To Cart</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->

@endsection

@section('ForjQuery')
    <script>
        $(document).ready(function(){
            // Product View Count
            $.ajax({
                type : 'get',
                url  : '/ajax/productViewCount',
                data : {
                    'productId' :  $('#productId').val(),
                    'productViewCount' :  $('#productViewCount').val()
                },
                dataType : 'json'
            })

        // Add to cart
            $('#addToCartBtn').click(function(){
                $source = {
                    'userId' :  $('#userId').val(),
                    'productId' :  $('#productId').val(),
                    'countValue' :  $('#countValue').val()
                }

                $.ajax({
                    type : 'get',
                    url  : '/ajax/addToCart',
                    data : $source,
                    dataType : 'json',
                    success : function(response){
                        if(response.status == 'success'){
                            window.location.href = '/main/homePage';
                        }
                    }
                })
            })
        });
    </script>
@endsection
