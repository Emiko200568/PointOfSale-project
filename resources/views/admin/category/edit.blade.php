@extends('admin.layouts.master')

@section('content')

<div class="mt-5 row justify-content-center">
    <div class="col-md-6 col-lg-4">

        <!-- Back Link -->
        <div class="mb-3 text-center">
            <a href="{{ route('category#list') }}" class="text-decoration-none text-secondary fw-semibold">
                &larr; Category List
            </a>
        </div>
        <hr>

        <!-- Update Category Card -->
        <div class="border-0 shadow-sm card">
            <div class="card-body">
                <h5 class="mb-4 text-center fw-bold">Update Category</h5>

                <form action="{{ route('category#update',$category->id) }}" method="post">
                    @csrf

                    <div class="mb-3">
                        <input type="text" name="categoryName"
                               value="{{ old('categoryName',$category->name) }}"
                               class="form-control rounded-pill @error('categoryName') is-invalid @enderror"
                               placeholder="Category Name...">
                        @error('categoryName')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit"
                            class="text-white btn w-100 rounded-pill fw-semibold"
                            style="background-color: #6c757d;"
                            onmouseover="this.style.backgroundColor='#adb5bd';"
                            onmouseout="this.style.backgroundColor='#6c757d';">
                        Update Category
                    </button>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection



@if (Session::has('updateSuccess'))
@section('script-code')
    <script>
            Swal.fire({
            title: "Update success!",
            icon: "success",
            timer:1300,
            timeProgressBar: true,
            draggable: true
            });

            setInterval(()=> {
                location.href="/admin/category/list"
            },1300)
    </script>
@endsection

@endif
