@extends('customer.layout')

@section('title', 'My Wishlist - Cars Orca')

@section('content')
<div class="glass-card p-4 mb-4">
    <h2 class="fw-bold glow-text mb-1"><i class="fa-solid fa-heart text-danger me-2"></i>My Wishlist</h2>
    <p class="text-muted small">Your saved cars. Track pricing changes and lifecycle states here.</p>
</div>

<div class="row g-4">
    @forelse($wishlistItems as $item)
        @php
            $car = $item->car;
        @endphp
        @if($car)
        <div class="col-md-6 col-lg-4">
            <div class="glass-card h-100 overflow-hidden position-relative">
                <div class="position-relative">
                    @if($car->images->isNotEmpty())
                        <img src="{{ asset('storage/' . $car->images->first()->image_path) }}" class="img-fluid w-100" style="height: 180px; object-fit: cover; {{ $car->status == 'Sold' ? 'filter: grayscale(80%);' : '' }}">
                    @else
                        <div class="d-flex align-items-center justify-content-center bg-secondary bg-opacity-10 text-muted" style="height: 180px;">
                            <i class="fa-solid fa-car fs-1"></i>
                        </div>
                    @endif
                    
                    @if($car->status == 'Sold')
                        <span class="position-absolute top-0 start-0 m-3 badge bg-danger fs-6 px-3 py-2 shadow"><i class="fa-solid fa-circle-check me-1"></i> SOLD</span>
                    @else
                        <span class="position-absolute top-0 start-0 m-3 badge bg-success fs-6 px-3 py-2 shadow">AVAILABLE</span>
                    @endif
                    
                    <!-- Remove Form -->
                    <form action="{{ route('wishlist.remove') }}" method="POST" class="position-absolute top-0 end-0 m-3">
                        @csrf
                        <input type="hidden" name="car_id" value="{{ $car->id }}">
                        <button type="submit" class="btn btn-dark btn-sm rounded-circle shadow-sm" style="width: 35px; height: 35px; display:flex; align-items:center; justify-content:center;" title="Remove">
                            <i class="fa-solid fa-trash text-danger"></i>
                        </button>
                    </form>
                </div>

                <div class="p-3">
                    <h6 class="fw-bold mb-1 text-truncate">{{ $car->company }} {{ $car->model }}</h6>
                    <p class="text-muted small mb-3">{{ $car->fuel_type }} • {{ $car->transmission }}</p>
                    
                    <div class="d-flex justify-content-between align-items-center mt-2 pt-2 border-top border-secondary">
                        <div class="fw-bold text-info fs-5">₹ {{ number_format($car->total_price) }}</div>
                        @if($car->status == 'Available')
                            <a href="{{ route('car.show', $car->id) }}" class="btn btn-sm btn-outline-light rounded-pill px-3">Enquire</a>
                        @else
                            <button class="btn btn-sm btn-secondary rounded-pill px-3" disabled>Not Available</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif
    @empty
        <div class="col-12 text-center text-muted py-5 glass-card">
            <i class="fa-solid fa-heart-crack fs-1 mb-3 text-danger opacity-50"></i>
            <h5>Your wishlist is currently empty.</h5>
            <p class="small">Explore vehicles in the shop and click the heart icon to save.</p>
            <a href="{{ route('shop') }}" class="premium-btn text-decoration-none mt-2 d-inline-block">View Fleet</a>
        </div>
    @endforelse
</div>
@endsection
