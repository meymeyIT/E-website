@extends('layouts.admin')

@section('content')
<div class="container py-3" style="max-width: 600px;">
    <h5 class="mb-3 text-primary">Create New User</h5>

    @if ($errors->any())
    <div class="alert alert-danger py-2 px-3 small">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.users.store') }}" method="POST" class="shadow-sm p-3 border rounded bg-light">
        @csrf

        <div class="mb-2">
            <label for="name" class="form-label small">Name</label>
            <input type="text" name="name" class="form-control form-control-sm" value="{{ old('name') }}" required>
        </div>

        <div class="mb-2">
            <label for="email" class="form-label small">Email</label>
            <input type="email" name="email" class="form-control form-control-sm" value="{{ old('email') }}" required>
        </div>

        <div class="mb-2">
            <label for="role" class="form-label small">Role</label>
            <select name="role" class="form-select form-select-sm" required>
                <option value="">Select Role</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
            </select>
        </div>

        <div class="mb-2">
            <label for="password" class="form-label small">Password</label>
            <input type="password" name="password" class="form-control form-control-sm" required>
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label small">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control form-control-sm" required>
        </div>

        <div class="d-flex justify-content-between">
            <button class="btn btn-sm btn-primary px-3" type="submit">
                <i class="fas fa-plus me-1"></i> Create
            </button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-secondary px-3">Cancel</a>
        </div>
    </form>
</div>
@endsection
