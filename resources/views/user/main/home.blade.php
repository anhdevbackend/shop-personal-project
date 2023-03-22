@extends('user.layouts.master')

@section('content')

<!-- cover start -->
<section class="home mb-4" id="home">
    <div class="slider">
        <figure>
            <img src="https://static.vecteezy.com/system/resources/previews/005/204/026/original/mobile-phone-represent-of-front-of-shop-store-shopping-online-on-website-or-mobile-application-concept-marketing-and-digital-marketing-free-vector.jpg">

            <img src="https://img.freepik.com/free-photo/female-friends-out-shopping-together_53876-25041.jpg">

            <img src="https://static.vecteezy.com/system/resources/previews/005/204/026/original/mobile-phone-represent-of-front-of-shop-store-shopping-online-on-website-or-mobile-application-concept-marketing-and-digital-marketing-free-vector.jpg">

            <img src="https://img.freepik.com/free-photo/female-friends-out-shopping-together_53876-25041.jpg">

            <img src="https://static.vecteezy.com/system/resources/previews/005/204/026/original/mobile-phone-represent-of-front-of-shop-store-shopping-online-on-website-or-mobile-application-concept-marketing-and-digital-marketing-free-vector.jpg">

        </figure>
    </div>

    <!-- cover title -->
    <div class="cover_title">
        <h1 class="text-danger">50% Off First Order</h1>
        <h3>Order the eazy way! The best services for you are avaliable here</h3>
    </div>
</section>
<!-- cover end -->

<div class="container-fluid" id="Main">
    <!-- Shop Product Start -->
    <div class="col-lg-12">
        <div class="row pb-3">
            <div class="col-12 pb-1">
                <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                    <div class="my-1 d-flex flex-row ms-3">
                        <select id="FilterCategory" class="form-select bg-primary me-2">
                            <option value="all">All Categories</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                        <select id="sortingOprion" class="form-select">
                            <option value="">Choose option</option>
                            <option value="asc">Ascending</option>
                            <option value="desc">Descending</option>
                        </select>
                    </div>
                </div>

                <div class="col-12 d-flex justify-content-between mb-3 mt-2">
                    <div class="d-flex flex-row">
                        <a class="nav-link position-relative text-decoration-none fs-4 me-4" style="color: #45526e" href="{{route('products#userProductsCartListPage')}}" method="get">
                            <i class="fa-solid fa-cart-shopping pe-2"></i>
                            <span class="position-absolute top-1 start-100 translate-middle badge rounded-pill bg-danger">
                                {{count($myCarts)}}
                            </span>
                        </a>
                        <a class="nav-link position-relative text-decoration-none fs-4" style="color: #45526e" href="{{route('order#OrderHistoryPage')}}" method="get">
                            <i class="fa fa-history" aria-hidden="true"></i>
                            <span class="position-absolute top-1 start-100 translate-middle badge rounded-pill bg-danger">
                                {{count($myOrderHistory)}}
                            </span>
                        </a>
                    </div>
                    <form action="{{route('main#homePage')}}" class="input-group col-lg-3" method="get">
                        @csrf
                        <input type="text" name='searchKey' class="form-control bg-secondary" placeholder="Search product name . . ." value="{{ request('searchKey') }}">
                        <button class="btn btn-outline-danger" type="submit" >Search</button>
                    </form>
                </div>
            </div>

            <div class="col-12 d-flex justify-content-center">
                <div class="container row" id="productsList">
                    @foreach ($products as $product)
                        <div class="col-md-3 col-sm-6">
                            <div class="product-grid mb-4">
                                <div class="product-image">
                                    <img class="pic-1" src="{{asset('storage/' . $product->image)}}">
                                    <ul class="social">
                                        <li><a href="" data-tip="Add to favorite"><i class="fa fa-heart"></i></a></li>
                                        <li>
                                            <a data-tip="View Detail" href="{{route('products#userProductsViewPage',$product->id)}}" method="get">
                                                <i class="fa-solid fa-circle-info"></i>
                                            </a>
                                        </li>
                                    </ul>
                                    <span class="product-new-label">Sale</span>
                                    <span class="product-discount-label">50%</span>
                                </div>
                                <div class="product-content">
                                    <h3 class="title">{{$product->name}}</h3>
                                    <div class="price">{{$product->price}} MMK
                                        <span>$10.00</span>
                                    </div>
                                    <a class="add-to-cart" href="{{route('main#addToCart',$product->id)}}">+ Add To Cart</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div>
                {{$products->links()}}
            </div>

        </div>
    </div>
    <!-- Shop Product End -->
