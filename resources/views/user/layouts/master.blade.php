<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Fruitables - Vegetable Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('user_template/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
    <link href="{{asset('user_template/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('user_template/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('user_template/css/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('user_template/css/custom.css') }}">

</head>

<body>

    <!-- Navbar Start -->
    <div class="shadow-sm container-fluid fixed-top" style="background-color: #ffffff; z-index:1050;">
        <div class="container px-0">
            <nav class="navbar navbar-expand-xl navbar-light">

                <!-- Logo + Brand -->
                <a href="{{ route('user#home') }}" class="navbar-brand d-flex align-items-center">
                    <img src="{{ asset('logo/logo.png') }}" alt="YM Clothing Logo" style="height:170px; width:170px;"
                        class="me-2">
                    {{-- <span class="mb-0 fw-bold text-primary h5">CL - POS Store</span> --}}
                </a>

                <!-- Toggler for mobile -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="fa fa-bars text-primary"></span>
                </button>

                <!-- Navbar links + right icons -->
                <div class="collapse navbar-collapse" id="navbarCollapse"
                    style="background: white; padding: 1rem 2rem;">

                    <ul class="mx-auto mb-2 navbar-nav mb-xl-0">
                        <li class="nav-item">
                            <a class="nav-link fw-medium px-4 py-3 fs-5
                               {{ request()->routeIs('user#home') ? 'border-bottom border-3 border-dark' : '' }}"
                                href="{{ route('user#home') }}">
                                Shop
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link fw-medium px-4 py-3 fs-5
                               {{ request()->routeIs('user#cart') ? 'border-bottom border-3 border-dark' : '' }}"
                                href="{{ route('user#cart') }}">
                                Cart
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link fw-medium px-4 py-3 fs-5
                               {{ request()->routeIs('user#orderList') ? 'border-bottom border-3 border-dark' : '' }}"
                                href="{{ route('user#orderList') }}">
                                Orders
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link fw-medium px-4 py-3 fs-5
                               {{ request()->routeIs('user#contact') ? 'border-bottom border-3 border-dark' : '' }}"
                                href="{{ route('user#contact') }}">
                                Contact
                            </a>
                        </li>
                    </ul>


                    <!-- Right Icons + User -->
                    <div class="d-flex align-items-center">

                        <!-- User Dropdown -->

                        <!-- Right Icons + User -->
                        <div class="d-flex align-items-center">

                            <!-- User Dropdown -->
                            <div class="nav-item dropdown">
                                <a href="#" class="dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown"
                                    style="font-size: 1.1rem; color: #020617;">
                                    <span class="me-2">{{ auth()->user()->name }}</span>
                                    <img src="{{ asset(auth()->user()->profile == null ? 'default/profile.webp' : 'userProfile/' . auth()->user()->profile) }}"
                                        class="rounded-circle" style="width:40px; height:40px; object-fit:cover;"
                                        alt="">
                                </a>

                                <ul class="shadow dropdown-menu dropdown-menu-end rounded-3">

                                    <!-- User Profile -->
                                    <li>
                                        <a class="dropdown-item fw-medium" href="{{ route('user#detail') }}">
                                            User Profile
                                        </a>
                                    </li>

                                    <!-- Change Password -->
                                    <li>
                                        <a class="dropdown-item fw-medium" href="{{ route('user#changePasswordPage') }}">
                                            Change Password
                                        </a>
                                    </li>

                                    <!-- Logout -->
                                    <li>
                                        <form action="{{ route('logout') }}" method="post" class="px-3 py-2">
                                            @csrf
                                            <button type="submit" class="text-white rounded btn w-100"
                                                style="background-color:#ff6b6b; border:none;">
                                                Logout
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>

            </nav>
        </div>
    </div>
    <!-- Navbar End -->


    @yield('content')




    <!-- Footer Start -->
    <div class="pt-5 mt-5 container-fluid" style="background-color:#0f172a; color:#cfd5e0;">
        <div class="container py-5">

            <!-- Newsletter + Brand -->
            <div class="pb-4 mb-4" style="border-bottom: 1px solid rgba(226,175,24,0.3);">
                <div class="row g-4 align-items-center">

                    <!-- Brand -->
                    <div class="text-center col-lg-3 text-lg-start">
                        <a href="{{ route('user#home') }}" class="text-decoration-none">
                            <h1 class="mb-1 fw-bold" style="color:#F5F5DC;">YM CLOTHING</h1>
                            <p class="mb-0 text-muted small">POS Management System</p>
                        </a>
                    </div>



                    <!-- Social Icons -->
                    <div class="col-lg-9 text-lg-end">
                        <a class="btn btn-outline-light btn-sm rounded-circle me-2" href="#"><i
                                class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-sm rounded-circle me-2" href="#"><i
                                class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-sm rounded-circle me-2" href="#"><i
                                class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-sm rounded-circle" href="#"><i
                                class="fab fa-linkedin-in"></i></a>
                    </div>

                </div>
            </div>

            <!-- Footer Links -->
            <div class="row g-5">

                <div class="col-lg-3 col-md-6">
                    <h5 class="mb-3" style="color:#F5F5DC;">Why People Like Us</h5>
                    <p class="small text-muted">Fresh POS management experience for clothing stores. Elegant, fast, and
                        reliable interface.</p>
                    <a href="{{ route('user#readMore') }}" class="px-3 py-1 btn rounded-pill btn-sm"
                        style="background-color:#F5F5DC; color:#0f172a;">Read More</a>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h5 class="mb-3" style="color:#F5F5DC;">Shop Info</h5>
                    <div class="d-flex flex-column">
                        <a class="mb-1 text-muted small" href="#">About Us</a>
                        <a class="mb-1 text-muted small" href="#">Contact Us</a>
                        <a class="mb-1 text-muted small" href="#">Privacy Policy</a>
                        <a class="mb-1 text-muted small" href="#">Terms & Condition</a>
                        <a class="mb-1 text-muted small" href="#">Return Policy</a>
                        <a class="text-muted small" href="#">FAQs & Help</a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h5 class="mb-3" style="color:#F5F5DC;">Account</h5>
                    <div class="d-flex flex-column">
                        <a class="mb-1 text-muted small" href="#">My Account</a>
                        <a class="mb-1 text-muted small" href="#">Shop Details</a>
                        <a class="mb-1 text-muted small" href="#">Shopping Cart</a>
                        <a class="mb-1 text-muted small" href="#">Wishlist</a>
                        <a class="mb-1 text-muted small" href="#">Order History</a>
                        <a class="text-muted small" href="#">International Orders</a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h5 class="mb-3" style="color:#F5F5DC;">Contact</h5>
                    <p class="mb-1 small">Address: 1429 Netus Rd, NY 48247</p>
                    <p class="mb-1 small">Email: example@gmail.com</p>
                    <p class="mb-1 small">Phone: +0123 4567 8910</p>
                    <p class="mb-0 small">Payment Accepted</p>
                </div>

            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="py-3" style="background-color:#0b1221; color:#777;">
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div class="mb-2 small mb-md-0">&copy; 2026 YM Clothing POS. All rights reserved.</div>
            <div class="small">Designed by <a href="{{ route('user#team') }}" class="text-decoration-underline" style="color:#F5F5DC;">YM POS
                    Team</a></div>
        </div>
    </div>

    <!-- Back to Top -->
    <a href="#" class="btn rounded-circle back-to-top position-fixed"
        style="bottom:20px; right:20px; width:45px; height:45px; background-color:#F5F5DC; color:#0f172a;">
        <i class="fa fa-arrow-up"></i>
    </a>




    <!-- JavaScript Libraries -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('user_template/lib/easing/easing.min.js') }}"></script>
    <script src="{{asset('user_template/lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{asset('user_template/lib/lightbox/js/lightbox.min.js')}}"></script>
    <script src="{{asset('user_template/lib/owlcarousel/owl.carousel.min.js')}}"></script>

    {{-- sweet alert package --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('user_template/js/main.js') }}"></script>

    @yield('script-code')

    <script>
        function loadFile(event) {
            var reader = new FileReader()

            reader.onload = function () {
                document.getElementById("output").src = reader.result;

            }
            reader.readAsDataURL(event.target.files[0])
        }
    </script>

</html>