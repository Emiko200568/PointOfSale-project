@extends('admin.layouts.master')

@section('content')

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="rounded shadow-sm card">

                <!-- Header with button -->
                <div class="text-white card-header d-flex justify-content-between align-items-center bg-dark">
                    <h5 class="mb-0">New Admin Account</h5>
                    <a href="{{ route('profile#adminList') }}" class="shadow-sm btn btn-success btn-sm">
                        <i class="fa-solid fa-users me-1"></i> Admin List
                    </a>
                </div>

                <!-- Form Body -->
                <div class="card-body">
                    <form action="{{ route('profile#addNewAdmin') }}" method="post">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Name</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                   class="form-control @error('name') is-invalid @enderror"
                                   placeholder="Enter Name...">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="text" name="email" value="{{ old('email') }}"
                                   class="form-control @error('email') is-invalid @enderror"
                                   placeholder="Enter Email...">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password</label>
                            <input type="password" name="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   placeholder="Enter Password...">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Confirm Password</label>
                            <input type="password" name="confirmPassword"
                                   class="form-control @error('confirmPassword') is-invalid @enderror"
                                   placeholder="Confirm Password...">
                            @error('confirmPassword')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-center d-grid">
                            <button type="submit" class="rounded shadow-sm btn btn-secondary">Create Account</button>
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