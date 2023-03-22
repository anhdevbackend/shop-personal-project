@extends('user.layouts.master')

@section('content')

<div class="container-fluid d-flex flex-column justify-content-center align-items-center py-4 bg-secondary">
    <div class="card shadow-sm d-flex flex-column justify-content-center col-sm-6">
        <div class="card-body">

            <div class="card-title">
                <h4 class="text-center title-2">Change your password</h4>
            </div>
            <hr>

            <form action="{{ route('account#userChangePassword') }}" method="post" novalidate="novalidate">
                @csrf
                <div class="form-group">
                    <label class="control-label mb-1">Old Password</label>
                    <input name="oldPassword" type="password" class="form-control @error('oldPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter your old password . . .">
                    @error('oldPassword')
                        <p class="text-danger mt-2">{{ $message}}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="control-label mb-1">New Password</label>
                    <input name="newPassword" type="password" class="form-control @error('newPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter a new password . . .">
                    @error('newPassword')
                        <p class="text-danger mt-2">{{ $message}}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="control-label mb-1">Comfirm password</label>
                    <input name="comfirmPassword" type="password" class="form-control @error('comfirmPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter comfirm password . . .">
                    @error('comfirmPassword')
                        <p class="text-danger mt-2">{{ $message}}</p>
                    @enderror
                </div>

                <div>
                    <button type="submit" class="col-12 btn btn-warning rounded">change password</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
