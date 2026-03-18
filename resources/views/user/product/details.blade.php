@extends('user.layouts.master')

@section('content')

    <div class="py-5 mt-5 container-fluid">
        <div class="container py-5">
            <div class="mb-5 row g-4">
                <div class="col-lg-8 col-xl-9">
                    {{-- <a href=""> Home </a> <i class="mx-1 mb-4 fa-solid fa-greater-than"></i> Details --}}
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="overflow-hidden border shadow-sm rounded-4">
                                <a href="#">
                                    <img src="{{ asset('productImage/' . $product->image) }}"
                                        class="img-fluid w-100 hover-zoom" alt="{{ $product->name }}">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h4 class="fw-bold"></h4>
                            <span class="mb-3 text-danger">({{ $product->stock }} items left ! )</span>
                            <p class="mb-3">Category: {{ $product->category_name }} </p>
                            <h5 class="mb-3 fw-bold">{{ $product->price }} mmk</h5>
                            <div class="mb-4 d-flex">
                                <span class="">
                                    {{ $avgRating }} <i class="fa-solid fa-star text-warning"></i>
                                </span>

                                <span class=" ms-4">
                                    <i class="fa-solid fa-eye"></i>
                                </span>

                            </div>
                            <p class="mb-4"></p>
                            <form action="{{ route('user#addToCart') }}" method="post">
                                @csrf

                                <input type="hidden" name="userId" value="{{ auth()->user()->id }}">
                                <input type="hidden" name="productId" value="{{ $product->id }}">
                                <div class="mb-5 input-group quantity" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button type="button" class="border btn btn-sm btn-minus rounded-circle bg-light">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" name="count"
                                        class="text-center border-0 form-control form-control-sm" value="1">
                                    <div class="input-group-btn">
                                        <button type="button" class="border btn btn-sm btn-plus rounded-circle bg-light">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <button type="submit" class="px-4 py-2 mb-4 text-black border btn rounded-pill"><i
                                        class="text-black fa fa-shopping-bag me-2"></i> Add to cart</button>


                                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                    class="px-4 py-2 mb-4 text-black border btn rounded-pill"><i
                                        class="text-black fa-solid fa-star me-2"></i> Rate this product</button>
                            </form>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Rate this product
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('user#rating') }}" method="post">
                                            @csrf

                                            <div class="modal-body">
                                                <input type="hidden" name="userId" value="{{ auth()->user()->id }}">
                                                <input type="hidden" name="productId" value="{{ $product->id }}">

                                                <div class="rating-css">
                                                    <div class="star-icon">

                                                        {{-- Show existing rating --}}
                                                        {{ $rating }}

                                                        @if ($rating == null)

                                                            <input type="radio" name="productRating" value="1" id="rating1" checked>
                                                            <label for="rating1" class="fa fa-star"></label>

                                                            <input type="radio" name="productRating" value="2" id="rating2">
                                                            <label for="rating2" class="fa fa-star"></label>

                                                            <input type="radio" name="productRating" value="3" id="rating3">
                                                            <label for="rating3" class="fa fa-star"></label>

                                                            <input type="radio" name="productRating" value="4" id="rating4">
                                                            <label for="rating4" class="fa fa-star"></label>

                                                            <input type="radio" name="productRating" value="5" id="rating5">
                                                            <label for="rating5" class="fa fa-star"></label>

                                                        @else

                                                            {{-- Checked stars --}}
                                                            @for ($i = 1; $i <= $rating; $i++)
                                                                <input
                                                                    type="radio"
                                                                    name="productRating"
                                                                    value="{{ $i }}"
                                                                    id="rating{{ $i }}"
                                                                    checked
                                                                >
                                                                <label for="rating{{ $i }}" class="fa fa-star"></label>
                                                            @endfor

                                                            {{-- Remaining stars --}}
                                                            @for ($j = $rating + 1; $j <= 5; $j++)
                                                                <input
                                                                    type="radio"
                                                                    name="productRating"
                                                                    value="{{ $j }}"
                                                                    id="rating{{ $j }}"
                                                                >
                                                                <label for="rating{{ $j }}" class="fa fa-star"></label>
                                                            @endfor

                                                        @endif

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Close
                                                </button>

                                                <button type="submit" class="btn btn-theme">
                                                    Rating
                                                </button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="col-lg-12">
                            <nav>
                                <div class="mb-3 nav nav-tabs">
                                    <button class="border-white nav-link active border-bottom-0" type="button" role="tab"
                                        id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about"
                                        aria-controls="nav-about" aria-selected="true">Description</button>
                                    <button class="border-white nav-link border-bottom-0" type="button" role="tab"
                                        id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission"
                                        aria-controls="nav-mission" aria-selected="false">Customer Comments <span
                                            class="shadow-sm btn btn-sm btn-secondary rounted">{{ count($comment) }}</span>

                                    </button>
                                </div>
                            </nav>
                            <div class="mb-5 tab-content">
                                <div class="tab-pane active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                                    <p>{{ $product->description }}</p>
                                </div>
                                <div class="tab-pane" id="nav-mission" role="tabpanel" aria-labelledby="nav-mission-tab">


                                    @foreach ($comment as $item)
                                        <div class="d-flex">
                                            <img src="{{ asset($item->profile == null ? 'default/profile.webp' : 'userProfile/' . $item->profile) }}"
                                                class="p-3 img-fluid rounded-circle" style="width: 100px; height: 100px;">
                                            <div class="ms-3">
                                                <p class="" style="font-size: 14px;">
                                                    {{ $item->created_at->format('d-F-Y') }}
                                                </p>
                                                <div class="d-flex justify-content-between">
                                                    <h5>{{ $item->name }}</h5>

                                                </div>
                                                <p>{{ $item->message }}</p>

                                                @if (auth()->user()->id == $item->user_id)
                                                    <span onclick="deleteComment({{ $item->comment_id }})"
                                                        class="px-2 rounded btn btn-outline-danger btn-sm"><i
                                                            class="fa-solid fa-trash"></i> Delete</span>
                                                @endif
                                            </div>
                                        </div>
                                        <hr>
                                    @endforeach



                                </div>

                            </div>
                        </div>
                        <form action="{{ route('user#comment', $product->id) }}" method="post">
                            @csrf

                            <input type="hidden" name="productId" value="{{ $product->id }}">
                            <input type="hidden" name="userId" value="{{auth()->user()->id}}">


                            <h4 class="mb-5 fw-bold">
                                Leave a Comments

                            </h4>

                            <div class="row g-1">
                                <div class="col-lg-12">
                                    <div class="rounded border-bottom ">
                                        <textarea name="comment" id="" class="border-0 shadow-sm form-control" cols="30"
                                            rows="8" placeholder="Write your comment..." spellcheck="false"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="py-3 mb-5 d-flex justify-content-between">
                                        <button type="submit"
                                            class="px-4 py-3 text-black border btn border-secondary rounded-pill">
                                            Post
                                            Comment</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>

@endsection


@section('script-code')
    <script>

        @if (session('success'))
            Swal.fire({
                title: "Comment success!",
                icon: "success",
                timer: 1300,
                timerProgressBar: true,
                showConfirmButton: false
            });
        @endif

        @if (session('RatingSuccess'))
            Swal.fire({
                title: "Rating success!",
                icon: "success",
                timer: 1300,
                timerProgressBar: true,
                showConfirmButton: false
            });
        @endif

        @if (session('AddToCartSuccess'))
            Swal.fire({
                title: "Add to cart success!",
                icon: "success",
                timer: 1300,
                timerProgressBar: true,
                showConfirmButton: false
            });
        @endif

        @if (session('successDelete'))
        Swal.fire({
            title: "{{ session('successDelete') }}",
            icon: "success",
            timer: 1300,
            timerProgressBar: true,
            showConfirmButton: false
        });
    @endif

    function deleteComment(id) {
        Swal.fire({
            title: "Are you sure to delete this comment?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "/user/comment/delete/" + id;
            }
        });
    }

    </script>
@endsection