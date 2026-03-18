@extends('user.layouts.master')

@section('content')

<div class="container" style="padding-top: 120px;">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">

            <div class="p-4 shadow-sm card rounded-4">
                <div class="mb-4 text-center">
                    <h4 class="fw-semibold">Contact Us</h4>
                    <small class="text-muted">We’d love to hear from you</small>
                </div>

                <form action="{{ route('user#contact') }}" method="post">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Name</label>
                        <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="form-control @error('name') is-invalid @enderror rounded-pill" placeholder="Enter your name">
                        @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" value="{{old('email',auth()->user()->email)}}" class="form-control @error('email') is-invalid @enderror rounded-pill" placeholder="Enter your email">
                        @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Subject</label>
                        <input type="text" name="title" value="{{old('title')}}" class="form-control @error('title') is-invalid @enderror rounded-pill" placeholder="Enter subject">
                        @error('title')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Message</label>
                        <textarea name="message" rows="4" class="form-control @error('message') is-invalid @enderror rounded-4" placeholder="Write your message">{{old('message')}}</textarea>
                        @error('message')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="py-2 btn btn-dark rounded-pill">
                            Send Message
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

@endsection

@if (Session::has('success'))
@section('script-code')
    <script>
            Swal.fire({
            title: "Send message success!",
            icon: "success",
            timer:1300,
            timeProgressBar: true,
            draggable: true
            });
    </script>
@endsection

@endif
