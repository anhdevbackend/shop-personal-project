@extends('../admin.layouts.master')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3">
                    <a href="{{ route('products#productsListPage') }}"><i class='bx bx-arrow-back fs-3 text-primary'></i></a>
                </div>
            </div>

            <div class="container-fluid d-flex justify-content-center">
                <div class="w-75 card">
                    <div class="w-100 py-4">
                        <h3 class="text-center title-2">Product Details</h3>
                    </div>

                    @foreach ($productData as $product)
                    <div class="w-100 d-flex justify-content-center">
                        {{-- Left --}}
                        <form class="p-3 w-50">
                            <label class="control-label mb-2">Image</label>
                            <img src="{{asset('storage/' . $product->image)}}" class="img-thumbnail mb-4" style="width: 100%; height: 200px">
                            <a href="{{route('products#productsEditPage',$product->id)}}" class="col-12 btn btn-primary">Edit product</a>
                        </form>
                        {{-- Right --}}
                        <div class="p-3 w-75">
                            <form>

                                <div class="form-group">
                                    <label class="control-label mb-1">Name</label>
                                    <p class="text-muted">{{$product->name}}</p>
                                </div>

                                <hr>

                                <div class="form-group">
                                    <label class="control-label mb-1">Category</label>
                                    <p class="text-muted">{{$product->category_name}}</p>
                                </div>

                                <hr>

                                <div class="form-group">
                                    <label class="control-label mb-1">Price</label>
                                    <p class="text-primary">{{$product->price}} MMK</p>
                                </div>

                                <hr>

                                <div>
                                    <label class="control-label mb-1">Description</label>
                                    <p class="text-muted">{{$product->description}}</p>
                                </div>

                            </form>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
