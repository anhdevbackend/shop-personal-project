@extends('../admin.layouts.master')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="table-data__tool col-12">
                <div class="table-data__tool-left">
                    <div class="overview-wrap">
                        <h2 class="title-1">Products List</h2>
                    </div>
                </div>
                <div class="table-data__tool-right">
                    <a href="{{ route('products#productsCreatePage')}}">
                        <button class="btn btn-primary">
                            <i class="zmdi zmdi-plus me-1"></i>add product
                        </button>
                    </a>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-2">
                <form action="{{ route('products#productsListPage') }}" class="input-group col-6" method="get">
                    @csrf
                    <input type="text" name='searchKey' class="form-control" placeholder="Search product name . . ." value="{{request('searchKey')}}">
                    <button class="btn btn-outline-danger" type="submit" >Search</button>
                </form>

                <p class="text-primary fs-5 me-4">
                    Total Products - {{ $products->total() }}
                </p>
            </div>

            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-responsive table-responsive-data2">

                    @if ($products->total() != 0)
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>IMAGE</th>
                                    <th>NAME</th>
                                    <th>CATEGORY</th>
                                    <th>PRICE</th>
                                    <th>VIEWS</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($products as $product)
                                    <tr class="tr-shadow">
                                        <td>
                                            <img src="{{asset('storage/'. $product->image)}}" class="img-thumbnail" style="width: 180px; height: 120px">
                                        </td>

                                        <td>
                                            <span>{{ $product->name }}</span>
                                        </td>

                                        <td>
                                            {{ $product->category_name }}
                                        </td>

                                        <td class="desc">{{ $product->price }} MMK</td>

                                        <td>{{ $product->view_count }} Views</td>

                                        <td>
                                            <div class="table-data-feature">

                                                <a href="{{route('products#productsEditPage',$product->id)}}" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </a>

                                                &nbsp;&nbsp;

                                                <a href="{{route('products#delete',$product->id)}}" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="zmdi text-danger zmdi-delete"></i>
                                                </a>

                                                &nbsp;&nbsp;

                                                <a href="{{route('products#productsViewPage',$product->id)}}" class="item" data-toggle="tooltip" data-placement="top" title="Detail">
                                                    <i class="zmdi zmdi-more"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="spacer"></tr>

                                @endforeach
                            </tbody>
                        </table>

                    @else
                        <div class="col-12 d-flex align-items-center justify-content-center" style="height: 300px">
                            <p class="text-danger">There is no products !</p>
                        </div>
                    @endif

                    <div class="mt-2">
                        {{ $products->links() }}
                    </div>

                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection
