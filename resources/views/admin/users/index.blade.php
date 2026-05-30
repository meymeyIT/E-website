@extends('layouts.admin')

@section('content')
<div class="container py-3">
    <h5 class="mb-3 text-primary fw-bold">
        <i class="fas fa-users me-1"></i> User Management
    </h5>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show small" role="alert">
        <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-2">
        <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-user-plus me-1"></i> Add User
        </a>
    </div>

    @if($users->count() > 0)
    <div class="table-responsive rounded shadow-sm border">
        <table class="table table-sm table-bordered table-striped align-middle mb-0">
            <thead class="table-light text-center small text-primary">
                <tr>
                    <th>ID</th>
                    <th class="text-start">Name</th>
                    <th class="text-start">Email</th>
                    <th>Role</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="small">
                @foreach($users as $user)
                <tr class="text-center">
                    <td>{{ $user->id }}</td>
                    <td class="text-start">{{ $user->name }}</td>
                    <td class="text-start">{{ $user->email }}</td>
                    <td>{{ ucfirst($user->role ?? 'user') }}</td>
                    <td>{{ $user->created_at->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-outline-warning me-1" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Delete this user?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" title="Delete">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-3 d-flex justify-content-center small">
        {{ $users->links() }}
    </div>
    @else
    <p class="text-muted fst-italic text-center mt-4">No users found.</p>
    @endif
</div>
@endsection
