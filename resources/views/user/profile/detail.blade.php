@extends('user.layouts.master')

@section('content')


<div class="container py-5" style="margin-top: 100px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="border-0 shadow-lg card rounded-4">
                <div class="p-5 card-body">

                    <!-- Profile Header -->
                    <div class="mb-4 d-flex align-items-center">
                        <img src="{{ auth()->user()->profile && file_exists(public_path('userProfile/' . auth()->user()->profile))
                            ? asset('userProfile/' . auth()->user()->profile)
                            : asset('default/profile.webp') }}"
                            class="border-2 shadow-sm img-profile rounded-circle" id="output"
                            width="120" height="120" alt="Profile">
                        <div class="ms-4">
                            <h4 class="mb-1 fw-bold">{{ auth()->user()->name }}</h4>
                            <small class="text-muted">Member since {{ auth()->user()->created_at->format('F d, Y') }}</small>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- User Info -->
                    <div class="mb-3 row">
                        <div class="col-sm-4 fw-semibold text-secondary">Email:</div>
                        <div class="col-sm-8">{{ auth()->user()->email }}</div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-4 fw-semibold text-secondary">Phone:</div>
                        <div class="col-sm-8">{{ auth()->user()->phone }}</div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-4 fw-semibold text-secondary">Address:</div>
                        <div class="col-sm-8">{{ auth()->user()->address ?? '-' }}</div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-4 fw-semibold text-secondary">Created:</div>
                        <div class="col-sm-8">{{ auth()->user()->created_at->format('F d, Y - h:i A') }}</div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="gap-3 mt-4 d-flex justify-content-end">
                        <a href="{{ route('user#edit') }}"
                           class="px-4 py-2 btn btn-primary rounded-pill"
                           style="background-color:#f7f7c6; border:none; color:#0f172a;">
                            Edit Profile
                        </a>
                        <a href="{{ route('user#changePasswordPage') }}"
                           class="px-4 py-2 btn btn-outline-secondary rounded-pill">
                            Change Password
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('script-code')
@if (Session::has('success'))
<script>
    Swal.fire({
        title: "Profile Update success!",
        icon: "success",
        timer: 1300,
        timerProgressBar: true,
        draggable: true,
        showConfirmButton: false
    }).then(() => {
        window.location.href = "{{ route('user#detail') }}";
    });
</script>
@endif
@endsection