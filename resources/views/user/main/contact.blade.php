@extends('user.layouts.master')

@section('content')
    <!-- Contact Start -->
    <div class="container-fluid pt-3 pb-2">
        <a href="{{ route('main#homePage') }}">
            <i class='bx bx-arrow-back fs-3 text-dark'></i>
        </a>
    </div>
    <div class="container-fluid">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Contact Us</span></h2>
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-5">
                <div class="bg-light p-30 mb-30">
                    <iframe style="width: 100%; height: 250px;"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3001156.4288297426!2d-78.01371936852176!3d42.72876761954724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ccc4bf0f123a5a9%3A0xddcfc6c1de189567!2sNew%20York%2C%20USA!5e0!3m2!1sen!2sbd!4v1603794290143!5m2!1sen!2sbd"
                    frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
                <div class="bg-light p-30 mb-3">
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>Shwe Gone Daing, Bahan, Yangon</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>yarzarminkhant@gmail.com</p>
                    <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>+959 252250030</p>
                </div>
            </div>

            <div class="col-lg-7 mb-5">
                <div class="contact-form bg-light p-30">
                    <div class="pb-2">
                        <h4>Contact Us</h4>
                        <p class="text-info">Your email address will not be published. Required fields are marked *</p>
                    </div>
                    <form name="sentMessage" action="{{route('main#userContact')}}" method="POST">
                        @csrf
                        <div class="control-group">
                            <input type="text" name="userName" value="{{old('userName')}}" class="form-control" placeholder="Please enter your name"/>
                            @error('userName')
                                <p class="text-danger mt-1">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="control-group my-3">
                            <input type="email" name="userEmail" value="{{old('userEmail')}}" class="form-control" placeholder="Please enter your email"/>
                            @error('userEmail')
                                <p class="text-danger mt-1">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="control-group mb-3">
                            <textarea class="form-control" name="userMessage" rows="8" placeholder="Please enter your message">{{old('userMessage')}}</textarea>
                            @error('userMessage')
                                <p class="text-danger mt-1">{{$message}}</p>
                            @enderror
                        </div>
                        @if (session('contactToast'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <span>{{session('contactToast')}}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div>
                            <button class="btn btn-warning rounded py-2 px-4" type="submit">Send
                                Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection
