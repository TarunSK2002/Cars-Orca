@extends('admin.layout')

@section('title', 'Customer Enquiries - Cars Orca')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2 glow-text fw-bold">Customer Enquiries</h1>
</div>

<div class="admin-card p-4">
    <div class="table-responsive">
        <table class="table table-dark table-hover mb-0 align-middle">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Customer Info</th>
                    <th>Car Requested</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($enquiries as $enquiry)
                <tr>
                    <td>{{ $enquiry->created_at->format('M d, Y') }}</td>
                    <td>
                        <strong>{{ $enquiry->name }}</strong><br>
                        <span class="text-muted small"><i class="fa-solid fa-phone me-1"></i> {{ $enquiry->phone }}</span><br>
                        @if($enquiry->email)
                        <span class="text-muted small"><i class="fa-solid fa-envelope me-1"></i> {{ $enquiry->email }}</span>
                        @endif
                    </td>
                    <td>
                        @if($enquiry->car)
                        <div class="d-flex align-items-center">
                            @if($enquiry->car->images->isNotEmpty())
                                <img src="{{ asset('storage/' . $enquiry->car->images->first()->image_path) }}" class="rounded me-2" style="width: 50px; height: 35px; object-fit: cover;">
                            @endif
                            <span>{{ $enquiry->car->company }} {{ $enquiry->car->model }}</span>
                        </div>
                        @else
                        <span class="text-muted">Deleted Car</span>
                        @endif
                    </td>
                    <td>
                        <div class="text-truncate" style="max-width: 250px;" title="{{ $enquiry->message }}">
                            {{ $enquiry->message }}
                        </div>
                    </td>
                    <td>
                        <span class="badge @if($enquiry->status == 'New') bg-info @elseif($enquiry->status == 'Contacted') bg-warning @else bg-secondary @endif">
                            {{ $enquiry->status }}
                        </span>
                    </td>
                    <td class="text-end">
                        <form action="{{ route('admin.enquiries.status', $enquiry->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="form-select form-select-sm bg-dark text-white border-secondary d-inline-block w-auto me-1" onchange="this.form.submit()">
                                <option value="New" {{ $enquiry->status == 'New' ? 'selected' : '' }}>New</option>
                                <option value="Contacted" {{ $enquiry->status == 'Contacted' ? 'selected' : '' }}>Contacted</option>
                                <option value="Closed" {{ $enquiry->status == 'Closed' ? 'selected' : '' }}>Closed</option>
                            </select>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted p-4">No enquiries found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4 d-flex justify-content-center">
        {{ $enquiries->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
