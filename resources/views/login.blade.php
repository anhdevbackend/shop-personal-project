@extends('master')
@section('title','Login Page')
@section('contact')
    <section class="background-radial-gradient overflow-hidden min-vh-100" style="background-color: #45526e">
        <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
            <div class="row gx-lg-5 align-items-center mb-5">
                <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
                    <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                        Welcome Back <br />
                        <span style="color: hsl(218, 73%, 58%)">E-Commerce Store</span>
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
                            <form action="{{route('login')}}" method="post">
                                @csrf

                                <div class="row mb-2">
                                    <h4 style="color: hsl(218, 66%, 61%)">Login your account</h4>
                                </div>

                                <div class="form-outline mb-3">
                                    <label class="form-label w-100 text-start" for="form3Example3">Email address</label>
                                    <input type="email" id="form3Example3" class="form-control" name="email" value="{{old('email')}}" placeholder="Enter your Email"/>
                                    @error('email')
                                        <p class="text-danger mt-2">{{$message}}</p>
                                    @enderror
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label w-100 text-start" for="form3Example4">Password</label>
                                    <input type="password" id="form3Example4" class="form-control" name="password" placeholder="Enter Password"/>
                                    @error('password')
                                        <p class="text-danger mt-2">{{$message}}</p>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary btn-block w-100 mb-4">
                                    LOGIN
                                </button>

                                <!-- Register buttons -->
                                <div class="d-flex flex-row justify-content-center">
                                    <p class="me-1">Don't you have account?</p>
                                    <a href="{{route('auth#registerPage')}}" class="text-danger text-decoration-none ms-1">Sign Up Here</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
