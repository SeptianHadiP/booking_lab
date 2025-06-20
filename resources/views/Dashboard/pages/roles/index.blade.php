@extends('dashboard.layouts.app')

@section('content')
<div class="bg-white shadow rounded p-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <div>
            <h2 class="h4 fw-semibold text-dark mb-1">Roles</h2>
            <p class="text-muted small mb-0">Manage all your roles</p>
        </div>
        <a href="{{ route('roles.create') }}" class="btn btn-success">
            + Create Role
        </a>
    </div>

    <!-- Table --> 
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th style="width: 50px;">ID</th>
                    <th>Name</th>
                    <th>Permissions</th>
                    <th style="max-width: 100px;">Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- @foreach($roles as $role) -->
                    <tr>
                        <td class="px-6 py-2 ">1</td>
                        <td>dakd</td>
                        <td>jbdjab@jdnksd.com</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-primary">Edit</a>
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </td>
                    </tr>
                    <button class="cursor-pointer px-3 py-2 text-xs font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Edit
                    </button>
                    <button class="cursor-pointer px-3 py-2 text-xs font-medium text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 ml-1">
                        Delete
                    </button>
                <!-- @endforeach -->
            </tbody>
        </table>
    </div>
</div>
@endsection