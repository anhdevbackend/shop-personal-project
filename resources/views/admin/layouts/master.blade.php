<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Dashboard</title>

    <!-- Fontfaces CSS-->
    <link href="{{ asset('admin/css/font-face.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ asset('admin/vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <!-- Vendor CSS-->
    <link href="{{ asset('admin/vendor/animsition/animsition.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/wow/animate.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/css-hamburgers/hamburgers.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/slick/slick.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/select2/select2.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.css')}}" rel="stylesheet" media="all">

    {{-- Fontawesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Box Icons --}}
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Main CSS-->
    <link href="{{asset('admin/css/theme.css')}}" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="p-4 bg-white shadow-sm">
                <h3 class="text-dark">Admin pannel</h3>
            </div>
            <div class="menu-sidebar__content js-scrollbar1 shadow-sm">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">

                        <li class="has-sub">
                            <a class="js-arrow text-decoration-none" href="{{ route('category#listPage') }}">
                                <i class='bx bxs-grid-alt'></i>Category
                            </a>
                        </li>

                        <li class="has-sub">
                            <a class="js-arrow text-decoration-none" href="{{ route('products#productsListPage') }}">
                                <i class='bx bx-food-menu'></i>Products
                            </a>
                        </li>

                        <li class="has-sub">
                            <a class="js-arrow text-decoration-none" href="{{route('order#userOrderListPage')}}">
                                <i class='bx bx-list-ul' style="font-size: 20px"></i>Order List
                            </a>
                        </li>

                        <li class="has-sub">
                            <a class="js-arrow text-decoration-none" href="{{route('account#userListPage')}}">
                                <i class="fa-solid fa-users" style="font-size: 13px"></i>User List
                            </a>
                        </li>

                        <li class="has-sub">
                            <a class="js-arrow text-decoration-none" href="{{route('feedbacks#userFeedbackListPage')}}">
                                <i class="fa-solid fa-message" style="font-size: 13px"></i>User Feedback
                            </a>
                        </li>

                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <div class="form-header">
                                {{-- Search --}}
                            </div>
                            <div class="header-button">
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">

                                            @if (Auth::user()->image == null)
                                                <img src="{{asset('admin/images/icon/default_user.png')}}" class="mb-3 rounded float-end" style="width: 45px">
                                            @else
                                                <img src="{{asset('storage/' . Auth::user()->image)}}" class="mb-3 rounded-circle shadow-sm
                                                 float-end" style="height: 45px; width:45px">
                                            @endif

                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn text-decoration-none" href="#">{{ Auth::user()->name }}</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">

                                                    @if (Auth::user()->image == null)
                                                        <img src="{{asset('admin/images/icon/default_user.png')}}" class="mb-3 rounded float-end" style="width: 55px">
                                                    @else
                                                        <img src="{{asset('storage/'. Auth::user()->image)}}" class="mb-3 rounded-circle shadow-sm
                                                        float-end" style="height: 55px; width:55px">
                                                    @endif

                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a class="text-decoration-none" href="#">{{ Auth::user()->name }}</a>
                                                    </h5>
                                                    <span class="email">{{ Auth::user()->email }}</span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__item">
                                                <a href="{{ route('account#profilePage') }}" class="text-decoration-none">
                                                    <i class="zmdi zmdi-account"></i>Account
                                                </a>
                                            </div>
                                            <div class="account-dropdown__item">
                                                <a href="{{ route('account#adminListPage') }}" class="text-decoration-none">
                                                    <i class="fa-solid fa-user-group" style="font-size: 12px"></i>Admin List
                                                </a>
                                            </div>
                                            <div class="account-dropdown__item">
                                                <a href="{{ route('account#changePasswordPage') }}" class="text-decoration-none">
                                                    <i class="fa-solid fa-key" style="font-size: 14px"></i>Change password
                                                </a>
                                            </div>
                                            <div class="logout_bg py-3 ps-4">
                                                <form action="{{route('logout')}}" method="post">
                                                    @csrf
                                                    <button type="submit">
                                                        <i class="zmdi zmdi-power me-4"></i>Logout
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            @yield('content')
            <!-- END MAIN CONTENT-->

        </div>
        <!-- END PAGE CONTAINER-->

    </div>

</body>

<!-- Jquery JS-->
<script src="{{asset('admin/vendor/jquery-3.2.1.min.js')}}"></script>
<!-- Bootstrap JS-->
<script src="{{asset('admin/vendor/bootstrap-4.1/popper.min.js')}}"></script>
<script src="{{asset('admin/vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
<!-- Vendor JS       -->
<script src="{{asset('admin/vendor/slick/slick.min.js')}}">
</script>
<script src="{{asset('admin/vendor/wow/wow.min.js')}}"></script>
<script src="{{asset('admin/vendor/animsition/animsition.min.js')}}"></script>
<script src="{{asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js')}}">
</script>
<script src="{{asset('admin/vendor/counter-up/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('admin/vendor/counter-up/jquery.counterup.min.js')}}">
</script>
<script src="{{asset('admin/vendor/circle-progress/circle-progress.min.js')}}"></script>
<script src="{{asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
<script src="{{asset('admin/vendor/chartjs/Chart.bundle.min.js')}}"></script>
<script src="{{ asset('admin/vendor/select2/select2.min.js')}}">
</script>

{{-- Box Icons --}}
<script src="https://unpkg.com/boxicons@2.1.3/dist/boxicons.js"></script>

<!-- Main JS-->
<script src="{{ asset('admin/js/main.js')}}"></script>

@yield('ForjQuery')

</html>
<!-- end document-->
