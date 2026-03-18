@extends('user.layouts.master')

@section('content')
<div class="container py-5" style="margin-top:100px;">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="border-0 shadow-lg card rounded-4">
                <div class="p-5 card-body">

                    <h4 class="mb-4 text-center fw-bold">Change Password</h4>

                    <form action="{{ route('user#changePassword') }}" method="POST">
                        @csrf

                        <!-- Current Password -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Current Password</label>
                            <input type="password"
                                   name="current_password"
                                   class="form-control rounded-pill px-4 py-2 @error('current_password') is-invalid @enderror"
                                   placeholder="Enter current password">
                            @error('current_password')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- New Password -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">New Password</label>
                            <input type="password"
                                   name="new_password"
                                   class="form-control rounded-pill px-4 py-2 @error('new_password') is-invalid @enderror"
                                   placeholder="Enter new password">
                            @error('new_password')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Confirm New Password -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Confirm New Password</label>
                            <input type="password"
                                   name="new_password_confirmation"
                                   class="px-4 py-2 form-control rounded-pill"
                                   placeholder="Confirm new password">
                        </div>

                        <!-- Buttons -->
                        <div class="gap-3 d-flex justify-content-end">
                            <a href="{{ route('user#detail') }}"
                               class="px-4 py-2 btn btn-outline-secondary rounded-pill">
                                Cancel
                            </a>
                            <button type="submit"
                                    class="px-4 py-2 btn rounded-pill"
                                    style="background-color:#f7f7c6; color:#0f172a; border:none;">
                                Update Password
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
@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Password changed successfully!',
        timer: 1500,
        showConfirmButton: false
    }).then(() => {
        window.location.href = "{{ route('user#detail') }}";
    });
</script>
@endif

@if (session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Oops!',
        text: "{{ session('error') }}"
    });
</script>
@endif
@endsection
