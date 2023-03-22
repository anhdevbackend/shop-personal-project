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
                            <h3 class="text-center title-2">Change Password</h3>
                        </div>
                        <hr>
                        <form action="{{ route('account#changePassword') }}" method="post" novalidate="novalidate">
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
                                <button type="submit" class="col-12 btn btn-info">change password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
