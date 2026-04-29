@extends('customer.layout')

@section('title', 'Contact Us - Cars Orca')

@section('content')
<div class="row g-4 justify-content-center">
    <div class="col-md-6">
        <div class="glass-card p-4 h-100 d-flex flex-column justify-content-center">
            <h2 class="fw-bold glow-text mb-3">Get In Touch</h2>
            <p class="text-muted mb-4">
                Have questions about our listed cars or want to discuss specific requests? Drop us a line.
            </p>
            
            <div class="d-flex align-items-center mb-3">
                <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-circle me-3">
                    <i class="fa-solid fa-phone fs-4"></i>
                </div>
                <div>
                    <h6 class="fw-bold mb-0">Phone Support</h6>
                    <span class="text-muted small">+91 98765 43210</span>
                </div>
            </div>

            <div class="d-flex align-items-center mb-3">
                <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-circle me-3">
                    <i class="fa-solid fa-envelope fs-4"></i>
                </div>
                <div>
                    <h6 class="fw-bold mb-0">Email Queries</h6>
                    <span class="text-muted small">support@carsorca.com</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="glass-card p-4">
            <h4 class="fw-bold mb-4"><i class="fa-solid fa-pen-to-square text-info me-2"></i>Send Message</h4>
            <form action="{{ route('contact.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label text-muted small">Full Name</label>
                    <input type="text" name="name" class="form-control glass-input" required placeholder="John Doe">
                </div>
                <div class="mb-3">
                    <label class="form-label text-muted small">Phone Number</label>
                    <input type="text" name="phone" class="form-control glass-input" required placeholder="+91 1234567890">
                </div>
                <div class="mb-3">
                    <label class="form-label text-muted small">Email Address (Optional)</label>
                    <input type="email" name="email" class="form-control glass-input" placeholder="john@example.com">
                </div>
                <div class="mb-3">
                    <label class="form-label text-muted small">Your Message</label>
                    <textarea name="message" class="form-control glass-input" rows="4" required placeholder="How can we help you today?"></textarea>
                </div>
                <button type="submit" class="premium-btn w-100 mt-2">Submit Enquiry</button>
            </form>
        </div>
    </div>
</div>
@endsection
