@extends('admin.layout')

@section('title', 'Contact Messages - Cars Orca')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2 glow-text fw-bold">General Contact Messages</h1>
</div>

<div class="admin-card p-4">
    <div class="table-responsive">
        <table class="table table-dark table-hover mb-0 align-middle">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Sender</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $msg)
                <tr>
                    <td>{{ $msg->created_at->format('M d, Y') }}</td>
                    <td>
                        <strong>{{ $msg->name }}</strong><br>
                        <span class="text-muted small"><i class="fa-solid fa-phone me-1"></i> {{ $msg->phone }}</span><br>
                        @if($msg->email)
                        <span class="text-muted small"><i class="fa-solid fa-envelope me-1"></i> {{ $msg->email }}</span>
                        @endif
                    </td>
                    <td>
                        <div class="text-wrap" style="max-width: 400px;">
                            {{ $msg->message }}
                        </div>
                    </td>
                    <td>
                        <span class="badge @if($msg->status == 'New') bg-info @elseif($msg->status == 'Read') bg-warning @else bg-secondary @endif">
                            {{ $msg->status }}
                        </span>
                    </td>
                    <td class="text-end">
                        <form action="{{ route('admin.contacts.status', $msg->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="form-select form-select-sm bg-dark text-white border-secondary d-inline-block w-auto me-1" onchange="this.form.submit()">
                                <option value="New" {{ $msg->status == 'New' ? 'selected' : '' }}>New</option>
                                <option value="Read" {{ $msg->status == 'Read' ? 'selected' : '' }}>Read</option>
                                <option value="Closed" {{ $msg->status == 'Closed' ? 'selected' : '' }}>Closed</option>
                            </select>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted p-4">No contact messages received yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4 d-flex justify-content-center">
        {{ $messages->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
