@extends('authentication.layouts.master')

@section('content')

<div class="container min-vh-100 d-flex align-items-center justify-content-center">
    <div class="overflow-hidden shadow-lg row rounded-4" style="width: 970px;">

        <!-- Left Brand Section -->
        <div class="text-white col-md-6 d-none d-md-flex align-items-center justify-content-center"
             style="background: linear-gradient(160deg, #0f172a, #020617);">
            <div class="px-5 text-center">
                <h1 class="mb-2 fw-semibold" style="letter-spacing:2px;">YM CLOTHING</h1>

                <div class="mx-auto mb-4"
                     style="width:60px;height:2px;background:rgba(255,255,255,.4);"></div>

                <small style="letter-spacing:1px;opacity:.7;">
                    POS MANAGEMENT SYSTEM
                </small> <br>
                <small class="text-muted">Simple. Fast. Reliable.</small>
            </div>
        </div>

        <!-- Register Form -->
        <div class="p-5 bg-white col-md-6">
            <h4 class="mb-4 text-center fw-bold">Create your account</h4>

            <form method="POST" action="{{ url('register') }}">
                @csrf

                <div class="mb-3 row">
                    <div class="mb-3 col-md-6 mb-md-0">
                        <input type="text"
                               name="name"
                               value="{{ old('name') }}"
                               class="form-control rounded-pill px-4 @error('name') is-invalid @enderror"
                               placeholder="Full name">
                        @error('name')
                        <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <input type="text"
                               name="phone"
                               value="{{ old('phone') }}"
                               class="form-control rounded-pill px-4 @error('phone') is-invalid @enderror"
                               placeholder="Phone number">
                        @error('phone')
                        <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <input type="email"
                           name="email"
                           value="{{ old('email') }}"
                           class="form-control rounded-pill px-4 @error('email') is-invalid @enderror"
                           placeholder="Email address">
                    @error('email')
                    <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-4 row">
                    <div class="mb-3 col-md-6 mb-md-0">
                        <input type="password"
                               name="password"
                               class="form-control rounded-pill px-4 @error('password') is-invalid @enderror"
                               placeholder="Password">
                        @error('password')
                        <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <input type="password"
                               name="password_confirmation"
                               class="form-control rounded-pill px-4 @error('password_confirmation') is-invalid @enderror"
                               placeholder="Confirm password">
                        @error('password_confirmation')
                        <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <button type="submit"
                        class="py-2 btn btn-dark w-100 rounded-pill">
                    Create Account
                </button>
            </form>

            <div class="mt-4 text-center">
                <span class="text-muted small">Already have an account?</span><br>
                <a href="{{ route('login') }}"
                   class="text-decoration-none fw-semibold"
                   style="letter-spacing:1px;color:#020617;">
                    LOGIN
                </a>
            </div>
        </div>

    </div>
</div>


@endsection