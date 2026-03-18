@extends('admin.layouts.master')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">

        <div class="col-lg-8">
            <div class="border-0 shadow-sm card rounded-4">

                <div class="p-4 card-body">
                    <!-- Header -->
                    {{-- <div class="mb-4 text-center">
                        <h4 class="fw-bold text-dark">Create Product</h4>
                        <small class="text-muted">Add new item to your inventory</small>
                    </div> --}}

                    <form action="{{ route('product#create') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <!-- Image Upload -->
                        <div class="mb-4 text-center">
                            <img id="output"
                                 src="{{ asset('default/default.png') }}"
                                 class="mb-3 rounded img-thumbnail"
                                 style="max-width:160px;">
                            <input type="file"
                                   name="image"
                                   class="form-control rounded-pill @error('image') is-invalid @enderror"
                                   accept="image/*"
                                   onchange="loadFile(event)">
                            @error('image')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Name + Category -->
                        <div class="row g-3">
                            <div class="col-md-6">
                                {{-- <label class="form-label fw-semibold">Product Name</label> --}}
                                <input type="text"
                                       name="name"
                                       class="form-control rounded-pill @error('name') is-invalid @enderror"
                                       value="{{ old('name') }}"
                                       placeholder="Enter product name">
                                @error('name')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                {{-- <label class="mb-1 form-label fw-semibold">
                                    Category
                                </label> --}}

                                <select name="categoryId"
                                        class="form-control rounded-pill @error('categoryId') is-invalid @enderror">
                                    <option value="">Choose category</option>

                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('categoryId') == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('categoryId')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>


                        </div>

                        <!-- Price + Stock -->
                        <div class="mt-3 row g-3">
                            <div class="col-md-6">
                                {{-- <label class="form-label fw-semibold">Price</label> --}}
                                <input type="text"
                                       name="price"
                                       class="form-control rounded-pill @error('price') is-invalid @enderror"
                                       value="{{ old('price') }}"
                                       placeholder="Enter price">
                                @error('price')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                {{-- <label class="form-label fw-semibold">Stock</label> --}}
                                <input type="text"
                                       name="stock"
                                       class="form-control rounded-pill @error('stock') is-invalid @enderror"
                                       value="{{ old('stock') }}"
                                       placeholder="Available quantity">
                                @error('stock')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mt-3">
                            {{-- <label class="form-label fw-semibold">Description</label> --}}
                            <textarea name="description"
                                      rows="4"
                                      class="form-control rounded-4 @error('description') is-invalid @enderror"
                                      placeholder="Enter product description">{{ old('description') }}</textarea>
                            @error('description')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Submit -->
                        <div class="mt-4 text-center d-grid">
                            <button type="submit"
                                    class="py-2 btn btn-dark rounded-pill fw-semibold">
                                Create Product
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection


@if (Session::has('success'))
@section('script-code')
    <script>
            Swal.fire({
            title: "Create success!",
            icon: "success",
            timer:1300,
            timeProgressBar: true,
            draggable: true
            });

            setInterval(()=> {
                location.href="/admin/product/create"
            },1300)
    </script>
@endsection

@endif