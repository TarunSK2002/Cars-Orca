@extends('customer.layout')

@section('title', 'Sell Your Car - Cars Orca')

@section('content')
<div class="row g-4 justify-content-center">
    <div class="col-lg-8">
        <div class="glass-card p-5">
            <h2 class="display-6 fw-bold glow-text mb-2">Want to Sell Your Vehicle?</h2>
            <p class="text-muted mb-4">Provide basic specifications, and our team will get back to schedule inspections.</p>
            
            <form action="{{ route('sell.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label text-muted small">Your Name</label>
                        <input type="text" name="name" class="form-control glass-input" required placeholder="Full Name">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted small">Phone Number</label>
                        <input type="text" name="phone" class="form-control glass-input" required placeholder="e.g. +91 99999 99999">
                    </div>
                    <div class="col-12">
                        <label class="form-label text-muted small">Email Address (Optional)</label>
                        <input type="email" name="email" class="form-control glass-input" placeholder="email@domain.com">
                    </div>
                    <div class="col-12">
                        <label class="form-label text-muted small">Car Details</label>
                        <textarea name="car_details" class="form-control glass-input" rows="4" required placeholder="e.g. 2018 Honda City VMT, White color, 52,000 KM driven, single owner, no insurance claims."></textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label text-muted small">Additional Message (Optional)</label>
                        <textarea name="message" class="form-control glass-input" rows="2" placeholder="Preferred contact times or alternative details..."></textarea>
                    </div>
                    <div class="col-12 mt-4">
                        <button type="submit" class="premium-btn w-100 py-3 fw-bold">Submit Sell Proposal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
