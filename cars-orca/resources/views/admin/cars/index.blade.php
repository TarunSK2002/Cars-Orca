@extends('admin.layout')

@section('title', 'Manage Cars - Cars Orca')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2 glow-text fw-bold">Manage Cars</h1>
    <a href="{{ route('admin.cars.create') }}" class="btn btn-primary">
        <i class="fa-solid fa-plus me-1"></i> Add New Car
    </a>
</div>

<div class="admin-card p-4">
    <div class="table-responsive">
        <table class="table table-dark table-hover mb-0 align-middle">
            <thead>
                <tr>
                    <th>Car</th>
                    <th>Color</th>
                    <th>KM Driven</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($cars as $car)
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            @if($car->images->isNotEmpty())
                                <img src="{{ asset('storage/' . $car->images->first()->image_path) }}" class="rounded me-3" style="width: 60px; height: 40px; object-fit: cover;">
                            @else
                                <div class="bg-secondary bg-opacity-25 rounded me-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 40px;">
                                    <i class="fa-solid fa-car text-muted"></i>
                                </div>
                            @endif
                            <div>
                                <strong>{{ $car->company }} {{ $car->model }}</strong><br>
                                <span class="text-muted small">{{ $car->registration_number }} ({{ $car->year_of_manufacture }})</span>
                            </div>
                        </div>
                    </td>
                    <td>{{ $car->color }}</td>
                    <td>{{ number_format($car->km_driven) }} km</td>
                    <td><strong class="text-info">₹ {{ number_format($car->total_price) }}</strong></td>
                    <td>
                        <span class="badge @if($car->status == 'Available') bg-success @else bg-danger @endif">
                            {{ $car->status }}
                        </span>
                    </td>
                    <td class="text-end">
                        <a href="{{ route('admin.cars.edit', $car->id) }}" class="btn btn-sm btn-outline-warning me-2">
                            <i class="fa-solid fa-pen"></i> Edit
                        </a>
                        <form action="{{ route('admin.cars.destroy', $car->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this car?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted p-4">No cars in fleet yet. Get started by adding one!</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4 d-flex justify-content-center">
        {{ $cars->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
