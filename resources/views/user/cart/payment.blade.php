@extends('user.layouts.master')

@section('content')


<div class="container" style="padding-top: 120px;">
    <div class="row justify-content-center">

         <!-- LEFT : Payment Methods -->
    <div class="mb-4 col-lg-5">
        <div class="border-0 shadow-sm card rounded-4 h-100">
            <div class="bg-white card-header fw-bold fs-5">
                YM POS Payment Methods
            </div>

            <div class="card-body">

                @foreach ($paymentAccounts as $item)
                    <div class="p-3 mb-3 border rounded-3">
                        <div class="fw-bold text-warning">
                            {{ $item->account_type }}
                        </div>

                        <div class="small text-muted">
                            Account Name :
                            <span class="fw-semibold text-dark">
                                {{ $item->account_name }}
                            </span>
                        </div>

                        <div class="small text-muted">
                            Account Number :
                            <span class="fw-semibold text-dark">
                                {{ $item->account_number }}
                            </span>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

        <div class="col-lg-7">
            <div class="border-0 shadow-sm card rounded-4">
                <div class="p-4 card-body">

                        <!-- Payment Form -->
                            <div class="border-0 shadow-sm card rounded-4 h-100">
                                <div class="bg-white border-0 card-header d-flex justify-content-between align-items-center fw-bold fs-5">
                                    <span>Payment Information</span>
                                    <span class="text-secondary small">
                                        Logged in as: <span class="fw-semibold">{{ auth()->user()->name }}</span>
                                    </span>
                                </div>


                                <div class="card-body">

                                    <form action="{{ route('user#payment') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <!-- User Info -->
                                        <div class="mb-4 row g-3">

                                            <div class="col-md-4">
                                                <input type="text"
                                                    name="name"
                                                    value="{{ old('name') }}"
                                                    placeholder="Enter acc name"
                                                    class="form-control @error('name') is-invalid @enderror">
                                                @error('phone')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                                @enderror
                                            </div>



                                            <div class="col-md-4">
                                                <input type="text"
                                                    name="phone"
                                                    value="{{ old('phone') }}"
                                                    placeholder="09xxxxxxxx"
                                                    class="form-control @error('phone') is-invalid @enderror">
                                                @error('phone')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="col-md-4">
                                                <input type="text"
                                                    name="address"
                                                    value="{{ old('address') }}"
                                                    placeholder="Address..."
                                                    class="form-control @error('address') is-invalid @enderror">
                                                @error('address')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Payment Type & Slip -->
                                        <div class="mb-4 row g-3">
                                            <div class="col-md-6">
                                                <select name="paymentType"
                                                    class="form-select @error('paymentType') is-invalid @enderror">
                                                    <option value="">Choose payment method...</option>
                                                    @foreach ($paymentAccounts as $item)
                                                    <option value="{{ $item->id }}"
                                                        @if (old('paymentType') == $item->id) selected @endif>
                                                        {{ $item->account_type }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('paymentType')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <input type="file"
                                                    name="payslipImage"
                                                    accept="image/*"
                                                    onchange="loadFile(event)"
                                                    class="form-control @error('image') is-invalid @enderror">

                                                <img id="output" class="w-20 mt-2 rounded img-fluid">

                                                @error('image')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Order Code -->
                                        <div class="mb-4">
                                            <input type="hidden" name="orderCode" value="{{ $orderCode }}">
                                            <span class="fw-semibold">Order Code :</span>
                                            <span class="fw-bold text-secondary">{{ $orderCode }}</span>
                                        </div>

                                        <!-- Total Price-->
                                        <div class="mb-4">
                                            <input type="hidden" name="orderCode" value="{{ $total }}">
                                            <span class="fw-semibold">Total Price :</span>
                                            <span class="fw-bold text-danger">{{ $total }}</span>
                                        </div>

                                        <!-- Submit -->
                                        <button type="submit"
                                            class="btn btn-theme btn-outline-warning w-100 rounded-pill fw-bold">
                                            <i class="fa-solid fa-cart-shopping me-2"></i>
                                            Order Now
                                        </button>

                                    </form>

                                </div>
                            </div>

                </div>
            </div>
        </div>

    </div>
</div>



@endsection


