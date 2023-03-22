@extends('../admin.layouts.master')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3">
                    <a href="{{ route('category#listPage') }}"><i class='bx bx-arrow-back fs-3 text-primary'></i></a>
                </div>
            </div>
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Create Category</h3>
                        </div>
                        <hr>
                        <form action="{{ route('category#create') }}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-group">
                                <label class="control-label mb-1">Name</label>
                                <input name="categoryName" type="text" class="form-control @error('categoryName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter a creategory name . . .">
                                @error('categoryName')
                                    <p class="text-danger mt-2">{{ $message}}</p>
                                @enderror
                            </div>

                            <div>
                                <button type="submit" class="col-12 btn btn-info">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
