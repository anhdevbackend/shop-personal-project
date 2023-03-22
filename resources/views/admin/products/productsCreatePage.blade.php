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
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Create Product</h3>
                        </div>
                        <hr>

                        <form action="{{ route('products#productsCreate') }}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="control-label mb-1">Image</label>
                                <input name="productImage" type="file" class="form-control @error('productImage') is-invalid @enderror" aria-required="true" aria-invalid="false">
                                @error('productImage')
                                    <p class="text-danger mt-2">{{ $message}}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="control-label mb-1">Name</label>
                                <input name="productName" value="{{old('productName')}}" type="text" class="form-control @error('productName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter a product name . . .">
                                @error('productName')
                                    <p class="text-danger mt-2">{{ $message}}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="control-label mb-1">Category</label>
                                <select name="categoryForProducts" class="form-select">
                                    <option>Choose your category</option>

                                    @foreach ($categories as $category)
                                        <option name='selectValidation' value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach

                                </select>
                                @error('selectValidation')
                                    <p class="text-danger mt-2">{{ $message}}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="control-label mb-1">Description</label>
                                <textarea name="productDescription" class="form-control @error('productDescription') is-invalid @enderror" aria-required="true" cols="30" rows="5" placeholder="Enter a description . . .">{{old('productDescription')}}</textarea>
                                @error('productDescription')
                                    <p class="text-danger mt-2">{{ $message}}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="control-label mb-1">Price</label>
                                <input name="productPrice" value="{{old('productPrice')}}" type="text" class="form-control @error('productPrice') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter product's price . . .">
                                @error('categoryName')
                                    <p class="text-danger mt-2">{{ $message}}</p>
                                @enderror
                            </div>

                            <div>
                                <button type="submit" class="col-12 btn btn-info">Create product</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
