@extends('layouts.admin')

@section('content')
    <h4>Messages</h4>
    <table class="table">
        <thead>
            <tr><th>#</th><th>Name</th><th>Email</th><th>Subject</th><th>Status</th><th>Action</th></tr>
        </thead>
        <tbody>
            @foreach($messages as $message)
                <tr>
                    <td>{{ $message->id }}</td>
                    <td>{{ $message->name }}</td>
                    <td>{{ $message->email }}</td>
                    <td>{{ $message->subject }}</td>
                    <td>{{ $message->is_read ? 'Read' : 'Unread' }}</td>
                    <td><a href="{{ route('admin.messages.show', $message->id) }}" class="btn btn-info btn-sm">View</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $messages->links() }}
@endsection
