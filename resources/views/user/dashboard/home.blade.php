@extends('user.layouts.master')

@section('content')


    <!-- POS Products Start -->
    <div class="py-5 mt-5 container-fluid bg-light">
        <div class="container py-5">

            <!-- Header -->
            <div class="mb-4 row align-items-center">
                <div class="col-lg-4">
                    <h2 class="fw-bold text-dark">Products</h2>
                    <small class="text-muted">Point of Sale Items</small>
                </div>

                <div class="text-center col-lg-8 text-lg-end">
                    <ul class="nav nav-pills justify-content-lg-end justify-content-center">

                        <li class="nav-item">
                            <a href="{{ url('user/home') }}" class="px-4 py-2 m-1 nav-link rounded-pill border
                               @if (!request('categoryId')) active bg-dark text-white @else text-dark @endif">
                                All
                            </a>
                        </li>

                        @foreach ($categories as $item)
                            <li class="nav-item">
                                <a href="{{ url('user/home?categoryId=' . $item->id) }}" class="px-4 py-2 m-1 nav-link rounded-pill border
                                   @if (request('categoryId') == $item->id) active bg-dark text-white @else text-dark @endif">
                                    {{ $item->name }}
                                </a>
                            </li>
                        @endforeach

                    </ul>
                </div>
            </div>

            <div class="row g-4">

                <!-- Left Filter Panel -->
                <div class="col-lg-3">
                    <div class="p-4 bg-white border rounded-4">

                        <!-- Search -->
                        <form action="{{ url('user/home') }}" method="get">
                            <input type="text" name="searchKey" value="{{ request('searchKey') }}" class="mb-2 form-control rounded-pill" placeholder="Search product">

                        <!-- Price Filter -->
                        <form action="{{ route('user#home') }}" method="get">
                            <input type="text" name="minPrice" value="{{ request('minPrice') }}"
                                class="mb-2 form-control rounded-pill" placeholder="Min Price">

                            <input type="text" name="maxPrice" value="{{ request('maxPrice') }}"
                                class="mb-3 form-control rounded-pill" placeholder="Max Price">

                                <button class="w-100 btn btn-dark rounded-pill">
                                    Search
                                </button>
                        </form>

                        <!-- Sort -->
                        <form action="{{ url('user/home') }}" method="get" class="mt-4">
                            <select name="sortingType" class="mb-3 form-select rounded-pill">
                                <option value="">Sort by</option>
                                <option value="nameAsc">Name A → Z</option>
                                <option value="nameDesc">Name Z → A</option>
                                <option value="priceAsc">Price Low → High</option>
                                <option value="priceDesc">Price High → Low</option>
                            </select>

                            <button class="w-100 btn btn-outline-dark rounded-pill">
                                Apply
                            </button>
                        </form>

                    </div>
                </div>

                <!-- Products -->
                <div class="col-lg-9">
                    <div class="row g-3">

                        @forelse ($products as $item)
                            <div class="col-lg-4 col-md-6">
                                <div class="p-4 border shadow-sm bg4-white d-flex align-items-center rounded-4 hover-effect">

                                    <!-- Product Image -->
                                    <a href="{{ route('user#details', $item->id) }}">
                                        <img src="{{ asset('productImage/' . $item->image) }}" class="rounded img-fluid me-3"
                                            style="width:80px; height:80px; object-fit:cover;" alt="{{ $item->name }}">
                                    </a>

                                    <!-- Product Info -->
                                    <div class="ps-2 flex-grow-1">
                                        <h6 class="mb-1 fw-semibold">{{ $item->name }}</h6>
                                        <span class="text-muted small">{{ $item->category_name }}</span>
                                    </div>

                                    <!-- Price + Button -->
                                    <div class="d-flex flex-column align-items-end">
                                        <span class="mb-1 fw-bold text-dark">{{ $item->price }} MMK</span>
                                        <a href="{{ route('user#details', $item->id) }}"
                                            class="btn btn-sm btn-outline-dark rounded-pill">
                                            View
                                        </a>
                                    </div>

                                </div>
                            </div>
                        @empty
                            <div class="text-center col-12">
                                <img src="{{ asset('default/noitem.png') }}" class="w-50">
                            </div>
                        @endforelse

                    </div>
                    <span class="mt-3 d-flex justify-content-end">
                        {{ $products->links() }}
                    </span>


                </div>
            </div>
        </div>
    </div>
    <!-- POS Products End -->

@endsection