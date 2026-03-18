@extends('user.layouts.master')

@section('content')



<div class="container py-5" style="margin-top: 80px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="shadow-sm card rounded-4">
                <div class="p-4 card-body">

                    <h4 class="mb-4">Edit Profile</h4>

                    <form action="{{ route('user#update',auth()->user()->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Profile Image -->
                        <div class="mb-4 d-flex align-items-center">
                            <img src="{{ auth()->user()->profile && file_exists(public_path('userProfile/' . auth()->user()->profile))
                             ? asset('userProfile/' . auth()->user()->profile)
                             : asset('default/profile.webp') }}"
                                 class="img-profile img-thumbnail" id="output"
                                 width="100" height="100" alt="Profile">
                            <div class="ms-3">
                                <label class="form-label fw-bold">Profile Image</label>
                                <input type="file" name="profile" class="form-control" onchange="loadFile(event)">
                            </div>
                        </div>

                        <hr>

                        <!-- Name -->
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-bold">Name</label>
                            <div class="col-sm-8">
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', auth()->user()->name) }}">
                                @error('name')
                                      <small class="invalid-feedback">{{ $message }}</small>
                                  @enderror
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-bold">Email</label>
                            <div class="col-sm-8">
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', auth()->user()->email) }}">
                                @error('email')
                                      <small class="invalid-feedback">{{ $message }}</small>
                                  @enderror
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-bold">Phone</label>
                            <div class="col-sm-8">
                                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', auth()->user()->phone) }}">
                                @error('phone')
                                      <small class="invalid-feedback">{{ $message }}</small>
                                  @enderror
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-bold">Address</label>
                            <div class="col-sm-8">
                                <textarea name="address" rows="3" class="form-control @error('address') is-invalid @enderror">{{ old('address', auth()->user()->address) }}</textarea>
                                @error('address')
                                      <small class="invalid-feedback">{{ $message }}</small>
                                  @enderror
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="gap-2 mt-4 d-flex justify-content-end">
                            <a href="{{ route('user#detail') }}" class="btn btn-outline-secondary">
                                Cancel
                            </a>

                            <button type="submit"  class="px-4 py-2 btn btn-primary rounded-pill"
                            style="background-color:#f7f7c6; border:none; color:#0f172a;">
                                Update Profile
                            </button>
                        </a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection


