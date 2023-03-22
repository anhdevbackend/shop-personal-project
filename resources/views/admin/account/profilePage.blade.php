@extends('../admin.layouts.master')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">

        <div class="row">
            <div class="col-3">
                <a href="{{ route('category#listPage') }}"><i class='bx bx-arrow-back fs-3 text-primary'></i></a>
            </div>
        </div>

            <div class="container-fluid d-flex flex-column justify-content-center align-items-center">
                <div class="card d-flex flex-column justify-content-center p-4 col-sm-6">

                        @if (Auth::user()->image == null)
                            <img src="{{asset('admin/images/icon/default_user.png')}}" class="mb-4 rounded float-end" style="width: 140px">
                        @else
                            <img src="{{asset('storage/'. Auth::user()->image)}}" class="mb-4 rounded-circle shadow-sm float-end" style="height: 140px; width:140px">
                        @endif

                        <div class="mb-4 d-flex flex-row align-items-center">
                            <h5 class="me-2">Name</h5>
                            <p>{{Auth::user()->name}}</p>
                        </div>
                        <div class="mb-4 d-flex flex-row align-items-center">
                            <h5 class="me-2">Email</h5>
                            <p>{{Auth::user()->email}}</p>
                        </div>
                        <div class="mb-4 d-flex flex-row align-items-center">
                            <h5 class="me-2">Phone</h5>
                            <p>{{Auth::user()->phone}}</p>
                        </div>
                        <div class="mb-4 d-flex flex-row align-items-center">
                            <h5 class="me-2">Address</h5>
                            <p>{{Auth::user()->address}}</p>
                        </div>
                        <a href="{{route('account#profileEditPage')}}" class="btn btn-primary">Edit profile</a>
                </div>

            </div>
    </div>
</div>
@endsection
