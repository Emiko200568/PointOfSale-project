@extends('admin.layouts.master')

@section('content')

    <div class="row justify-content-center">
        <div class="col-11">

            <!-- Search Heading -->
            <div class="mb-3 d-flex justify-content-end align-items-center">

                <form action="{{ route('admin#orderList','') }}" method="get" class="d-flex">
                    <input type="text" name="orderCode" value="{{ old('orderCode') }}"
                        class="border-0 shadow-sm form-control me-2" placeholder="Search order code...">
                    <button class="shadow-sm btn btn-outline-light" style="background-color: #6c757d;"
                        onmouseover="this.style.backgroundColor='#adb5bd';"
                        onmouseout="this.style.backgroundColor='#6c757d';">Search</button>

                </form>
            </div>


            <div class="border-0 shadow-sm card">

                <div class="py-3 bg-white card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-semibold">
                        <i class="me-2 text-dark fa-solid fa-clipboard-list"></i> Order Management
                        <a href="{{ route('admin#orderList') }}"><span
                                class="btn btn-sm btn-outline-secondary ms-3">All</span></a>
                        <a href="{{ route('admin#orderList', 'reject') }}"><span
                                class="btn btn-sm btn-outline-secondary ms-3">Reject List</span></a>
                    </h5>
                    <div class="py-2 text-white badge bg-secondary">{{ count($orderList) }} Orders</div>
                </div>

                <div class="p-0 card-body">
                    <div class="table-responsive">
                        <table class="table mb-0 align-middle table-hover">

                            <thead class="bg-light">
                                <tr class="text-secondary small">
                                    <th class="ps-4">Order ID</th>
                                    <th>Date</th>
                                    <th>Customer</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($orderList as $item)
                                    <tr>

                                        <td class="ps-4 fw-semibold">
                                            <a href="{{ route('admin#orderDetail', $item->order_code) }}"
                                                class="text-dark text-decoration-none">
                                                #{{ $item->order_code }}
                                            </a>
                                        </td>

                                        <td class="text-muted">
                                            {{ $item->created_at->format('d M Y') }}
                                        </td>

                                        <td>
                                            <i class="me-1 text-secondary fa-regular fa-user"></i>
                                            {{ $item->user_name }}
                                        </td>

                                        <td>
                                            @if ($item->status == 'success')
                                                <span class="px-3 py-2 badge rounded-pill bg-success-subtle text-success">
                                                    <i class="me-1 fa-solid fa-circle-check"></i>Accepted
                                                </span>

                                            @elseif ($item->status == 'reject')
                                                <span class="px-3 py-2 badge rounded-pill bg-danger-subtle text-danger">
                                                    <i class="me-1 fa-solid fa-circle-xmark"></i>Rejected
                                                </span>

                                            @else
                                                <span class="px-3 py-2 badge rounded-pill bg-warning-subtle text-warning">
                                                    <i class="me-1 fa-solid fa-clock"></i>Pending
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-4 text-center text-muted">
                                            <i class="mb-2 fa-solid fa-box-open fs-4 d-block"></i>
                                            No orders found
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>

                        </table>
                    </div>
                </div>

                <div class="bg-white border-0 card-footer d-flex justify-content-end">
                    {{ $orderList->links() }}
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
            timer: 1500,
            timerProgressBar: true,
            showConfirmButton: false,
            draggable: true
        });
    @endif
</script>
@endsection
