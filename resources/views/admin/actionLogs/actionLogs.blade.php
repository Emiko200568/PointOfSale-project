@extends('admin.layouts.master')

@section('content')

<div class="mt-4 container-fluid">

    <div class="row justify-content-center">
        <div class="col-11">

            <!-- Page Header -->
            <div class="mb-3 d-flex justify-content-between align-items-center">
                <h3 class="text-black fw-bold"><i class="fa-solid fa-list-check me-2"></i>Action Logs</h3>
                <a href="{{ route('admin#home') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fa-solid fa-arrow-left me-1"></i> Back to Dashboard
                </a>
            </div>

            <div class="py-3 bg-white ms-3 card-header d-flex justify-content-between align-items-center">

                <div class="d-flex" style="gap:15px;">
                    <a href="{{ route('admin#actionLogs') }}"
                       class="btn btn-sm {{ request('type') == null ? 'btn-dark' : 'btn-outline-dark' }}">
                        ALL
                    </a>

                    <a href="{{ route('admin#actionLogs',['type'=>'created']) }}"
                       class="btn btn-sm {{ request('type') == 'created' ? 'btn-secondary' : 'btn-outline-secondary' }}">
                        Created
                    </a>

                    <a href="{{ route('admin#actionLogs',['type'=>'purchased']) }}"
                       class="btn btn-sm {{ request('type') == 'purchased' ? 'btn-success' : 'btn-outline-success' }}">
                        Purchased
                    </a>

                </div>

                <span class="text-white badge bg-secondary">{{ $totalLogs }} Logs</span>

            </div>




            <!-- Card -->
            <div class="border-0 shadow-sm card">
                <div class="p-0 card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="bg-light text-secondary small">
                                <tr>
                                    <th>ID</th>
                                    <th>User</th>
                                    <th>Role</th>
                                    <th>Product</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                    <th>Date & Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($actionLogs as $log)
                                <tr>
                                    <td>{{ $log->id }}</td>
                                    <td>{{ $log->user?->name }}</td>
                                    <td>{{ $log->user?->role }}</td>
                                    <td>{{ $log->product?->name }}</td>

                                    <td>
                                        <img src="{{ asset('productImage/'.$log->product?->image) }}" width="50" height="50">
                                    </td>

                                    <td>
                                        @if($log->action == 'purchased')
                                            <span class="text-white badge bg-success">Purchased</span>
                                        @elseif($log->action == 'created')
                                            <span class="text-white badge bg-secondary">Created</span>
                                        @endif
                                    </td>

                                    <td>{{ $log->created_at->format('d-F-Y') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">No action logs found</td>
                                </tr>
                                @endforelse
                                </tbody>

                        </table>
                    </div>
                </div>

                <div class="mt-2 d-flex justify-content-end text-secondary">
                    {{ $actionLogs->links() }}
                </div>

            </div>

        </div>
    </div>

</div>

@endsection
