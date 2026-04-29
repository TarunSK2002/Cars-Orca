@extends('admin.layout')

@section('title', 'Sell Requests - Cars Orca')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2 glow-text fw-bold">Car Sell Requests</h1>
</div>

<div class="admin-card p-4">
    <div class="table-responsive">
        <table class="table table-dark table-hover mb-0 align-middle">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Seller Info</th>
                    <th>Car Offered</th>
                    <th>Extra Message</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sellRequests as $request)
                <tr>
                    <td>{{ $request->created_at->format('M d, Y') }}</td>
                    <td>
                        <strong>{{ $request->name }}</strong><br>
                        <span class="text-muted small"><i class="fa-solid fa-phone me-1"></i> {{ $request->phone }}</span><br>
                        @if($request->email)
                        <span class="text-muted small"><i class="fa-solid fa-envelope me-1"></i> {{ $request->email }}</span>
                        @endif
                    </td>
                    <td>
                        <div class="text-truncate" style="max-width: 200px;" title="{{ $request->car_details }}">
                            {{ $request->car_details }}
                        </div>
                    </td>
                    <td>
                        <div class="text-truncate" style="max-width: 200px;" title="{{ $request->message }}">
                            {{ $request->message ?: 'N/A' }}
                        </div>
                    </td>
                    <td>
                        <span class="badge @if($request->status == 'New') bg-info @elseif($request->status == 'Contacted') bg-warning @else bg-secondary @endif">
                            {{ $request->status }}
                        </span>
                    </td>
                    <td class="text-end">
                        <form action="{{ route('admin.sell-requests.status', $request->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="form-select form-select-sm bg-dark text-white border-secondary d-inline-block w-auto me-1" onchange="this.form.submit()">
                                <option value="New" {{ $request->status == 'New' ? 'selected' : '' }}>New</option>
                                <option value="Contacted" {{ $request->status == 'Contacted' ? 'selected' : '' }}>Contacted</option>
                                <option value="Closed" {{ $request->status == 'Closed' ? 'selected' : '' }}>Closed</option>
                            </select>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted p-4">No sell requests found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4 d-flex justify-content-center">
        {{ $sellRequests->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
