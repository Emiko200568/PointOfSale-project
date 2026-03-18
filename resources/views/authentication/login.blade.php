@extends('authentication.layouts.master')


@section('content')

<div class="container min-vh-100 d-flex align-items-center justify-content-center">
    <div class="overflow-hidden shadow-lg row rounded-4" style="width: 900px;">

        <!-- Left Brand Section -->
        <div class="text-white col-md-6 d-none d-md-flex align-items-center justify-content-center"
             style="background: linear-gradient(135deg, #111827, #1f2937);">
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

        <!-- Login Form Section -->
        <div class="p-5 bg-white col-md-6">
            <h4 class="mb-4 text-center fw-bold">Login to your account</h4>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label small">Email</label>
                    <input type="email"
                           name="email"
                           class="form-control rounded-pill px-4 @error('email') is-invalid @enderror"
                           placeholder="user@ymclothing.com"
                           value="{{ old('email') }}">
                    @error('email')
                        <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label small">Password</label>
                    <input type="password"
                           name="password"
                           class="form-control rounded-pill px-4 @error('password') is-invalid @enderror"
                           placeholder="••••••••">
                    @error('password')
                        <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit"
                        class="py-2 btn btn-dark w-100 rounded-pill">
                    Login
                </button>

                <div class="my-3 text-center text-muted small">
                    OR
                </div>

                <a href="{{ route('social#redirect','google') }}"
                   class="mb-2 btn btn-outline-danger w-100 rounded-pill">
                    <i class="fab fa-google me-2"></i> Login with Google
                </a>

                <a href="{{ route('social#redirect','github') }}"
                   class="btn btn-outline-dark w-100 rounded-pill">
                    <i class="fab fa-github me-2"></i> Login with Github
                </a>

                <hr>

                <div class="mt-4 text-center">
                    <span class="text-muted small">Don’t have an account?</span><br>
                    <a href="{{ route('register') }}"
                       class="text-decoration-none fw-semibold"
                       style="letter-spacing: 1px; color: #020617;">
                        CREATE ACCOUNT
                    </a>
                </div>

            </form>
        </div>

    </div>
</div>

@endsection