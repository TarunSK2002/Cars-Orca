@extends('customer.layout')

@section('title', 'Cars Orca - Premium Pre-Owned Vehicle Marketplace')

@section('content')
<!-- Hero Section -->
<div class="glass-card p-5 mb-5 text-center position-relative overflow-hidden" style="border-radius: 24px;">
    <div class="py-4 position-relative" style="z-index: 10;">
        <h1 class="display-3 fw-bold mb-3"><span class="glow-text">Find Your Dream Car</span><br>At Unbeatable Value</h1>
        <p class="lead text-muted mx-auto mb-4" style="max-width: 600px;">
            We bridge the gap between premium performance and accessible pricing. Certified diagnostics, clear document checks, zero hidden fees.
        </p>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('shop') }}" class="premium-btn text-decoration-none">Explore Fleet</a>
            <a href="{{ route('sell') }}" class="btn btn-outline-light rounded-pill px-4 py-2 fw-bold">Sell Your Car</a>
        </div>
    </div>
    
    <!-- Abstract Glow Rings -->
    <div style="position: absolute; top: -50%; left: -20%; width: 300px; height: 300px; background: rgba(99, 102, 241, 0.3); filter: blur(80px); border-radius: 50%;"></div>
    <div style="position: absolute; bottom: -50%; right: -20%; width: 400px; height: 400px; background: rgba(168, 85, 247, 0.3); filter: blur(100px); border-radius: 50%;"></div>
</div>

<!-- Featured Cars -->
<div class="d-flex justify-content-between align-items-end mb-4 mt-5">
    <div>
        <h2 class="fw-bold glow-text mb-1">New Arrivals</h2>
        <p class="text-muted small mb-0">Handpicked premium rides that just hit the market.</p>
    </div>
    <a href="{{ route('shop') }}" class="text-info text-decoration-none fw-bold">See All <i class="fa-solid fa-arrow-right small ms-1"></i></a>
</div>

<div class="row g-4 mb-5">
    @forelse($featuredCars as $car)
    <div class="col-md-6 col-lg-3">
        <div class="glass-card h-100 overflow-hidden" style="transition: transform 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
            <!-- Image Carousel / Thumbnail -->
            <div class="position-relative">
                @if($car->images->isNotEmpty())
                    <img src="{{ asset('storage/' . $car->images->first()->image_path) }}" class="img-fluid w-100" style="height: 200px; object-fit: cover;">
                @else
                    <div class="d-flex align-items-center justify-content-center bg-secondary bg-opacity-10 text-muted" style="height: 200px;">
                        <i class="fa-solid fa-car fs-1"></i>
                    </div>
                @endif
                <span class="position-absolute top-0 end-0 m-3 badge badge-available rounded-pill px-3 py-2">Available</span>
            </div>

            <!-- Card Body -->
            <div class="p-3">
                <h5 class="fw-bold mb-1 text-truncate">{{ $car->company }} {{ $car->model }}</h5>
                <p class="text-muted small mb-2">{{ $car->year_of_manufacture }} • {{ $car->fuel_type }} • {{ $car->transmission }}</p>
                
                <div class="d-flex justify-content-between align-items-center mt-3 pt-2 border-top border-secondary">
                    <div class="fs-5 fw-bold text-info">₹ {{ number_format($car->total_price) }}</div>
                    <a href="{{ route('car.show', $car->id) }}" class="btn btn-sm btn-outline-light rounded-pill px-3">Details</a>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center text-muted py-4">
        No cars currently available. Check back soon!
    </div>
    @endforelse
</div>
@endsection
