@extends('admin.layouts.master')

@section('content')

   <!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="mb-4 d-sm-flex align-items-center justify-content-between">
        <h1 class="mb-0 h3 text-dark fw-bold">Payment Method List</h1>
    </div>

    <div class="row g-4">
        <!-- Create Payment Form -->
        <div class="col-lg-4">
            <div class="border-0 shadow-sm card h-100">
                <div class="card-body">
                    <h5 class="mb-4 text-center card-title fw-semibold text-dark">Add New Payment</h5>
                    <form action="{{ route('paymentMethod#create') }}" method="post" class="gap-3 d-flex flex-column">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Account Number</label>
                            <input type="text" name="account_number" value="{{ old('account_number') }}"
                                   class="form-control @error('account_number') is-invalid @enderror"
                                   placeholder="Enter account number">
                            @error('account_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Account Name</label>
                            <input type="text" name="account_name" value="{{ old('account_name') }}"
                                   class="form-control @error('account_name') is-invalid @enderror"
                                   placeholder="Enter account name">
                            @error('account_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Account Type</label>
                            <input type="text" name="account_type" value="{{ old('account_type') }}"
                                   class="form-control @error('account_type') is-invalid @enderror"
                                   placeholder="Enter account type">
                            @error('account_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <button type="submit" class="mt-2 btn btn-secondary w-100 rounded-pill fw-semibold">
                            Create Payment
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Payment List Table -->
        <div class="col-lg-8">
            <div class="border-0 shadow-sm card">
                <div class="p-0 card-body">
                    <table class="table mb-0 align-middle table-hover">
                        <thead class="text-center bg-light text-secondary">
                            <tr>
                                <th>ID</th>
                                <th>Account Number</th>
                                <th>Account Name</th>
                                <th>Account Type</th>
                                <th>Created Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @forelse ($payments as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->account_number }}</td>
                                    <td>{{ $item->account_name }}</td>
                                    <td>{{ $item->account_type }}</td>
                                    <td>{{ $item->created_at->format('d-F-Y') }}</td>
                                    <td>
                                        <a href="{{ route('paymentMethod#edit',$item->id) }}"
                                           class="btn btn-sm btn-outline-secondary rounded-circle me-1">
                                           <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <button type="button"
                                                onclick="deleteConfirm('{{ route('paymentMethod#delete', $item->id) }}')"
                                                class="btn btn-sm btn-outline-danger rounded-circle">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-3 text-center text-muted">No payment methods available</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="px-3 mt-3 d-flex justify-content-end">
                        {{ $payments->links() }}
                    </div>

                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection


@section('script-code')
<script>
    // Show success alert dynamically
    @if (session('success'))
        Swal.fire({
            title: "{{ session('success') }}",
            icon: "success",
            timer: 1300,
            showConfirmButton: false
        });
    @endif

    // Delete confirmation
    function deleteConfirm(url) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {

                Swal.fire({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
                    icon: "success",
                    timer: 1000,
                    timerProgressBar: true,
                    showConfirmButton: false
                });

                setTimeout(() => {
                    window.location.href = url;
                }, 1000);
            }
        });
    }
</script>
@endsection


