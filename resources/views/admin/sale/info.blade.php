@extends('admin.layouts.master')

@section('content')

<div class="row justify-content-center">
    <div class="col-11">

        <!-- Search Heading -->
        <div class="mb-3 d-flex justify-content-end align-items-center">

            <form action="{{ route('admin#saleInfo') }}" method="get" class="d-flex">
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
                    <i class="me-2 text-dark fa-solid fa-clipboard-list"></i> Sale Information {Total Amount - <span class="text-danger">{{ $total }}</span> mmk }

                </h5>

            </div>

            <div class="p-0 card-body">
                <div class="table-responsive">

                    <table class="table mb-0 align-middle table-hover">

                        <thead class="bg-light">
                            <tr class="text-secondary small">
                                <th class="ps-4">Order ID</th>
                                <th>Date</th>
                                <th>Total Amount</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($orders as $item)
                            <tr class="text-secondary small">
                                <td class="ps-4">  <a href="{{ route('admin#orderDetail',$item->order_code) }}">{{ $item->order_code }}</a></td>
                                <td>{{ $item->created_at->format("d-F-Y") }}</td>
                                <td>{{ $item->total_price }}mmk</td>
                                <td></td>
                            </tr>

                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>

            {{-- <div class="bg-white border-0 card-footer d-flex justify-content-end">

            </div> --}}

        </div>
    </div>
</div>

@endsection

