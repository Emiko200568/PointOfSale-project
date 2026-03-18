@extends('admin.layouts.master')

@section('content')

<div class="row justify-content-center">
    <div class="col-11">

        <h3 class="mb-3">Contact List</h3>

        <div class="border-0 shadow-sm card">
            <div class="card-body table-responsive">
                <table class="table align-middle table-hover">
                    <thead class="text-center text-white bg-secondary">
                        <tr>
                            <th>ID</th>
                            <th>User Name</th>
                            <th>User Email</th>
                            <th>Title</th>
                            <th>Message</th>
                            <th>Date</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($contacts as $contact)
                        <tr>
                            <td>{{ $contact->id }}</td>
                            <td>{{ $contact->user_name }}</td>
                            <td>{{ $contact->user_email }}</td>
                            <td>{{ $contact->title }}</td>
                            <td>{{ $contact->message }}</td>
                            <td>{{ $contact->created_at->format('d-F-Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No contacts found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

@endsection

