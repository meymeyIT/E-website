@extends('layouts.admin')

@section('content')
<div class="container py-3" style="max-width: 600px;">
    <h4 class="mb-3 text-primary">Edit User</h4>

    @if ($errors->any())
    <div class="alert alert-danger py-2 px-3">
        <ul class="mb-0 small">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="shadow-sm p-3 rounded border bg-light">
        @csrf
        @method('PUT')

        <div class="mb-2">
            <label for="name" class="form-label small">Name</label>
            <input type="text" name="name" class="form-control form-control-sm" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="mb-2">
            <label for="email" class="form-label small">Email</label>
            <input type="email" name="email" class="form-control form-control-sm" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="mb-2">
            <label for="role" class="form-label small">Role</label>
            <select name="role" class="form-select form-select-sm" required>
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
            </select>
        </div>

        <div class="mb-2">
            <label for="password" class="form-label small">
                Password <small class="text-muted">(leave blank to keep current)</small>
            </label>
            <input type="password" name="password" class="form-control form-control-sm">
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label small">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control form-control-sm">
        </div>

        <div class="d-flex justify-content-between">
            <button class="btn btn-sm btn-primary px-3" type="submit">
                <i class="fas fa-save me-1"></i> Update
            </button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-secondary px-3">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
