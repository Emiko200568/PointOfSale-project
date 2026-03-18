@extends('admin.layouts.master')

@section('content')
 <!-- Begin Page Content -->
<div class="container-fluid">

    <div class="mb-4 shadow card rounded-4">
        <div class="py-3 bg-white card-header d-flex justify-content-between align-items-center">
            <h6 class="m-0 text-black fw-bold">
                Admin Profile
                <span class="text-white badge bg-secondary ms-2">{{ auth()->user()->role }}</span>
            </h6>
            <a href="{{ route('profile#edit') }}" class="btn btn-outline-secondary btn-sm">Edit Profile</a>
        </div>

        <div class="card-body">
            <div class="row g-4">

                <!-- Profile Image -->
                <div class="text-center col-md-3">
                    <img class="p-1 border shadow-sm img-fluid rounded-circle"
                         src="{{ (auth()->user()->profile && file_exists(public_path('profileImage/' . auth()->user()->profile)))
                             ? asset('profileImage/' . auth()->user()->profile)
                             : asset('default/profile.webp') }}"
                         alt="Profile Image">
                </div>

                <!-- Profile Info -->
                <div class="col-md-9">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <div class="p-3 shadow-sm card rounded-4">
                                <h6 class="mb-1 fw-semibold text-secondary">
                                    <i class="fa-solid fa-file-signature me-2"></i> Name
                                </h6>
                                <p class="mb-0 fw-bold">{{ auth()->user()->name }}</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 shadow-sm card rounded-4">
                                <h6 class="mb-1 fw-semibold text-secondary">
                                    <i class="fa-solid fa-envelope me-2"></i> Email
                                </h6>
                                <p class="mb-0 fw-bold">{{ auth()->user()->email }}</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 shadow-sm card rounded-4">
                                <h6 class="mb-1 fw-semibold text-secondary">
                                    <i class="fa-solid fa-phone me-2"></i> Phone
                                </h6>
                                <p class="mb-0 fw-bold">{{ auth()->user()->phone }}</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 shadow-sm card rounded-4">
                                <h6 class="mb-1 fw-semibold text-secondary">
                                    <i class="fa-solid fa-location-dot me-2"></i> Address
                                </h6>
                                <p class="mb-0 fw-bold">{{ auth()->user()->address }}</p>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="p-3 shadow-sm card rounded-4 d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1 fw-semibold text-secondary">
                                        <i class="fa-solid fa-calendar-plus me-2"></i> Created At
                                    </h6>
                                    <p class="mb-0 fw-bold">{{ auth()->user()->created_at->format('F d, Y - h:i A') }}</p>
                                </div>
                                <a href="{{ route('profile#changePasswordPage') }}" class="py-2 btn btn-dark rounded-pill fw-semibold">
                                    <i class="fa-solid fa-key me-2"></i> Change Password
                                </a>
                            </div>
                        </div>

                    </div> <!-- row g-3 -->
                </div> <!-- col-md-9 -->

            </div> <!-- row g-4 -->
        </div> <!-- card-body -->
    </div> <!-- card shadow -->

</div>
<!-- /.container-fluid -->


@endsection