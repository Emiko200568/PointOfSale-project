<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>POS Admin Dashboard</title>

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('admin_template/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper" class="bg-light">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-dark sidebar sidebar-dark accordion position-fixed" id="accordionSidebar">

            <!-- Brand -->
            <a class="py-4 sidebar-brand d-flex align-items-center justify-content-center"
                href="{{ route('admin#home') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <div class="mx-3 sidebar-brand-text fw-bold">YM Clothing</div>
            </a>

            <hr class="my-0 sidebar-divider">

            <!-- Dashboard -->
            <li class="nav-item">
                <a class="nav-link fw-semibold" href="{{ route('admin#home') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Category -->
            <li class="nav-item">
                <a class="nav-link" href="{{ url('admin/category/list') }}">
                    <i class="fa-solid fa-folder-plus"></i>
                    <span>Category</span>
                </a>
            </li>

            <!-- Add Products -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('productCreate#list') }}">
                    <i class="fa-solid fa-box-open"></i>
                    <span>Add Products</span>
                </a>
            </li>

            <!-- Product List -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('product#list') }}">
                    <i class="fa-solid fa-layer-group"></i>
                    <span>Product List</span>
                </a>
            </li>

            @if(auth()->user()->role == 'superadmin')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('paymentMethod#list') }}">
                        <i class="fa-solid fa-credit-card"></i>
                        <span>Payment Method</span>
                    </a>
                </li>
            @endif

            <!-- Sale Info -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin#saleInfo') }}">
                    <i class="fa-solid fa-receipt"></i>
                    <span>Sale Information</span>
                </a>
            </li>

            <!-- Order Board -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin#orderList','') }}">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span>Order Board</span>
                </a>
            </li>

            <!-- Change Password -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('profile#changePasswordPage') }}">
                    <i class="fa-solid fa-lock"></i>
                    <span>Change Password</span>
                </a>
            </li>

            <!-- Contact List -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin#contactList') }}">
                    <i class="fa-regular fa-message"></i>
                    <span>Contact List</span>
                </a>
            </li>

            <!-- Action Logs -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin#actionLogs') }}">
                    <i class="fa-regular fa-calendar-check"></i>
                    <span>Action Logs</span>
                </a>
            </li>


            <hr class="sidebar-divider">
            <!-- Logout -->
            <li class="px-3 mt-2 nav-item">
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-outline-light w-100 rounded-pill fw-semibold">
                        <i class="fa-solid fa-right-from-bracket me-2"></i> Logout
                    </button>
                </form>
            </li>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column" style="margin-left:250px; width: calc(100% - 250px);">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="mb-4 bg-white shadow navbar navbar-expand navbar-light topbar static-top">

                    <!-- Topbar Navbar -->
                    <ul class="ml-auto navbar-nav">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                @if(auth()->check())
                                    <!-- Logged-in user -->
                                    <span class="mr-2 text-gray-600 d-none d-lg-inline small">
                                        Account Name - <b>{{ auth()->user()->name }}</b>
                                    </span>
                                    <img class="img-profile rounded-circle"
                                        src="{{ asset(auth()->user()->image ?? 'default/profile.webp') }}">
                                @else
                                    <!-- Guest fallback -->
                                    <span class="mr-2 text-gray-600 d-none d-lg-inline small">
                                        Account Name - Guest
                                    </span>
                                    <img class="img-profile rounded-circle" src="{{ asset('default/profile.webp') }}">
                                @endif

                            </a>

                            <!-- Dropdown - User Information -->
                            <div class="p-2 shadow dropdown-menu dropdown-menu-end rounded-3"
                                aria-labelledby="userDropdown" style="background-color: white;">

                                <!-- Profile -->
                                <a class="px-3 py-2 rounded dropdown-item d-flex align-items-center text-dark"
                                    href="{{ route('profile#detail') }}">
                                    <i class="fas fa-user fa-sm me-2"></i> Profile
                                </a>

                                @if(auth()->user()->role == 'superadmin')
                                    <!-- Superadmin Options -->
                                    <a class="px-3 py-2 rounded dropdown-item d-flex align-items-center text-dark"
                                        href="{{ route('profile#addNewAdminPage') }}">
                                        <i class="fas fa-cogs fa-sm me-2"></i> Add New Admin Account
                                    </a>
                                    <a class="px-3 py-2 rounded dropdown-item d-flex align-items-center text-dark"
                                        href="{{ route('profile#adminList') }}">
                                        <i class="fas fa-users fa-sm me-2"></i> Admin List
                                    </a>
                                    <a class="px-3 py-2 rounded dropdown-item d-flex align-items-center text-dark"
                                        href="{{ route('profile#userList') }}">
                                        <i class="fas fa-cogs fa-sm me-2"></i> User List
                                    </a>
                                @endif

                                <!-- Change Password -->
                                <a class="px-3 py-2 rounded dropdown-item d-flex align-items-center text-dark"
                                    href="{{ route('profile#changePasswordPage') }}">
                                    <i class="fas fa-lock fa-sm me-2"></i> Change Password
                                </a>

                                <div class="dropdown-divider"></div>

                                <!-- Logout -->
                                <form action="{{ route('logout') }}" method="post" class="px-3">
                                    @csrf
                                    <button type="submit" class="btn btn-dark w-100 rounded-pill">Logout</button>
                                </form>

                            </div>

                        </li>

                    </ul>
                </nav>
                <!-- End of Topbar -->


                <!-- Page Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>


            </div>
        </div>
    </div>




    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('admin_template/vendor/jquery/jquery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('admin_template/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('admin_template/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('admin_template/js/sb-admin-2.min.js')}}"></script>


    {{-- sweet alert package --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



</body>

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