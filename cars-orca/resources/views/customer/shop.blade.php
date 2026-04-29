@extends('customer.layout')

@section('title', 'Buy Cars - Cars Orca')

@section('content')
<div class="row g-4">
    <!-- Filter Sidebar -->
    <div class="col-lg-3">
        <div class="glass-card p-4">
            <h5 class="fw-bold glow-text mb-4"><i class="fa-solid fa-sliders me-2"></i>Filter Inventory</h5>
            
            <form action="{{ route('shop') }}" method="GET">
                <!-- Search -->
                <div class="mb-3">
                    <label class="form-label text-muted small">Search</label>
                    <input type="text" name="search" class="form-control glass-input" value="{{ request('search') }}" placeholder="Make, Model...">
                </div>

                <!-- Company -->
                <div class="mb-3">
                    <label class="form-label text-muted small">Brand</label>
                    <select name="company" class="form-select glass-input">
                        <option value="">All Brands</option>
                        @foreach($companies as $company)
                            <option value="{{ $company }}" {{ request('company') == $company ? 'selected' : '' }}>{{ $company }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Fuel Type -->
                <div class="mb-3">
                    <label class="form-label text-muted small">Fuel Type</label>
                    <select name="fuel_type" class="form-select glass-input">
                        <option value="">All Types</option>
                        <option value="Petrol" {{ request('fuel_type') == 'Petrol' ? 'selected' : '' }}>Petrol</option>
                        <option value="Diesel" {{ request('fuel_type') == 'Diesel' ? 'selected' : '' }}>Diesel</option>
                        <option value="CNG" {{ request('fuel_type') == 'CNG' ? 'selected' : '' }}>CNG</option>
                        <option value="Electric" {{ request('fuel_type') == 'Electric' ? 'selected' : '' }}>Electric</option>
                    </select>
                </div>

                <!-- Transmission -->
                <div class="mb-3">
                    <label class="form-label text-muted small">Transmission</label>
                    <select name="transmission" class="form-select glass-input">
                        <option value="">All</option>
                        <option value="Manual" {{ request('transmission') == 'Manual' ? 'selected' : '' }}>Manual</option>
                        <option value="Automatic" {{ request('transmission') == 'Automatic' ? 'selected' : '' }}>Automatic</option>
                    </select>
                </div>

                <!-- Price Range -->
                <div class="mb-4">
                    <label class="form-label text-muted small">Price Range (₹)</label>
                    <div class="d-flex gap-2">
                        <input type="number" name="min_price" class="form-control glass-input" value="{{ request('min_price') }}" placeholder="Min">
                        <input type="number" name="max_price" class="form-control glass-input" value="{{ request('max_price') }}" placeholder="Max">
                    </div>
                </div>

                <button type="submit" class="premium-btn w-100 mb-2">Apply Filters</button>
                <a href="{{ route('shop') }}" class="btn btn-sm btn-outline-light w-100 rounded-pill">Reset</a>
            </form>
        </div>
    </div>

    <!-- Inventory Display -->
    <div class="col-lg-9">
        <div class="row g-4">
            @forelse($cars as $car)
            <div class="col-md-6 col-lg-4">
                <div class="glass-card h-100 overflow-hidden" style="transition: transform 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                    <div class="position-relative">
                        @if($car->images->isNotEmpty())
                            <img src="{{ asset('storage/' . $car->images->first()->image_path) }}" class="img-fluid w-100" style="height: 180px; object-fit: cover;">
                        @else
                            <div class="d-flex align-items-center justify-content-center bg-secondary bg-opacity-10 text-muted" style="height: 180px;">
                                <i class="fa-solid fa-car fs-1"></i>
                            </div>
                        @endif
                    </div>

                    <div class="p-3">
                        <h6 class="fw-bold mb-1 text-truncate">{{ $car->company }} {{ $car->model }}</h6>
                        <p class="text-muted small mb-2">{{ $car->year_of_manufacture }} • {{ $car->fuel_type }}</p>
                        
                        <div class="d-flex justify-content-between align-items-center mt-3 pt-2 border-top border-secondary">
                            <div class="fw-bold text-info">₹ {{ number_format($car->total_price) }}</div>
                            <a href="{{ route('car.show', $car->id) }}" class="btn btn-sm btn-outline-light rounded-pill px-3">Details</a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center text-muted py-5 glass-card">
                <i class="fa-solid fa-magnifying-glass fs-1 mb-3 text-secondary"></i>
                <h5>No cars found matching your criteria.</h5>
                <p class="small">Try removing active filters or searching for alternative makes.</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-4 d-flex justify-content-center">
            {{ $cars->withQueryString()->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
