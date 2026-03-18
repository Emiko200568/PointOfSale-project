@extends('admin.layouts.master')

@section('content')


<div class="mt-3 row justify-content-center">
    <div class="col-md-7 col-lg-6">
        <div class="border-0 shadow-sm card">

            <!-- Header -->
            <div class="text-center card-header bg-light text-dark">
                <h5 class="mb-0 fw-bold">Edit Product</h5>
            </div>

            <!-- Body -->
            <div class="card-body">

                <!-- Product Image -->
                <div class="mb-3 text-center">
                    <img id="output"
                         src="{{ $product->image && file_exists(public_path('productImage/'.$product->image)) ? asset('productImage/'.$product->image) : asset('default/default.png') }}"
                         class="mb-2 rounded img-fluid" alt="Product Image" style="max-height: 150px;">
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" onchange="loadFile(event)">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <form action="{{ route('product#update', $product->id) }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <!-- Name & Category -->
                    <div class="mb-3 row g-3">
                        <div class="col">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $product->name) }}" placeholder="Enter Name...">
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="categoryId">Category</label>
                                <select id="categoryId" name="categoryId" class="form-control @error('categoryId') is-invalid @enderror">
                                    <option value="">Choose Category...</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}" {{ old('categoryId', $product->category_id) == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('categoryId')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                    </div>

                    <!-- Price & Stock -->
                    <div class="mb-3 row g-3">
                        <div class="col">
                            <label class="form-label">Price</label>
                            <input type="text" name="price" class="form-control @error('price') is-invalid @enderror"
                                   value="{{ old('price', $product->price) }}" placeholder="Enter price...">
                            @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col">
                            <label class="form-label">Stock</label>
                            <input type="text" name="stock" class="form-control @error('stock') is-invalid @enderror"
                                   value="{{ old('stock', $product->stock) }}" placeholder="Enter stock...">
                            @error('stock')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4" placeholder="Enter description...">{{ old('description', $product->description) }}</textarea>
                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center d-grid">
                        <button type="submit" class="btn btn-secondary fw-semibold">Update Product</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>



@section('script-code')
@if (Session::has('success'))
    <script>
        Swal.fire({
            title: "Update success!",
            icon: "success",
            timer: 1300,
            timerProgressBar: true,
            draggable: true
        });

        setTimeout(() => {
            location.href = "/admin/category/list";
        }, 1300);
    </script>
@endif
@endsection


<script>
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
    };
</script>
@endsection
