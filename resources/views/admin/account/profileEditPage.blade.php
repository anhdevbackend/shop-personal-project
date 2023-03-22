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

                <form class="card d-flex flex-column justify-content-center p-4 col-sm-6" action="{{route('account#profileEdit')}}" method="post" enctype="multipart/form-data">
                    @csrf

                    @if (Auth::user()->image == null)
                        <img src="{{asset('admin/images/icon/default_user.png')}}" class="mb-3 rounded float-end" style="width: 140px">
                    @else
                        <img src="{{asset('storage/'. Auth::user()->image)}}" class="mb-3 rounded-circle shadow-sm float-end" style="height: 140px; width:140px">
                    @endif

                        <div class="mb-2 d-flex flex-row align-items-center">
                            <h5 style="width: 100px">Image</h5>
                            <input name="userProfile" type="file" class="form-control" value="{{asset('storage/'. Auth::user()->image)}}"></input>
                        </div>
                        {{-- Error Message --}}
                            <div class="mb-2 d-flex flex-row align-items-center">
                                @error('userProfile')
                                <span style="width: 80px"></span>
                                <p class="text-danger">{{ $message}}</p>
                                @enderror
                            </div>
                        {{-- End Error Message --}}

                        <div class="mb-2 d-flex flex-row align-items-center">
                            <h5 style="width: 100px">Name</h5>
                            <input name="userName" class="form-control" value="{{Auth::user()->name}}"></input>
                        </div>
                        {{-- Error Message --}}
                        <div class="mb-2 d-flex flex-row align-items-center">
                            @error('userName')
                            <span style="width: 80px"></span>
                            <p class="text-danger">{{ $message}}</p>
                            @enderror
                        </div>
                    {{-- End Error Message --}}

                        <div class="mb-2 d-flex flex-row align-items-center">
                            <h5 style="width: 100px">Email</h5>
                            <input name="userEmail" class="form-control" value="{{Auth::user()->email}}"></input>
                        </div>
                        {{-- Error Message --}}
                        <div class="mb-2 d-flex flex-row align-items-center">
                            @error('userEmail')
                            <span style="width: 80px"></span>
                            <p class="text-danger">{{ $message}}</p>
                            @enderror
                        </div>
                    {{-- End Error Message --}}

                        <div class="mb-2 d-flex flex-row align-items-center">
                            <h5 style="width: 100px">Phone</h5>
                            <input name="userPhone" class="form-control" value="{{Auth::user()->phone}}"></input>
                        </div>
                        {{-- Error Message --}}
                        <div class="mb-2 d-flex flex-row align-items-center">
                            @error('userPhone')
                            <span style="width: 80px"></span>
                            <p class="text-danger">{{ $message}}</p>
                            @enderror
                        </div>
                    {{-- End Error Message --}}

                        <div class="mb-2 d-flex flex-row align-items-start">
                            <h5 style="width: 100px">Address</h5>
                            <textarea name="userAddress" class="form-control" cols="30" rows="4">{{Auth::user()->address}}</textarea>
                        </div>
                        {{-- Error Message --}}
                        <div class="mb-2 d-flex flex-row align-items-center">
                            @error('userAddress')
                            <span style="width: 80px"></span>
                            <p class="text-danger">{{ $message}}</p>
                            @enderror
                        </div>
                    {{-- End Error Message --}}

                        <input name="userId" type="hidden" value="{{Auth::user()->id}}"></input>
                        <input type="submit" class="btn btn-primary" value="Save profile">
                </form>

            </div>
    </div>
</div>
@endsection
