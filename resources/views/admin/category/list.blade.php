@extends('admin.layouts.master')

@section('content')


    <!-- Begin Page Content -->
    <div class="py-5 container-fluid">

        <!-- Page Heading -->
        <div class="mb-5 d-flex justify-content-between align-items-center">
            <h2 class="fw-bold text-secondary">Manage Categories</h2>
            <form action="{{ route('category#list') }}" method="get" class="d-flex">
                <input type="text" name="searchKey" value="{{ old('searchKey') }}"
                    class="border-0 shadow-sm form-control me-2" placeholder="Search category...">
                <button class="shadow-sm btn btn-outline-light" style="background-color: #6c757d;"
                    onmouseover="this.style.backgroundColor='#adb5bd';"
                    onmouseout="this.style.backgroundColor='#6c757d';">Search</button>

            </form>
        </div>

        <div class="row g-4">
            <!-- Create Category Form -->
            <div class="col-lg-4">
                <div class="border-0 shadow-sm card">
                    <div class="card-body">
                        <h5 class="mb-4 text-center text-black card-title">Add New Category</h5>
                        <form action="{{ route('category#create') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <input type="text" name="categoryName" value="{{ old('categoryName') }}"
                                    class="form-control @error('categoryName') is-invalid @enderror rounded-pill"
                                    placeholder="Category Name...">
                                @error('categoryName')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="mt-3 text-white btn w-100 rounded-pill fw-semibold"
                                style="background-color: #6c757d;" onmouseover="this.style.backgroundColor='#adb5bd';"
                                onmouseout="this.style.backgroundColor='#6c757d';">
                                Create Category
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Category Table -->
            <div class="col-lg-8">
                <div class="border-0 shadow-sm card">
                    <div class="p-0 card-body">
                        <table class="table mb-0 align-middle table-hover">
                            <thead class="text-center bg-light text-secondary">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @if($categoryCount != 0)
                                    @foreach ($categories as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->created_at->format('d M, Y') }}</td>
                                            <td>
                                                <a href="{{ route('category#edit', $item->id) }}"
                                                    class="btn btn-sm btn-outline-secondary me-1 rounded-circle">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                <button type="button"
                                                    onclick="deleteConfirm('{{ route('category#delete', $item->id) }}')"
                                                    class="btn btn-sm btn-outline-danger rounded-circle">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4" class="py-3 text-center text-muted">No categories available</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <span class=" d-flex justify-content-end">{{ $categories->links() }}</span>
                    </div>
                </div>
            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </div>



@endsection

@if (Session::has('success'))
    @section('script-code')
        <script>
            Swal.fire({
                title: "Create success!",
                icon: "success",
                timer: 1300,
                timeProgressBar: true,
                draggable: true
            });

            setInterval(() => {
                location.href = "/admin/category/list"
            }, 1300)
        </script>
    @endsection

@endif




@section('script-code')
    <script>
        function deleteConfirm(url) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {

                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success",
                        timer: 1000,
                        timerProgressBar: true,
                        showConfirmButton: false
                    });

                    setTimeout(() => {
                        window.location.href = url;
                    }, 1000);
                }
            });
        }
    </script>
@endsection