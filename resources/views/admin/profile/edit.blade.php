@extends('admin.layouts.master')

@section('content')

<!-- Begin Page Content -->
<div class="py-5 container-fluid">

    <div class="mx-auto border-0 shadow card rounded-4" style="max-width: 700px;">
        <div class="p-5 card-body">

            <h4 class="mb-4 text-center fw-bold text-secondary">Update Profile Information</h4>

            <form action="{{ route('profile#update', auth()->user()->id) }}"
                  method="post" enctype="multipart/form-data">
                @csrf

                <div class="row g-4 align-items-center">

                    <!-- Profile Image -->
                    <div class="text-center col-md-4">
                        <img class="mb-3 shadow-sm img-fluid rounded-circle img-profile img-thumbnail"
                             id="output"
                             src="{{ auth()->user()->profile && file_exists(public_path('profileImage/' . auth()->user()->profile))
                                 ? asset('profileImage/' . auth()->user()->profile)
                                 : asset('default/profile.webp') }}"
                             alt="Profile Image"
                             style="width: 130px; height: 130px; object-fit: cover;">
                        <input type="file" name="image" class="mt-2 form-control form-control-sm" onchange="loadFile(event)">
                        </div>


                    <!-- Profile Inputs -->
                    <div class="col-md-8">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Name</label>
                            <input type="text" name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', auth()->user()->name) }}"
                                   placeholder="Enter your name">
                            @error('name')<small class="invalid-feedback">{{ $message }}</small>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email', auth()->user()->email) }}"
                                   placeholder="Enter your email">
                            @error('email')<small class="invalid-feedback">{{ $message }}</small>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Phone</label>
                            <input type="text" name="phone"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   value="{{ old('phone', auth()->user()->phone) }}"
                                   placeholder="Enter your phone number">
                            @error('phone')<small class="invalid-feedback">{{ $message }}</small>@enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Address</label>
                            <input type="text" name="address"
                                   class="form-control @error('address') is-invalid @enderror"
                                   value="{{ old('address', auth()->user()->address) }}"
                                   placeholder="Enter your address">
                            @error('address')<small class="invalid-feedback">{{ $message }}</small>@enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="py-2 btn btn-dark btn-lg rounded-pill fw-semibold">
                                Update Profile
                            </button>
                        </div>

                    </div> <!-- col-md-8 -->

                </div> <!-- row g-4 -->
            </form>

        </div> <!-- card-body -->
    </div> <!-- card shadow -->

</div>
<!-- /.container-fluid -->




@endsection


@section('script-code')
@if(Session::has('success'))
<script>
Swal.fire({
    title: "{{ Session::get('success') }}",
    icon: "success",
    timer: 1300,
    timerProgressBar: true,
    showConfirmButton: false,
    willClose: () => {
        window.location.href = "{{ route('profile#detail') }}";
    }
});
</script>
@endif

@endsection
