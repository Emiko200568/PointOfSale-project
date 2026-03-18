@extends('admin.layouts.master')

@section('content')

<div class="container">
<div class="my-2 d-flex justify-content-between">
    <a href="{{ route('profile#adminList') }}" class="btn btn-sm btn-secondary">
        Admin List
    </a>

    <button class="btn btn-sm btn-secondary">
        User Count - {{ count($userAccounts) }}
    </button>

    <div>
        <form action="{{ route('profile#userList') }}" method="get">
            <div class="input-group">
                <input type="text" name="searchKey" value="{{ request('searchKey') }}" class="form-control"
                       placeholder="Enter Search Key...">
                <button type="submit" class="text-white btn bg-dark">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
        </form>
    </div>
</div>

    <div class="row">
        <div class="col">
            <table class="table shadow-sm table-hover ">
                <thead class="text-white bg-secondary">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>Created Date</th>
                        <th> Platform</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($userAccounts as $item )
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->address ==null ? '_' : $item->address}}</td>
                        <td>{{ $item->phone ==null ? '_' : $item->phone}}</td>
                        <td><span class="text-success">
                            @if($item->role == 'user')User @endif
                        </span></td>
                        <td>{{ $item->created_at->format('d-F-Y') }}</td>
                        <td>
                            @if ($item->provider == 'simple')
                            <i class="fa-solid fa-unlock-keyhole"></i> simple
                            @elseif ($item->provider == 'google')
                            <i class="fa-brands fa-google"></i> google
                            @else
                            <i class="fa-brands fa-github"></i> github
                            @endif
                        </td>



                        <td>
                            {{-- <a href="" class="btn btn-sm btn-outline-secondary"> <i class="fa-solid fa-pen-to-square"></i> </a> --}}
                            <a href="javascript:void(0)"
   onclick="deleteConfirm('{{ route('profile#delete', $item->id) }}')"
   class="btn btn-sm btn-outline-danger">
   <i class="fa-solid fa-trash"></i>
</a>

                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>

            <span class=" d-flex justify-content-end"></span>
            <!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>


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
            window.location.href = url;
        }
    });
}

// Success alert after deletion
@if(session('success'))
Swal.fire({
    icon: 'success',
    title: 'Success!',
    text: "{{ session('success') }}",
    timer: 2000,
    showConfirmButton: false
});
@endif
</script>
@endsection




