@extends('admin.layouts.master')

@section('content')

<div class="container">
    <h3 style="">Main Dashboard</h3>

    <div class="mt-4 row">
        <div class="col-3">
            <div class="py-2 text-center shadow border-left-secondary card h-100">
                <a href="{{ route('profile#userList') }}" class="text-decoration-none">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col">
                                <div class="text-xs font-weight-bold text-secondary text-uppercase">User Count</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mr-2 col">
                                <div class="mt-1 text-gray-800 h5 font-weight-bold">{{ $userCount }} Users</div>
                            </div>
                            <div class="col">
                                <i class="fa-solid fa-users fa-2x text-secondary"></i>
                            </div>

                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-3">
            <div class="py-2 text-center shadow border-left-secondary card h-100">
                <a href="{{ route('profile#adminList') }}" class="text-decoration-none">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col">
                                <div class="text-xs font-weight-bold text-secondary text-uppercase">Admin Count</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mr-2 col">
                                <div class="mt-1 text-gray-800 h5 font-weight-bold">{{ $adminCount }} Admin</div>
                            </div>
                            <div class="col">
                                <i class="fa-solid fa-user-lock fa-2x text-secondary"></i>
                            </div>

                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-3">
            <div class="py-2 text-center shadow border-left-secondary card h-100">
                <a href="{{ route('admin#orderList',['state' =>'']) }}" class="text-decoration-none">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col">
                                <div class="text-xs font-weight-bold text-secondary text-uppercase">Pending | Success Order</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mr-2 col">
                                <div class="mt-1 text-gray-800 h5 font-weight-bold">{{ $orderCount }} Orders</div>
                            </div>
                            <div class="col">
                                <i class="fa-solid fa-check-double fa-2x text-secondary"></i>
                            </div>

                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-3">
            <div class="py-2 text-center shadow border-left-secondary card h-100">
                <a href="{{ route('admin#orderList',['state' =>'reject']) }}" class="text-decoration-none">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col">
                                <div class="text-xs font-weight-bold text-secondary text-uppercase">Reject Order</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mr-2 col">
                                <div class="mt-1 text-gray-800 h5 font-weight-bold">{{ $rejectCount }} Orders</div>
                            </div>
                            <div class="col">
                                <i class="fa-solid fa-xmark fa-2x text-secondary"></i>
                            </div>

                        </div>
                    </div>
                </a>
            </div>
        </div>

    </div>

    <div class="mt-4 row">
        <div class="col-3">
            <div class="py-2 text-center shadow border-left-secondary card h-100">
                <a href="{{ route('admin#saleInfo') }}" class="text-decoration-none">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col">
                                <div class="text-xs font-weight-bold text-secondary text-uppercase">Total Get Amount</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mr-2 col">
                                <div class="mt-1 text-gray-800 h5 font-weight-bold">{{ $totalOrderSuccessAmount }} mmk</div>
                            </div>
                            <div class="col">
                                <i class="fa-solid fa-cash-register fa-2x text-secondary"></i>
                            </div>

                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-3">
            <div class="py-2 text-center shadow border-left-secondary card h-100">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                      <div class="col">
                        <div class="text-xs font-weight-bold text-secondary text-uppercase">Order Confirm Get Amount</div>
                      </div>
                    </div>
                    <div class="row">
                        <div class="mr-2 col">
                            <div class="mt-1 text-gray-800 h5 font-weight-bold">{{ $totalTransitionAmount}} mmk</div>
                        </div>
                        <div class="col">
                            <i class="fa-solid fa-money-check fa-2x text-secondary"></i>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-3">
            <div class="py-2 text-center shadow border-left-secondary card h-100">
                <a href="{{ route('paymentMethod#list') }}" class="text-decoration-none">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                           <div class="col">
                            <div class="text-xs font-weight-bold text-secondary text-uppercase">Payment Type Count</div>
                           </div>
                        </div>
                        <div class="row">
                            <div class="mr-2 col">
                                <div class="mt-1 text-gray-800 h5 font-weight-bold">{{  $paymentTypeCount}} Types</div>
                            </div>
                            <div class="col">
                                <i class="fa-solid fa-credit-card fa-2x text-secondary"></i>
                            </div>

                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-3">
            <div class="py-2 text-center shadow border-left-secondary card h-100">
                <a href="{{ route('admin#contactList') }}" class="text-decoration-none">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                          <div class="col">
                            <div class="text-xs font-weight-bold text-secondary text-uppercase">Contact Count</div>
                          </div>
                        </div>
                        <div class="row">
                            <div class="mr-2 col">
                                <div class="mt-1 text-gray-800 h5 font-weight-bold">{{ $contactCount}}</div>
                            </div>
                            <div class="col">
                                <i class="fa-solid fa-envelope fa-2x text-secondary"></i>
                            </div>

                        </div>
                    </div>
                </a>
            </div>
        </div>

    </div>


    <div class="mt-4 row">
        <div class="col-3"></div>
        <div class="col-3">
            <div class="py-2 text-center shadow border-left-secondary card h-100">
                <a href="{{ route('admin#saleInfo') }}" class="text-decoration-none">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col">
                                <div class="text-xs font-weight-bold text-secondary text-uppercase">Total Category</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mr-2 col">
                                <div class="mt-1 text-gray-800 h5 font-weight-bold">{{ $categoryCount}} Types</div>
                            </div>
                            <div class="col">
                                <i class="fa-solid fa-list fa-2x text-secondary"></i>
                            </div>

                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-3">
            <div class="py-2 text-center shadow border-left-secondary card h-100">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                      <div class="col">
                        <div class="text-xs font-weight-bold text-secondary text-uppercase">Total Products</div>
                      </div>
                    </div>
                    <div class="row">
                        <div class="mr-2 col">
                            <div class="mt-1 text-gray-800 h5 font-weight-bold">{{ $productCount}} Types</div>
                        </div>
                        <div class="col">
                            <i class="fa-solid fa-list fa-2x text-secondary"></i>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-3"></div>
    </div>
</div>

@endsection