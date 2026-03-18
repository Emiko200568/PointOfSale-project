@extends('admin.layouts.master')

@section('content')

    <div class="container">
        <div class="my-2 d-flex justify-content-between">
            <a href="{{ route('profile#userList') }}"> <button class=" btn btn-sm btn-secondary"> User List</button> </a>
            <button class="btn btn-sm btn-secondary">Admin Count - {{ count($adminAccounts) }}</button>
            <div class="">
                <form action="{{ route('profile#adminList') }}" method="get">
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

                        @foreach ($adminAccounts as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->address == null ? '_' : $item->address}}</td>
                                <td>{{ $item->phone == null ? '_' : $item->phone}}</td>
                                <td>
                                        @if($item->role == 'superadmin')
                                        <span class="text-info"> Super Admin</span>
                                        @elseif ($item->role == 'admin')
                                        <span class="text-success"> Admin</span>
                                        @endif
                                    </td>
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
                                    {{-- <a href="" class="btn btn-sm btn-outline-secondary"> <i
                                            class="fa-solid fa-pen-to-square"></i> </a> --}}
                                            @if ($item->role != 'superadmin')
                                            <button
                                                onclick="deleteConfirm('{{ route('profile#delete', $item->id) }}')"
                                                class="btn btn-sm btn-outline-danger">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        @endif



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