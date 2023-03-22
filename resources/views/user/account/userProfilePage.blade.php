@extends('user.layouts.master')

@section('content')
<div class="container-fluid d-flex flex-column justify-content-center align-items-center py-4 bg-secondary">

    <div class="card text-center mb-3 col-sm-6 pt-2">
        <h4>Your profile information</h4>
    </div>

    <div class="card shadow-sm d-flex flex-column justify-content-center p-4 col-sm-6">

            @if (Auth::user()->image == null)
                <img src="{{asset('admin/images/icon/default_user.png')}}" class="mb-4 rounded float-end" style="width: 140px">
            @else
                <img src="{{asset('storage/'. Auth::user()->image)}}" class="mb-4 rounded-circle shadow-sm float-end" style="height: 140px; width:140px">
            @endif

            <div class="mb-3 d-flex flex-row">
                <h5 class="me-2">Name</h5>
                <p>{{Auth::user()->name}}</p>
            </div>
            <div class="mb-3 d-flex flex-row">
                <h5 class="me-2">Email</h5>
                <p>{{Auth::user()->email}}</p>
            </div>
            <div class="mb-3 d-flex flex-row">
                <h5 class="me-2">Phone</h5>
                <p>{{Auth::user()->phone}}</p>
            </div>
            <div class="mb-3 d-flex flex-row">
                <h5 class="me-2">Address</h5>
                <p>{{Auth::user()->address}}</p>
            </div>
            <a href="{{route('account#userProfileEditPage')}}" class="btn btn-warning rounded">Edit profile</a>
    </div>
</div>
@endsection
