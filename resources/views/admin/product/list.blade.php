@extends('admin.layouts.master')

@section('content')

<div class="row justify-content-center">
    <div class="col-10">

        <div class="border-0 shadow-sm card">
            <div class="p-2 card-body">

                <table class="table mb-0 text-center align-middle table-hover table-sm">
                    <thead class="text-white bg-secondary">
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Stock</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($products as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>
                                <img src="{{ asset('productImage/'.$item->image) }}" class="rounded img-thumbnail" style="width:60px; height:60px;" alt="{{ $item->name }}">
                            </td>
                            <td>{{ $item->name }}</td>
                            <td>
                                <span class="btn btn-sm
                                    @if($item->stock == 0) btn-danger
                                    @elseif($item->stock <= 5) btn-warning
                                    @else btn-dark @endif position-relative">
                                    {{ $item->stock }}
                                    @if($item->stock == 0)
                                    <span class="top-0 position-absolute start-100 translate-middle badge rounded-pill bg-danger">
                                        Out of Stock
                                    </span>
                                    @elseif($item->stock <= 5)
                                    <span class="top-0 position-absolute start-100 translate-middle badge rounded-pill bg-warning text-dark">
                                        Low
                                    </span>
                                    @endif
                                </span>
                            </td>
                            <td>{{ $item->created_at->format('d M, Y') }}</td>
                            <td>
                                <a href="{{ route('product#detail', $item->id) }}" class="btn btn-sm btn-outline-info me-1 rounded-circle">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ route('product#edit', $item->id) }}" class="btn btn-sm btn-outline-secondary me-1 rounded-circle">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <button type="button" onclick="deleteConfirm('{{ route('product#delete', $item->id) }}')" class="btn btn-sm btn-outline-danger rounded-circle">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
        </div>

        <div class="mt-2 d-flex justify-content-end text-secondary">
            {{ $products->links() }}
        </div>

    </div>
</div>



@endsection



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
