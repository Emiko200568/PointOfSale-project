@extends('user.layouts.master')

@section('content')


<div class="container" style="padding-top: 120px;">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="shadow-sm card">
                <div class="card-header bg-light">
                    <h5 class="mb-0 text-center fw-bold">Order List</h5>
                </div>
                <div class="p-0 card-body">

                    <table class="table mb-0 align-middle table-hover">
                        <thead class="text-center table-light">
                            <tr>
                                <th>Date</th>
                                <th>Order Code</th>
                                <th>Order Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">

                            @if (count($orderList) != 0)
                                @foreach ($orderList as $item)
                                    <tr>
                                        <td>{{ $item->created_at->format('d-F-Y') }}</td>
                                        <td>{{ $item->order_code }}</td>
                                        <td>
                                            @if ($item->status == 'success')
                                                <span class="text-white badge bg-success">
                                                    Accepted <i class="fa-solid fa-circle-check"></i>
                                                </span>
                                            @elseif ($item->status == 'reject')
                                                <span class="text-white badge bg-danger">
                                                    Rejected <i class="fa-solid fa-circle-xmark"></i>
                                                </span>
                                            @elseif ($item->status == 'pending')
                                                <span class="badge bg-warning text-dark">
                                                    Pending <i class="fa-solid fa-clock"></i>
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3" class="py-3 text-muted">There is no order</td>
                                </tr>
                            @endif

                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>
</div>



@endsection

@section('script-code')
<script>
    @if(session('payment_success'))
        Swal.fire({
            title: "Order Payment success!",
            icon: "success",
            timer: 1300,
            timerProgressBar: true,
            draggable: true,
            showConfirmButton: false
        });
    @endif
</script>
@endsection


