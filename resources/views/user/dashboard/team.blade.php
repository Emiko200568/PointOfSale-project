@extends('user.layouts.master')

@section('content')

<div class="container" style="padding-top: 120px;">

    {{-- Page Header --}}
    <div class="mb-5 text-center">
        <h2 class="fw-bold">YM Clothing POS</h2>
        <p class="text-muted">Our Team</p>
        <hr class="mx-auto w-25">
    </div>

    {{-- Founder Section --}}
    <div class="mb-5">
        <h5 class="mb-4 text-center fw-bold">Founder</h5>

        <div class="row justify-content-center">
            <div class="col-md-4 col-lg-3">
                <div class="text-center border-0 shadow-sm card">
                    <div class="py-4 card-body">
                        <img src="{{ asset('logo/ceo.jpg') }}"
                             class="mb-3 rounded-circle"
                             width="100" height="100">

                        <h6 class="mb-1 fw-semibold">Ms.Park</h6>
                        <small class="text-muted">Founder & CEO</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Admin Team --}}
    <div class="mb-5">
        <h5 class="mb-4 text-center fw-bold">Admin Team</h5>

        <div class="row g-4 justify-content-center">
            <div class="col-md-4 col-lg-3">
                <div class="text-center border-0 shadow-sm card h-100">
                    <div class="py-4 card-body">
                        <img src="{{ asset('logo/admin1.jpg') }}"
                             class="mb-3 rounded-circle"
                             width="100" height="100">

                        <h6 class="mb-1 fw-semibold">James</h6>
                        <small class="text-muted">Super Admin</small>
                    </div>
                </div>
            </div>


            <div class="col-md-4 col-lg-3">
                <div class="text-center border-0 shadow-sm card h-100">
                    <div class="py-4 card-body">
                        <img src="{{ asset('logo/admin3.webp') }}"
                             class="mb-3 rounded-circle"
                             width="100" height="100">

                        <h6 class="mb-1 fw-semibold">Suzi</h6>
                        <small class="text-muted">System Admin</small>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg-3">
                <div class="text-center border-0 shadow-sm card h-100">
                    <div class="py-4 card-body">
                        <img src="{{ asset('logo/admin2.jpg') }}"
                             class="mb-3 rounded-circle"
                             width="100" height="100">

                        <h6 class="mb-1 fw-semibold">John</h6>
                        <small class="text-muted">Operations Admin</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Development Team --}}
    <div>
        <h5 class="mb-4 text-center fw-bold">Development Team</h5>

        <div class="row g-4 justify-content-center">
            <div class="col-md-4 col-lg-3">
                <div class="text-center border-0 shadow-sm card h-100">
                    <div class="py-4 card-body">
                        <img src="{{ asset('logo/lead.jpg') }}"
                             class="mb-3 rounded-circle"
                             width="100" height="100">

                        <h6 class="mb-1 fw-semibold">Thomas</h6>
                        <small class="text-muted">Lead Developer</small>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg-3">
                <div class="text-center border-0 shadow-sm card h-100">
                    <div class="py-4 card-body">
                        <img src="{{ asset('logo/ui.jpg') }}"
                             class="mb-3 rounded-circle"
                             width="100" height="100">

                        <h6 class="mb-1 fw-semibold">Mike</h6>
                        <small class="text-muted">UI Developer</small>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg-3">
                <div class="text-center border-0 shadow-sm card h-100">
                    <div class="py-4 card-body">
                        <img src="{{ asset('logo/backend.jpg') }}"
                             class="mb-3 rounded-circle"
                             width="100" height="100">

                        <h6 class="mb-1 fw-semibold">Eleven</h6>
                        <small class="text-muted">System Developer</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
