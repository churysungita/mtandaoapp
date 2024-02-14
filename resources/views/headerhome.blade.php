<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>MAcademy - Mtandao Academy</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
  <div class="container-fluid d-none d-lg-block">
    <div class="row align-items-center py-4 px-xl-5">
        <div class="col-lg-3">
            <a href="{{ url('home') }}" style="display: block; text-align: center;">
                <img src="admin/assets/images/mtandao2.png" alt="logo" style="max-width: 100%; height: auto;">
            </a>
        </div>

        @if ($officeContacts)
            @foreach ($officeContacts as $officeContact)
                <div class="col-lg-3 text-right">
                    <div class="d-inline-flex align-items-center">
                        <i class="fa fa-2x fa-map-marker-alt text-primary mr-3"></i>
                        <div class="text-left">
                            <h6 class="font-weight-semi-bold mb-1">Our Office</h6>
                            <small>{{ $officeContact->address }}, {{ $officeContact->location }}</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 text-right">
                    <div class="d-inline-flex align-items-center">
                        <i class="fa fa-2x fa-envelope text-primary mr-3"></i>
                        <div class="text-left">
                            <h6 class="font-weight-semi-bold mb-1">Email Us</h6>
                            <small>{{ $officeContact->email }}</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 text-right">
                    <div class="d-inline-flex align-items-center">
                        <i class="fa fa-2x fa-phone text-primary mr-3"></i>
                        <div class="text-left">
                            <h6 class="font-weight-semi-bold mb-1">Call Us</h6>
                            <small>{{ $officeContact->phone }}</small>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>


        <!-- Topbar End -->


        <!-- Navbar Start -->
        <div class="container-fluid">
            <div class="row border-top px-xl-5">

                <div class="col-lg-9">
                    <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                        <a href="{{ url('/') }}" class="text-decoration-none d-block d-lg-none">
                            <h1 class="m-0"><span class="text-primary">M</span>Academy</h1>
                        </a>
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                            <div class="navbar-nav py-0">
                                <a href="{{ url('/') }}" class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }} ">Home</a>
                                <a href="{{ url('aboutUs') }}" class="nav-item nav-link  {{ request()->is('aboutUs') ? 'active' : '' }}">About</a>
                                <a href="{{ url('notes')}}" class="nav-item nav-link  {{ request()->is('notes') ? 'active' : '' }} ">Notes</a>
                                <a href="{{ url('videos')}}" class="nav-item nav-link {{ request()->is('videos') ? 'active' : '' }}">Videos</a>

                                <a href="{{('contactUs')}}" class="nav-item nav-link  {{ request()->is('contactUs') ? 'active' : '' }}">Contact</a>
                            </div>

                            @if (Route::has('login'))
                            @auth

                            <x-app-layout>

                            </x-app-layout>


                            @else
                            <a class="btn btn-primary py-2 px-4 ml-auto d-none d-lg-block" href="{{route('login')}}">Login</a>

                            <a class="btn btn-primary py-2 px-4 ml-auto d-none d-lg-block" href="{{route('register')}}">Register</a>
                            @endauth
                            @endif
                        </div>
                    </nav>
                </div>
            </div>
        </div>
