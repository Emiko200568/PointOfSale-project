@extends('user.layouts.master')

@section('content')


   <!-- Cart Page Start -->
<div class="py-5 mt-5 container-fluid">
    <div class="container py-5">

        <!-- Cart Table -->
        <div class="p-3 bg-white shadow-sm table-responsive rounded-4">
            <table class="table mb-0 align-middle table-borderless" id="productTable">
                <thead class="table-light text-muted">
                    <tr>
                        <th>Products</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th class="text-center">Handle</th>
                    </tr>
                </thead>
                <tbody>

                    @if (count($orderItems) != 0)

                    @foreach ($orderItems as $item)
                    <tr>
                        <th>
                            <input type="hidden" class="userId" value="{{ auth()->user()->id }}">
                            <input type="hidden" class="productId" value="{{ $item->product_id }}">

                            <img src="{{ asset('productImage/' . $item->image) }}"
                                 class="border img-fluid rounded-3"
                                 style="width:90px;height:90px" alt="">
                        </th>

                        <td>
                            <p class="mb-0 fw-semibold">{{ $item->name }}</p>
                        </td>

                        <td>
                            <p class="mb-0 text-secondary fw-semibold price">
                                {{ $item->price }} mmk
                            </p>
                        </td>

                        <td>
                            <div class="overflow-hidden border input-group input-group-sm rounded-pill"
                                 style="width:110px">
                                <button class="btn btn-light btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>

                                <input type="text"
                                    class="text-center border-0 form-control fw-semibold qty"
                                    value="{{ $item->quantity }}">

                                <button class="btn btn-light btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </td>

                        <td>
                            <p class="mb-0 fw-bold total">
                                {{ $item->price * $item->quantity }} mmk
                            </p>
                        </td>

                        <td class="text-center">
                            <input type="hidden" class="cartId" value="{{ $item->id }}">
                            <button class="btn btn-outline-danger btn-sm rounded-circle btn-remove">
                                <i class="fa fa-times"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach

                    @else
                    <tr>
                        <td colspan="6" class="text-center">There is no items</td>
                    </tr>

                    @endif
                </tbody>
            </table>
        </div>

        @if (count($orderItems) != 0)
             <!-- Cart Summary -->
        <div class="mt-5 row justify-content-end">
            <div class="col-lg-5">
                <div class="p-4 bg-white shadow-sm rounded-4">

                    <h3 class="mb-4 fw-bold">
                        Cart <span class="fw-normal text-muted">Total</span>
                    </h3>

                    <div class="mb-3 d-flex justify-content-between">
                        <span class="fw-semibold">Subtotal</span>
                        <span id="subtotal" class="fw-bold"></span>
                    </div>

                    <div class="mb-3 d-flex justify-content-between">
                        <span class="fw-semibold">Delivery</span>
                        <span>5000 mmk</span>
                    </div>

                    <hr>

                    <div class="mb-4 d-flex justify-content-between">
                        <span class="fw-bold fs-5">Total</span>
                        <span id="finalTotal" class="fw-bold fs-5"></span>
                    </div>

                    <button id="btn-checkout"
                        class="btn btn-theme w-100 rounded-pill fw-bold text-uppercase"
                        type="button">
                        Proceed Checkout
                    </button>

                </div>
            </div>
        </div>

        @endif



    </div>
</div>
<!-- Cart Page End -->


@endsection

@section('script-code')
<script>
$(document).ready(function () {

    function priceCalculation() {
        let total = 0;

        $('#productTable tbody tr').each(function () {
            total += Number($(this).find(".total").text().replace("mmk", ""));
        });

        $('#subtotal').text(total + "mmk");
        $('#finalTotal').text((total + 5000) + "mmk");
    }

    priceCalculation();

    // PLUS button
    $('.btn-plus').click(function () {
        let row = $(this).closest('tr');
        let qtyInput = row.find('.qty');
        qtyInput.val(Number(qtyInput.val()) + 1);
        updateRow(row);
    });

    // MINUS button
    $('.btn-minus').click(function () {
        let row = $(this).closest('tr');
        let qtyInput = row.find('.qty');

        if (qtyInput.val() > 1) {
            qtyInput.val(Number(qtyInput.val()) - 1);
            updateRow(row);
        }
    });

    function updateRow(row) {
        let price = row.find('.price').text().replace("mmk", "") * 1;
        let qty = row.find('.qty').val();
        row.find('.total').text((price * qty) + "mmk");
        priceCalculation();
    }

    // DELETE cart item
    $('.btn-remove').click(function () {
        let cartId = $(this).closest('tr').find('.cartId').val();

        $.ajax({
            type: "POST",
            url: "{{ route('user#deleteCart') }}",
            data: {
                deleteCartId: cartId,
                _token: "{{ csrf_token() }}"
            },
            dataType: 'json',
            success: function (res) {
                if (res.status == 200) {
                    location.reload();
                }
            }
        });
    });

    // CHECKOUT
    $('#btn-checkout').click(function () {

        let orderList = [];
        let orderCode = "YM-POS-" + Math.floor(Math.random() * 100000000000000);
        let userId = $('.userId').val();

        $('#productTable tbody tr').each(function () {
            orderList.push({
                product_id: $(this).find('.productId').val(),
                user_id: userId,
                count: $(this).find('.qty').val(),
                status: 'pending',
                order_code: orderCode,
                total_price: $(this).find('.total').text().replace("mmk", "") * 1
            });
        });

        $.ajax({
            type: "POST",
            url: "{{ route('user#cartTemp') }}",
            data: {
                orderList: orderList,
                _token: "{{ csrf_token() }}"
            },
            dataType: 'json',
            success: function (res) {
                if (res.status == 200) {
                    location.href = "{{ route('user#paymentPage') }}";
                }
            }
        });
    });

});
</script>


@endsection
