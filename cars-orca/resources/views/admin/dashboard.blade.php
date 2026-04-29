@extends('admin.layout')

@section('title', 'Admin Dashboard - Cars Orca')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2 glow-text fw-bold">Dashboard</h1>
    <div class="text-muted">Welcome to the Cars Orca Administration</div>
</div>

<!-- Stats Cards -->
<div class="row g-4 mb-5">
    <div class="col-md-3">
        <div class="admin-card p-4 d-flex align-items-center">
            <div class="bg-primary bg-opacity-25 text-primary p-3 rounded-circle me-3">
                <i class="fa-solid fa-car fs-3"></i>
            </div>
            <div>
                <div class="text-muted small">Total Fleet</div>
                <div class="fs-3 fw-bold">{{ $totalCars }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="admin-card p-4 d-flex align-items-center">
            <div class="bg-success bg-opacity-25 text-success p-3 rounded-circle me-3">
                <i class="fa-solid fa-circle-check fs-3"></i>
            </div>
            <div>
                <div class="text-muted small">Available</div>
                <div class="fs-3 fw-bold">{{ $availableCars }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="admin-card p-4 d-flex align-items-center">
            <div class="bg-danger bg-opacity-25 text-danger p-3 rounded-circle me-3">
                <i class="fa-solid fa-tags fs-3"></i>
            </div>
            <div>
                <div class="text-muted small">Sold</div>
                <div class="fs-3 fw-bold">{{ $soldCars }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="admin-card p-4 d-flex align-items-center">
            <div class="bg-info bg-opacity-25 text-info p-3 rounded-circle me-3">
                <i class="fa-solid fa-envelope fs-3"></i>
            </div>
            <div>
                <div class="text-muted small">Enquiries</div>
                <div class="fs-3 fw-bold">{{ $enquiriesCount }}</div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Enquiries -->
<div class="row">
    <div class="col-md-12">
        <div class="admin-card p-4">
            <h5 class="mb-4"><i class="fa-solid fa-bell me-2 text-primary"></i> Recent Customer Enquiries</h5>
            <div class="table-responsive">
                <table class="table table-dark table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Car</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentEnquiries as $enquiry)
                        <tr>
                            <td>{{ $enquiry->created_at->format('M d, Y') }}</td>
                            <td>
                                <strong>{{ $enquiry->name }}</strong><br>
                                <span class="text-muted small">{{ $enquiry->phone }}</span>
                            </td>
                            <td>
                                @if($enquiry->car)
                                    {{ $enquiry->car->company }} {{ $enquiry->car->model }}
                                @else
                                    <span class="text-muted">Deleted Car</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge @if($enquiry->status == 'New') bg-info @elseif($enquiry->status == 'Contacted') bg-warning @else bg-secondary @endif">
                                    {{ $enquiry->status }}
                                </span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.enquiries.index') }}" class="btn btn-sm btn-outline-primary">Manage</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted p-4">No recent enquiries found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
