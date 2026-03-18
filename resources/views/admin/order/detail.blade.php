@extends('admin.layouts.master')

@section('content')


  <!-- Begin Page Content -->
  <div class="container-fluid">


    <a href="{{ route('admin#orderList') }}" class="m-3 text-dark text-decoration-none "> <i class="fa-solid fa-arrow-left-long"></i> Back to order list</a>

    <!-- DataTales Example -->


    <div class="row">
        <div class="m-4 shadow-sm card col-5 col">
            <div class="card-header">
                Customer Information <br> (Order Code - <span class="text-danger order-code">{{ $orderData[0]['order_code'] }}</span>)
            </div>
            <div class="card-body">
                <div class="mb-3 row">
                    <div class="col-5">Name :</div>
                    <div class="col-7">{{ $orderData[0]['customer_name'] }}</div>
                </div>
                <div class="mb-3 row">
                    <div class="col-5">Phone :</div>
                    <div class="col-7">{{ $orderData[0]['phone'] }}</div>
                </div>
                <div class="mb-3 row">
                    <div class="col-5">Address :</div>
                    <div class="col-7">{{ $orderData[0]['address'] ? $orderData[0]['address'] : '---' }}</div>
                </div>
                <div class="mb-3 row">
                    <div class="col-5">Order Code :</div>
                    <div class="col-7" id="orderCode">{{ $orderData[0]['order_code'] }}</div>
                </div>
                <div class="mb-3 row">
                    <div class="col-5">Order Date :</div>
                    <div class="col-7">{{ $orderData[0]['created_at']->format('d-F-Y') }}</div>
                </div>
                <div class="mb-3 row">
                    <div class="col-5">Total Price :</div>
                    <div class="col-7">{{ $totalAmt }}mmk<br>
                        <small class=" text-danger ms-1">( Contain Delivery Charges )</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="m-4 shadow-sm card col-5 col">
            <div class="card-header">Payment Information</div>
            <div class="card-body">
                <div class="mb-3 row">
                    <div class="col-5">Acc Name :</div>
                    <div class="col-7">{{ $paymentHistories['name'] }}</div>
                </div>
                <div class="mb-3 row">
                    <div class="col-5">Contact Phone :</div>
                    <div class="col-7">{{ $paymentHistories['phone'] }}</div>
                </div>
                <div class="mb-3 row">
                    <div class="col-5">Address :</div>
                    <div class="col-7">{{ $paymentHistories['address'] }}</div>
                </div>
                <div class="mb-3 row">
                    <div class="col-5">Payment Method :</div>
                    <div class="col-7">{{ $paymentHistories['payment_method'] }}</div>
                </div>
                <div class="mb-3 row">
                    <div class="col-5">Purchase Date :</div>
                    <div class="col-7">{{ $paymentHistories['created_at'] }}</div>
                </div>
                <div class="mb-3 row">
                    <div class="col-5">Purchase Date :</div>
                    <div class="col-7">{{ $paymentHistories['total_amount'] }} mmk <br> <small class=" text-danger ms-1">( Contain Delivery Charges )</small> </div>
                </div>
                <div class="mb-3 row">
                    <img style="width: 200px" src="{{ asset('payslipImage/'. $paymentHistories['payslip_image']) }}" class=" img-thumbnail">
                </div>
            </div>
        </div>
    </div>

    <div class="mb-4 shadow card">
        <div class="py-3 card-header">
            <div class="d-flex justify-content-between">
                <div class="">
                    <h6 class="m-0 font-weight-bold text-dark">Order Board</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="text-center table-responsive">
                <table class="table shadow-sm table-hover " id="productTable">
                    <thead class="text-white bg-secondary">
                        <tr>
                            <th class="col-2">Image</th>
                            <th>Name</th>
                            <th>Order Count</th>
                            <th>Available Stock</th>
                            <th>Product Price (each)</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($orderData as $item )
                       <tr>
                        <input type="hidden" class="productId" value="{{ $item->product_id }}">

                        <td>
                            <img style="width: 200px" src="{{ asset('productImage/'. $item['image']) }}">
                        </td>
                        <td>{{ $item->name }}</td>
                        <td class="qty">{{ $item->order_count }}</td>
                        <td>
                            {{ $item->stock }} <br>
                            @if ($item->order_count > $item->stock)
                            {{ $orderStatus = ""}}
                            <small class="text-danger">(out of stock)</small>

                            @endif
                        </td>
                        <td>{{ $item->price }}mmk</td>
                        <td>{{ $item->order_count*$item->price }} mmk</td>
                    </tr>

                       @endforeach

                    </tbody>

                </table>

            </div>
        </div>
        @if ($orderData[0]['status'] == 'reject')
        <div class="card-footer d-flex justify-content-center">
            <p class="text-danger">You has been rejected for this order!</p>
        </div>
        @else
        <div class="card-footer d-flex justify-content-end">
            <div class="">
                @if (!isset($orderStatus))
                <input type="button" id="btn-order-confirm" class="rounded shadow-sm btn btn-success"
                    value="Confirm">
                @endif

                <input type="button" id="btn-order-reject" class="rounded shadow-sm btn btn-danger" data-ordercode="{{ $orderData[0]['order_code'] }}"  value="Reject">

            </div>
        </div>

        @endif
    </div>

</div>
<!-- /.container-fluid -->

@endsection

@section('script-code')
<script>
$(document).ready(function(){

    $('#btn-order-confirm').click(function(){

        // SweetAlert confirmation
        Swal.fire({
            title: "Are you sure?",
            text: "Are you sure to confirm this order!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, confirm it!"
        }).then((result) => {
            if (result.isConfirmed) {

                // Collect order data
                let orderCode = $('.order-code').text();
                let orderProductList = [];

                $('#productTable tbody tr').each(function(index, row){
                    let productId = $(row).find('.productId').val();
                    let qty = parseInt($(row).find('.qty').text());
                    orderProductList.push({
                        'productId': productId,
                        'orderCount': qty
                    });
                });

                let data = {
                    'data': orderProductList,
                    'orderCode': orderCode
                };

                // AJAX POST request
                $.ajax({
                    type: 'POST',
                    url: '/admin/order/accept', // make sure route uses POST
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(res){
                        if(res.status == 'success'){
                            Swal.fire(
                                'Confirmed!',
                                'Order has been confirmed.',
                                'success'
                            ).then(() => {
                                location.href = '/admin/order/list';
                            });
                        } else {
                            Swal.fire(
                                'Error!',
                                'Something went wrong.',
                                'error'
                            );
                        }
                    }
                });

            } // end if result.isConfirmed
        }); // end then

    }); // end click

    $('#btn-order-reject').click(function(){

let orderCode = $(this).data('ordercode');

Swal.fire({
    title: "Are you sure?",
    text: "Do you want to reject this order?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Yes, reject it!"
}).then((result) => {
    if(result.isConfirmed){
        window.location.href = "/admin/order/reject/" + orderCode;
    }
});

});


}); // end ready
</script>
@endsection
