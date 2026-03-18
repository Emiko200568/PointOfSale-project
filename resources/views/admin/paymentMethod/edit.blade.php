@extends('admin.layouts.master')

@section('content')

   <!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="mb-4 d-sm-flex align-items-center justify-content-between">
        <h1 class="mb-0 h3 fw-bold text-dark">Edit Payment Method</h1>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-4">
            <div class="border-0 shadow-sm card">
                <div class="card-body">
                    <h5 class="mb-4 text-center card-title fw-semibold text-dark">Update Payment Info</h5>

                    <form action="{{ route('paymentMethod#update',$payment->id) }}" method="post" class="gap-3 d-flex flex-column">
                        @csrf

                        <div class="form-group">
                            <label class="form-label">Account Number</label>
                            <input type="text" name="account_number"
                                   value="{{ old('account_number',$payment->account_number) }}"
                                   class="form-control @error('account_number') is-invalid @enderror"
                                   placeholder="Enter account number">
                            @error('account_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Account Name</label>
                            <input type="text" name="account_name"
                                   value="{{ old('account_name', $payment->account_name) }}"
                                   class="form-control @error('account_name') is-invalid @enderror"
                                   placeholder="Enter account name">
                            @error('account_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Account Type</label>
                            <input type="text" name="account_type"
                                   value="{{ old('account_type', $payment->account_type) }}"
                                   class="form-control @error('account_type') is-invalid @enderror"
                                   placeholder="Enter account type">
                            @error('account_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <button type="submit" class="mt-2 btn btn-secondary w-100 rounded-pill fw-semibold">
                            Update Payment
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>


@endsection



@section('script-code')
<script>
    @if(session('success'))
        Swal.fire({
            title: "{{ session('success') }}",
            icon: "success",
            timer: 1300,
            timerProgressBar: true,
            showConfirmButton: false
        });

        setTimeout(() => {
            location.href = "/admin/paymentMethod/list"; // replace with your actual list route
        }, 1300);
    @endif
</script>
@endsection

