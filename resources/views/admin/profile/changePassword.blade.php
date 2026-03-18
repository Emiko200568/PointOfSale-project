@extends('admin.layouts.master')

@section('content')

<!-- Begin Page Content -->
<div class="py-5 container-fluid">

    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">

            <div class="border-0 shadow-sm card rounded-4">
                <div class="p-4 card-body">

                    <!-- Title -->
                    <div class="mb-4 text-center">
                        <h4 class="fw-bold text-dark">Change Password</h4>
                        <small class="text-muted">Update your account security</small>
                    </div>

                    <form action="{{ route('profile#changePassword') }}" method="post">
                        @csrf

                        <!-- Old Password -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Old Password</label>
                            <input type="password"
                                   name="oldPassword"
                                   class="form-control rounded-pill px-4 @error('oldPassword') is-invalid @enderror"
                                   placeholder="Enter old password">
                            @error('oldPassword')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- New Password -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">New Password</label>
                            <input type="password"
                                   name="newPassword"
                                   class="form-control rounded-pill px-4 @error('newPassword') is-invalid @enderror"
                                   placeholder="Enter new password">
                            @error('newPassword')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Confirm Password</label>
                            <input type="password"
                                   name="confirmPassword"
                                   class="form-control rounded-pill px-4 @error('confirmPassword') is-invalid @enderror"
                                   placeholder="Confirm new password">
                            @error('confirmPassword')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Button -->
                        <div class="text-center d-grid">
                            <button type="submit"
                                    class="py-2 btn btn-dark rounded-pill fw-semibold">
                                Change Password
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>



@endsection

@section('script-code')
<!-- Make sure SweetAlert2 is loaded -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session()->has('success'))
<script>
    document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
            title: "{{ session('success') }}",
            icon: "success",
            timer: 1500,
            timerProgressBar: true,
            draggable: true
        });
    });
</script>
@endif

@if(session()->has('fail'))
<script>
    document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
            title: "{{ session('fail') }}",
            icon: "error",
            timer: 2000,
            timerProgressBar: true,
            draggable: true
        });
    });
</script>
@endif
@endsection