@extends('dashboard.layouts.app')

@section('content')
<div class="bg-white shadow rounded p-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <div>
            <h2 class="h4 fw-semibold text-dark mb-1">Schedules</h2>
            <p class="text-muted small mb-0">Manage all your Schedules</p>
        </div>
        <a href="{{ route('user.create') }}" class="btn btn-success">
            + Add Users
        </a>
    </div>

    <!-- Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th style="width: 50px;">ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th style="min-width: 150px;">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Admin</td>
                    <td>
                        <span class="badge bg-primary">View</span>
                        <span class="badge bg-primary">Edit</span>
                        <span class="badge bg-primary">Delete</span>
                    </td>
                    <td>
                        <a href="#" class="btn btn-sm btn-primary">Edit</a>
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>User</td>
                    <td>
                        <span class="badge bg-primary">View</span>
                    </td>
                    <td>
                        <a href="#" class="btn btn-sm btn-primary">Edit</a>
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Manager</td>
                    <td>
                        <span class="badge bg-primary">View</span>
                        <span class="badge bg-primary">Edit</span>
                    </td>
                    <td>
                        <a href="#" class="btn btn-sm btn-primary">Edit</a>
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