</div>
@endsection

@section('ForjQuery')
    <script>
        $(document).ready(function(){
            // Sorting Option
            $('#sortingOprion').change(function(){
                $.ajax({
                    type : 'get',
                    data : {
                        'status' : $('#sortingOprion').val()
                    },
                    url : '/ajax/productsSortingList',
                    dataType :'json',
                    success:function(response){
                        // console.log(response[0].name);
                        $list = '';

                        for($i=0 ; $i < response.length; $i++){
                            $list += `
                                    <div class="col-md-3 col-sm-6">
                                        <div class="product-grid mb-4">
                                            <div class="product-image">
                                                <img class="pic-1" src="{{asset('storage/${response[$i].image}')}}">
                                                <ul class="social">
                                                    <li><a href="" data-tip="Add to favorite"><i class="fa fa-heart"></i></a></li>
                                                    <li>
                                                        <a data-tip="View Detail" href="/products/userProductsViewPage,${response[$i].id}" method="get">
                                                            <i class="fa-solid fa-circle-info"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                                <span class="product-new-label">Sale</span>
                                                <span class="product-discount-label">50%</span>
                                            </div>
                                            <div class="product-content">
                                                <h3 class="title">${response[$i].name}</h3>
                                                <div class="price">${response[$i].price} MMK
                                                    <span>$10.00</span>
                                                </div>
                                                <a class="add-to-cart" href="/main/addToCart,${response[$i].id}">+ Add To Cart</a>
                                            </div>
                                        </div>
                                    </div>
                            `;
                        }

                        $('#productsList').html($list);
                    }
                });
            });

            // Filter by Category
            $('#FilterCategory').change(function(){
                $.ajax({
                    type : 'get',
                    data : {
                        'value' : $('#FilterCategory').val()
                    },
                    url : '/ajax/filterCategory',
                    dataType :'json',
                    success:function(response){

                        if(response[0] != null){

                            $list = '';

                            for($i=0 ; $i < response.length; $i++){
                                $list += `
                                        <div class="col-md-3 col-sm-6">
                                            <div class="product-grid mb-4">
                                                <div class="product-image">
                                                    <img class="pic-1" src="{{asset('storage/${response[$i].image}')}}">
                                                    <ul class="social">
                                                        <li><a href="" data-tip="Add to favorite"><i class="fa fa-heart"></i></a></li>
                                                        <li>
                                                            <a data-tip="View Detail" href="/products/userProductsViewPage,${response[$i].id}" method="get">
                                                                <i class="fa-solid fa-circle-info"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                    <span class="product-new-label">Sale</span>
                                                    <span class="product-discount-label">50%</span>
                                                </div>
                                                <div class="product-content">
                                                    <h3 class="title">${response[$i].name}</h3>
                                                    <div class="price">${response[$i].price} MMK
                                                        <span>$10.00</span>
                                                    </div>
                                                    <a class="add-to-cart" href="/main/addToCart,${response[$i].id}">+ Add To Cart</a>
                                                </div>
                                            </div>
                                        </div>
                                `;
                            }

                            $('#productsList').show();
                            $('#productsList').html($list);

                        }else{

                            $('#productsList').hide();

                        }
                    }
                });
            });

        });
    </script>
@endsection
