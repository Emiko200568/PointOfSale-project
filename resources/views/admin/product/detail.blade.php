@extends('admin.layouts.master')

@section('content')

<div class="mt-3 row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="border-0 shadow-sm card">

            <!-- Header -->
            <div class="text-center card-header bg-light text-dark">
                <h5 class="mb-0 fw-bold">Product Details</h5>
            </div>

             <!-- Image -->
             <div class="text-center card-body">
                <img src="{{ $product->image && file_exists(public_path('productImage/'.$product->image))
                             ? asset('productImage/'.$product->image)
                             : asset('default/default.png') }}"
                     class="mb-3 img-fluid img-thumbnail" alt="Product Image" style="max-height:200px;">
            </div>

            <!-- Details Table -->
            <div class="pt-0 card-body">
                <dl class="mb-0 row">
                    <dt class="col-5 text-muted">ID:</dt>
                    <dd class="col-7">{{ $product->id }}</dd>

                    <dt class="col-5 text-muted">Name:</dt>
                    <dd class="col-7">{{ $product->name }}</dd>

                    <dt class="col-5 text-muted">Category:</dt>
                    <dd class="col-7">{{ $product->category->name ?? 'N/A' }}</dd>

                    <dt class="col-5 text-muted">Price:</dt>
                    <dd class="col-7">{{ $product->price }} MMK</dd>

                    <dt class="col-5 text-muted">Stock:</dt>
                    <dd class="col-7">
                        {{ $product->stock }}
                        @if($product->stock == 0)
                            <span class="badge bg-danger ms-2">Out of Stock</span>
                        @elseif($product->stock <= 5)
                            <span class="badge bg-warning text-dark ms-2">Low Stock</span>
                        @endif
                    </dd>

                    <dt class="col-5 text-muted">Description:</dt>
                    <dd class="col-7">{{ $product->description }}</dd>

                    <dt class="col-5 text-muted">Created:</dt>
                    <dd class="col-7">{{ $product->created_at->format('d-F-Y') }}</dd>
                </dl>
            </div>

            <!-- Back Button -->
            <div class="pt-2 text-center card-body">
                <a href="{{ route('product#list') }}" class="btn btn-secondary w-50 fw-semibold">Back to List</a>
            </div>

        </div>
    </div>
</div>



@endsection
