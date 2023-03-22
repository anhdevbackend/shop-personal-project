@extends('../admin.layouts.master')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">

        <div class="row">
            <div class="col-3">
                <a href="{{ route('account#adminListPage') }}"><i class='bx bx-arrow-back fs-3 text-primary'></i></a>
            </div>
        </div>

            <div class="container-fluid d-flex flex-column justify-content-center align-items-center">
                <h4 class="text-primary mb-3">Change user to admin</h4>

                @foreach ($user as $thisUser)
                    <form action="{{route('account#userRoleChange')}}" class="card d-flex flex-column justify-content-center p-4 col-sm-6" method="POST">
                        @csrf

                        @if ($thisUser->image == null)
                            <img src="{{asset('admin/images/icon/default_user.png')}}" class="mb-4 rounded float-end" style="width: 140px">
                        @else
                            <img src="{{asset('storage/'. $thisUser->image)}}" class="mb-4 rounded-circle shadow-sm float-end" style="height: 140px; width:140px">
                        @endif

                        <div class="mb-4 d-flex flex-row align-items-center">
                            <h5 class="me-2">Name</h5>
                            <p>{{$thisUser->name}}</p>
                        </div>
                        <div class="mb-4 d-flex flex-row align-items-center">
                            <h5 class="me-2">Email</h5>
                            <p>{{$thisUser->email}}</p>
                        </div>
                        <div class="mb-4 d-flex flex-row align-items-center">
                            <h5 class="me-2">Phone</h5>
                            <p>{{$thisUser->phone}}</p>
                        </div>
                        <div class="mb-4 d-flex flex-row align-items-center">
                            <h5 class="me-2">Address</h5>
                            <p>{{$thisUser->address}}</p>
                        </div>
                        <div class="mb-4 d-flex flex-row align-items-center">
                            <h5 class="me-2">Role</h5>
                            <select name="changeRole" class="form-select">
                                <option name='user'>user</option>
                                <option name='admin'>admin</option>
                            </select>
                        </div>

                        <input type="hidden" name='id' value="{{$thisUser->id}}"></input>

                        <button type="submit" class="btn btn-success">Save change</button>

                    </form>
                @endforeach

            </div>
    </div>
</div>
@endsection
