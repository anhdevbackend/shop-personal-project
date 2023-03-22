<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>E-Commerce Shop</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="{{asset('user/img/favicon.ico')}}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('user/lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('user/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Box Icons --}}
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('user/css/style.css')}}" rel="stylesheet">

    <script src="https://unpkg.com/feather-icons"></script>
</head>

<body>

    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-1 px-xl-5">
            <div class="d-inline-flex align-items-center h-100">
                <a class="text-body mr-3" href="">About</a>
                <a class="text-body mr-3" href="">Help</a>
                <a class="text-body mr-3" href="">FAQs</a>
                <a class="text-body mr-3" href="">Privacy & Policy</a>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg sticky-top shadow-sm py-2" style="background-color: #45526e">
        <div class="container-fluid">

            <div class="col-lg-3 my-2">
                <span class="h4 text-primary pe-2">E-COMMERCE</span>
                <span class="h4 text-dark bg-primary ml-n1">SHOP</span>
            </div>

            <div class="navbar-toggler ms-2 mb-2" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown">
                <span class="navbar-toggler-icon"></span>
            </div>

            <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                      <a class="nav-link text-light text-decoration-none fs-6 ms-2 me-4" href="{{route('main#homePage')}}" method='get'><i class="fa-solid fa-house me-1"></i>Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light text-decoration-none fs-6 ms-2 me-4" href="{{route('main#contactPage')}}" method="get"><i class="fa-solid fa-message me-1"></i>Contact</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link text-light text-decoration-none dropdown-toggle fs-6 ms-2" data-bs-toggle="dropdown">
                            <i class="fa-solid fa-user me-1"></i>Account
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li>
                                <div class="dropdown-item d-flex align-items-center py-3 ps-4">
                                    <div class="me-2">

                                        @if (Auth::user()->image == null)
                                            <img src="{{asset('admin/images/icon/default_user.png')}}" class="rounded float-end" style="width: 38px">
                                        @else
                                            <img src="{{asset('storage/'. Auth::user()->image)}}" class="rounded-circle shadow-sm
                                             float-end" style="height: 38px; width:38px">
                                        @endif

                                    </div>
                                    <div class="text-dark">{{ Auth::user()->name }}</div>
                                </div>
                            </li>
                            <li>
                                <a class="dropdown-item py-2" href="{{route('account#userProfilePage')}}" method="get">My profile</a>
                            </li>
                            <li>
                                <a class="dropdown-item py-2" href="{{route('account#userChangePasswordPage')}}" method="get">Change password</a>
                            </li>
                            <form action="{{route('logout')}}" method="post">
                                @csrf
                                <button type="submit" class="btn text-start text-danger ps-4 py-2 w-100">Logout</button>
                            </form>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Shop Start -->
    @yield('content')
    <!-- Shop End -->

    <!-- Footer Start -->
    <div class="container-fluid text-secondary pt-2 pt-3" style="background-color: #45526e">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <h5 class="text-secondary text-uppercase mb-4">Get In Touch</h5>
                <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro nemo velit perferendis quidem. Repudiandae suscipit esse.</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>Shwe Gone Daing, Bahan, Yangon</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>yarzarminkhant@gmail.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+959 252250030</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Quick Shop</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Shop Detail</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                            <a class="text-secondary" href="#"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">My Account</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Shop Detail</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                            <a class="text-secondary" href="#"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Newsletter</h5>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aspernatur placeat deleniti!</p>
                        <h6 class="text-secondary text-uppercase mt-4 mb-3">Follow Us</h6>
                        <div class="d-flex">
                            <a class="btn btn-warning btn-square mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-warning btn-square mr-2" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-warning btn-square mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-warning btn-square" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top mx-xl-5 py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-secondary">
                    &copy; <a class="text-primary">Copyright </a>All Rights Reserved. Developed
                    by
                    <a class="text-primary">Rar Zar</a>
                </p>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-warning back-to-top"><i class="fa fa-angle-double-up"></i></a>

</body>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('user/lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('user/lib/owlcarousel/owl.carousel.min.js')}}"></script>

    <!-- Contact Javascript File -->
    <script src="{{asset('user/mail/jqBootstrapValidation.min.js')}}"></script>
    <script src="{{asset('user/mail/contact.js')}}"></script>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

    <!-- Template Javascript -->
    <script src="{{asset('user/js/main.js')}}"></script>

    <script>
        feather.replace()
    </script>

    @yield('ForjQuery')

</html>
