@extends('customer.layout')

@section('title', $car->company . ' ' . $car->model . ' - Cars Orca')

@section('content')
<div class="row g-4">
    <!-- LEFT: Image Carousel + Info -->
    <div class="col-lg-8">
        <!-- Photo Gallery -->
        <div class="glass-card p-3 mb-4">
            @if($car->images->isNotEmpty())
                <div id="carGallery" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner rounded-3" style="height: 400px; background: rgba(15, 23, 42, 0.5);">
                        @foreach($car->images as $index => $img)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }} h-100">
                                <img src="{{ asset('storage/' . $img->image_path) }}" class="d-block w-100 h-100" style="object-fit: contain;">
                            </div>
                        @endforeach
                    </div>
                    @if($car->images->count() > 1)
                        <button class="carousel-control-prev" type="button" data-bs-target="#carGallery" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carGallery" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        </button>
                    @endif
                </div>
            @else
                <div class="d-flex align-items-center justify-content-center bg-secondary bg-opacity-10 rounded-3 text-muted" style="height: 400px;">
                    <i class="fa-solid fa-car fs-1"></i>
                </div>
            @endif
        </div>

        <!-- Section ①: Basic specs -->
        <div class="glass-card p-4 mb-4">
            <h4 class="fw-bold glow-text mb-3">Vehicle Overview</h4>
            <div class="row g-3">
                <div class="col-6 col-md-3">
                    <span class="text-muted small d-block">Make/Model</span>
                    <strong class="text-white">{{ $car->company }} {{ $car->model }}</strong>
                </div>
                <div class="col-6 col-md-3">
                    <span class="text-muted small d-block">Manufacture Year</span>
                    <strong class="text-white">{{ $car->year_of_manufacture ?: 'N/A' }}</strong>
                </div>
                <div class="col-6 col-md-3">
                    <span class="text-muted small d-block">Registration</span>
                    <strong class="text-white">{{ $car->registration_number ?: 'N/A' }}</strong>
                </div>
                <div class="col-6 col-md-3">
                    <span class="text-muted small d-block">Mileage</span>
                    <strong class="text-white">{{ number_format($car->km_driven) }} km</strong>
                </div>
                <div class="col-6 col-md-3">
                    <span class="text-muted small d-block">Owners</span>
                    <strong class="text-white">{{ $car->owner_count ?: 'N/A' }}</strong>
                </div>
                <div class="col-6 col-md-3">
                    <span class="text-muted small d-block">Fuel Type</span>
                    <strong class="text-white">{{ $car->fuel_type ?: 'N/A' }}</strong>
                </div>
                <div class="col-6 col-md-3">
                    <span class="text-muted small d-block">Transmission</span>
                    <strong class="text-white">{{ $car->transmission ?: 'N/A' }}</strong>
                </div>
                <div class="col-6 col-md-3">
                    <span class="text-muted small d-block">Color</span>
                    <strong class="text-white">{{ $car->color ?: 'N/A' }}</strong>
                </div>
            </div>
            @if($car->description)
                <div class="mt-3 pt-3 border-top border-secondary">
                    <span class="text-muted small d-block mb-1">Description</span>
                    <p class="mb-0 text-white">{{ $car->description }}</p>
                </div>
            @endif
        </div>

        <!-- Section ②: Documents & Conditions -->
        <div class="row g-4 mb-4">
            <!-- Documents -->
            <div class="col-md-6">
                <div class="glass-card p-4 h-100">
                    <h5 class="fw-bold mb-3 text-info"><i class="fa-solid fa-file-invoice me-2"></i>Document Verification</h5>
                    <ul class="list-unstyled mb-0">
                        @if($car->document)
                            <li class="d-flex justify-content-between mb-2 small">
                                <span class="text-muted">RC Book:</span> <strong class="text-white">{{ $car->document->rc_book ?: 'N/A' }}</strong>
                            </li>
                            <li class="d-flex justify-content-between mb-2 small">
                                <span class="text-muted">Insurance:</span> <strong class="text-white">{{ $car->document->insurance ?: 'N/A' }}</strong>
                            </li>
                            <li class="d-flex justify-content-between mb-2 small">
                                <span class="text-muted">Pollution Status:</span> <strong class="text-white">{{ $car->document->pollution_certificate ?: 'N/A' }}</strong>
                            </li>
                            <li class="d-flex justify-content-between mb-2 small">
                                <span class="text-muted">Loan Check:</span> <strong class="text-white">{{ $car->document->loan_status ?: 'N/A' }}</strong>
                            </li>
                            <li class="d-flex justify-content-between mb-3 small">
                                <span class="text-muted">Hypothecation:</span> <strong class="text-white">{{ $car->document->hypothecation ?: 'N/A' }}</strong>
                            </li>
                            <div class="p-2 border border-{{ $car->document->status == 'Verified' ? 'success' : 'warning' }} bg-dark bg-opacity-25 rounded text-center">
                                <i class="fa-solid fa-shield-halved me-1 text-{{ $car->document->status == 'Verified' ? 'success' : 'warning' }}"></i>
                                <span class="fw-bold text-{{ $car->document->status == 'Verified' ? 'success' : 'warning' }}">Overall {{ $car->document->status }}</span>
                            </div>
                        @else
                            <li class="text-center text-muted small py-3">No verification records uploaded.</li>
                        @endif
                    </ul>
                </div>
            </div>

            <!-- Conditions -->
            <div class="col-md-6">
                <div class="glass-card p-4 h-100">
                    <h5 class="fw-bold mb-3 text-primary"><i class="fa-solid fa-clipboard-check me-2"></i>Condition Check</h5>
                    <ul class="list-unstyled mb-0">
                        @if($car->condition)
                            @php
                                $checks = [
                                    'engine_condition' => 'Engine',
                                    'transmission_condition' => 'Transmission',
                                    'body_condition' => 'Bodywork',
                                    'paint_condition' => 'Paint Quality',
                                    'interior_condition' => 'Interior',
                                    'electrical_system' => 'Electrical',
                                    'tyre_condition' => 'Tyres',
                                    'ac_condition' => 'Aircon',
                                ];
                            @endphp
                            @foreach($checks as $key => $lbl)
                                @if($car->condition->$key)
                                <li class="d-flex justify-content-between mb-1 small">
                                    <span class="text-muted">{{ $lbl }}:</span> <strong class="text-white">{{ $car->condition->$key }}</strong>
                                </li>
                                @endif
                            @endforeach
                            @if($car->condition->overall_notes)
                                <li class="pt-2 border-top border-secondary mt-2 small text-muted">
                                    <strong>Notes:</strong> {{ $car->condition->overall_notes }}
                                </li>
                            @endif
                        @else
                            <li class="text-center text-muted small py-3">No condition records available.</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- RIGHT: Pricing & Enquiries -->
    <div class="col-lg-4">
        <!-- Pricing Block -->
        <div class="glass-card p-4 mb-4 border border-info border-opacity-25 shadow-lg">
            <span class="text-muted small">Total Cost to Customer</span>
            <h2 class="display-5 fw-bold glow-text mb-1">₹ {{ number_format($car->total_price) }}</h2>
            <p class="small text-muted mb-3">All broker margins integrated natively.</p>
            
            <!-- Wishlist Button -->
            <form action="{{ route('wishlist.add') }}" method="POST">
                @csrf
                <input type="hidden" name="car_id" value="{{ $car->id }}">
                <button type="submit" class="btn btn-outline-danger w-100 rounded-pill">
                    <i class="fa-solid fa-heart me-1"></i> Add to Wishlist
                </button>
            </form>
        </div>

        <!-- Contact Form -->
        <div class="glass-card p-4 mb-4">
            <h5 class="fw-bold mb-3"><i class="fa-solid fa-envelope me-2 text-info"></i>Enquire About This Car</h5>
            <form action="{{ route('car.enquire', $car->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <input type="text" name="name" class="form-control glass-input" required placeholder="Your Name">
                </div>
                <div class="mb-3">
                    <input type="text" name="phone" class="form-control glass-input" required placeholder="Phone Number">
                </div>
                <div class="mb-3">
                    <input type="email" name="email" class="form-control glass-input" placeholder="Email (Optional)">
                </div>
                <div class="mb-3">
                    <textarea name="message" class="form-control glass-input" rows="3" required placeholder="I am interested in this vehicle. Please call back."></textarea>
                </div>
                <button type="submit" class="premium-btn w-100">Send Request</button>
            </form>
        </div>
    </div>
</div>
@endsection
