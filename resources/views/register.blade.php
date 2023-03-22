@extends('master')
@section('title','Register Page')
@section('contact')
    <section class="background-radial-gradient overflow-hidden" style="background-color: #45526e">
        <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
            <div class="row gx-lg-5 align-items-center mb-5">
                <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
                    <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                        Welcome our <br />
                        <span style="color: hsl(218, 81%, 75%)">E-Commerce Store</span>
                    </h1>
                    <p class="mb-4 opacity-70" style="color: hsl(218, 81%, 85%)">
                        What do you want? Buy everything you want in one place without wasting time.We are offering a 50% discount for the first order of any item.
                    </p>
                </div>

                <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
                    <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
                    <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>

                    <div class="card bg-glass">
                        <div class="card-body px-3 py-5 px-md-5">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="row mb-2">
                                    <h4 style="color: hsl(218, 81%, 75%)">Create new account</h4>
                                </div>

                                <div class="form-outline mb-3">
                                    <label class="form-label w-100 text-start" for="form3Example3">Name</label>
                                    <input type="text" id="form3Example3" class="form-control" name="name" value="{{old('name')}}" placeholder="Enter your name"/>
                                    @error('name')
                                        <p class="text-danger mt-2">{{$message}}</p>
                                    @enderror
                                </div>

                                <div class="form-outline mb-3">
                                    <label class="form-label w-100 text-start" for="form3Example3">Email address</label>
                                    <input type="email" id="form3Example3" class="form-control" name="email" value="{{old('email')}}" placeholder="Enter your email"/>
                                    @error('email')
                                        <p class="text-danger mt-2">{{$message}}</p>
                                    @enderror
                                </div>

                                <div class="form-outline mb-3">
                                    <label class="form-label w-100 text-start" for="form3Example3">Phone</label>
                                    <input type="number" id="form3Example3" class="form-control" name="phone" value="{{old('phone')}}" placeholder="Enter your phone"/>
                                    @error('phone')
                                        <p class="text-danger mt-2">{{$message}}</p>
                                    @enderror
                                </div>

                                <div class="form-outline mb-3">
                                    <label class="form-label w-100 text-start" for="form3Example3">Address</label>
                                    <input type="text" id="form3Example3" class="form-control" name="address" value="{{old('address')}}" placeholder="Enter your address"/>
                                    @error('address')
                                        <p class="text-danger mt-2">{{$message}}</p>
                                    @enderror
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label w-100 text-start" for="form3Example4">Password</label>
                                    <input type="password" id="form3Example4" class="form-control" name="password" placeholder="Enter password"/>
                                    @error('password')
                                        <p class="text-danger mt-2">{{$message}}</p>
                                    @enderror
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label w-100 text-start" for="form3Example4">Confirm password</label>
                                    <input type="password" id="form3Example4" class="form-control" name="password_confirmation" placeholder="Retype Password"/>
                                    @error('password_confirmation')
                                        <p class="text-danger mt-2">{{$message}}</p>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary btn-block w-100 mb-4">
                                    SIGN UP
                                </button>

                                <!-- Register buttons -->
                                <div class="d-flex flex-row justify-content-center">
                                    <p class="me-1">Have already an account?</p>
                                    <a href="{{route('auth#loginPage')}}" class="text-danger text-decoration-none ms-1">Login your account</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
