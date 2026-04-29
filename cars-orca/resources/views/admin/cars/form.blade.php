@extends('admin.layout')

@section('title', isset($car) ? 'Edit Car - Cars Orca' : 'Add New Car - Cars Orca')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2 glow-text fw-bold">{{ isset($car) ? 'Edit Car' : 'Add New Car' }}</h1>
    <a href="{{ route('admin.cars.index') }}" class="btn btn-outline-light">
        <i class="fa-solid fa-arrow-left me-1"></i> Back to Fleet
    </a>
</div>

<form action="{{ isset($car) ? route('admin.cars.update', $car->id) : route('admin.cars.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($car))
        @method('PUT')
    @endif

    <div class="row">
        <!-- LEFT COLUMN: Basic Info & Pricing & Dates -->
        <div class="col-lg-8">
            
            <!-- Section ①: Basic Details -->
            <div class="admin-card p-4 mb-4">
                <h5 class="mb-4 text-primary"><i class="fa-solid fa-circle-info me-2"></i> ① Car Basic Details</h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label text-muted">Company (Make)</label>
                        <input type="text" name="company" class="form-control bg-dark text-white border-secondary" value="{{ old('company', $car->company ?? '') }}" required placeholder="e.g. Maruti, Toyota">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted">Model</label>
                        <input type="text" name="model" class="form-control bg-dark text-white border-secondary" value="{{ old('model', $car->model ?? '') }}" required placeholder="e.g. Swift, Fortuner">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted">Year of Manufacture</label>
                        <input type="text" name="year_of_manufacture" class="form-control bg-dark text-white border-secondary" value="{{ old('year_of_manufacture', $car->year_of_manufacture ?? '') }}" placeholder="e.g. 2019">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted">Year of Purchase</label>
                        <input type="text" name="year_of_purchase" class="form-control bg-dark text-white border-secondary" value="{{ old('year_of_purchase', $car->year_of_purchase ?? '') }}" placeholder="e.g. 2020">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted">Registration Number</label>
                        <input type="text" name="registration_number" class="form-control bg-dark text-white border-secondary" value="{{ old('registration_number', $car->registration_number ?? '') }}" placeholder="e.g. TN 01 AB 1234">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted">Owner Count</label>
                        <select name="owner_count" class="form-select bg-dark text-white border-secondary">
                            <option value="1st" {{ old('owner_count', $car->owner_count ?? '') == '1st' ? 'selected' : '' }}>1st Owner</option>
                            <option value="2nd" {{ old('owner_count', $car->owner_count ?? '') == '2nd' ? 'selected' : '' }}>2nd Owner</option>
                            <option value="3rd" {{ old('owner_count', $car->owner_count ?? '') == '3rd' ? 'selected' : '' }}>3rd Owner</option>
                            <option value="4th+" {{ old('owner_count', $car->owner_count ?? '') == '4th+' ? 'selected' : '' }}>4th+ Owner</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted">KM Driven</label>
                        <input type="number" name="km_driven" class="form-control bg-dark text-white border-secondary" value="{{ old('km_driven', $car->km_driven ?? '') }}" placeholder="e.g. 45000">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted">Fuel Type</label>
                        <select name="fuel_type" class="form-select bg-dark text-white border-secondary">
                            <option value="Petrol" {{ old('fuel_type', $car->fuel_type ?? '') == 'Petrol' ? 'selected' : '' }}>Petrol</option>
                            <option value="Diesel" {{ old('fuel_type', $car->fuel_type ?? '') == 'Diesel' ? 'selected' : '' }}>Diesel</option>
                            <option value="CNG" {{ old('fuel_type', $car->fuel_type ?? '') == 'CNG' ? 'selected' : '' }}>CNG</option>
                            <option value="Electric" {{ old('fuel_type', $car->fuel_type ?? '') == 'Electric' ? 'selected' : '' }}>Electric</option>
                            <option value="Hybrid" {{ old('fuel_type', $car->fuel_type ?? '') == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted">Transmission</label>
                        <select name="transmission" class="form-select bg-dark text-white border-secondary">
                            <option value="Manual" {{ old('transmission', $car->transmission ?? '') == 'Manual' ? 'selected' : '' }}>Manual</option>
                            <option value="Automatic" {{ old('transmission', $car->transmission ?? '') == 'Automatic' ? 'selected' : '' }}>Automatic</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted">Color</label>
                        <input type="text" name="color" class="form-control bg-dark text-white border-secondary" value="{{ old('color', $car->color ?? '') }}" placeholder="e.g. White, Black">
                    </div>
                    <div class="col-12">
                        <label class="form-label text-muted">Description</label>
                        <textarea name="description" class="form-control bg-dark text-white border-secondary" rows="3" placeholder="Additional details about the car...">{{ old('description', $car->description ?? '') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Section ②: Pricing -->
            <div class="admin-card p-4 mb-4">
                <h5 class="mb-4 text-primary"><i class="fa-solid fa-indian-rupee-sign me-2"></i> ② Pricing</h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label text-muted">Car Price (₹)</label>
                        <input type="number" id="car_price" name="car_price" class="form-control bg-dark text-white border-secondary" value="{{ old('car_price', $car->car_price ?? '0') }}" required oninput="calculateTotal()">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted">Broker Amount (₹)</label>
                        <input type="number" id="broker_amount" name="broker_amount" class="form-control bg-dark text-white border-secondary" value="{{ old('broker_amount', $car->broker_amount ?? '0') }}" required oninput="calculateTotal()">
                    </div>
                    <div class="col-12">
                        <div class="p-3 bg-secondary bg-opacity-10 border border-secondary rounded d-flex justify-content-between align-items-center">
                            <span class="fw-bold">Total Customer Price:</span>
                            <span class="fs-4 fw-bold text-info">₹ <span id="total_price_display">{{ number_format(old('total_price', $car->total_price ?? 0)) }}</span></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section ④: Car Condition Report -->
            <div class="admin-card p-4 mb-4">
                <h5 class="mb-4 text-primary"><i class="fa-solid fa-clipboard-check me-2"></i> ④ Condition Report</h5>
                <div class="row g-3">
                    @php
                        $conditions = [
                            'engine_condition' => 'Engine',
                            'transmission_condition' => 'Transmission',
                            'body_condition' => 'Body',
                            'paint_condition' => 'Paint',
                            'interior_condition' => 'Interior',
                            'electrical_system' => 'Electrical',
                            'tyre_condition' => 'Tyres',
                            'ac_condition' => 'A/C',
                            'brake_system' => 'Brakes',
                            'suspension_condition' => 'Suspension',
                        ];
                    @endphp
                    @foreach($conditions as $key => $label)
                    <div class="col-md-6">
                        <label class="form-label text-muted small mb-1">{{ $label }}</label>
                        <input type="text" name="{{ $key }}" class="form-control bg-dark text-white border-secondary" value="{{ old($key, $car->condition->$key ?? '') }}" placeholder="e.g. Excellent / Needs Service">
                    </div>
                    @endforeach
                    <div class="col-12">
                        <label class="form-label text-muted small">Overall Notes</label>
                        <textarea name="overall_notes" class="form-control bg-dark text-white border-secondary" rows="2">{{ old('overall_notes', $car->condition->overall_notes ?? '') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT COLUMN: Images, Documents, Dates -->
        <div class="col-lg-4">
            
            <!-- Section ③: Photos -->
            <div class="admin-card p-4 mb-4">
                <h5 class="mb-4 text-primary"><i class="fa-solid fa-images me-2"></i> ③ Car Photos</h5>
                <div class="mb-3" id="file_upload_wrapper">
                    <label class="form-label text-muted">Upload Photos (Add more by clicking again)</label>
                    <div id="active_file_input_container">
                        <input type="file" name="images[]" class="form-control bg-dark text-white border-secondary file-upload-input" multiple accept="image/*">
                    </div>
                    <div id="image_preview_container" class="row g-2 mt-2"></div>
                </div>

                @if(isset($car) && $car->images->isNotEmpty())
                <label class="form-label text-muted mt-2">Manage Uploaded Images</label>
                <div class="row g-2">
                    @foreach($car->images as $img)
                    <div class="col-4 col-md-2 position-relative">
                        <img src="{{ asset('storage/' . $img->image_path) }}" class="rounded img-fluid w-100" style="height: 80px; object-fit: cover;">
                        <div class="position-absolute top-0 end-0 m-1">
                            <label class="btn btn-sm btn-danger p-1 rounded-circle d-flex align-items-center justify-content-center" style="width: 24px; height: 24px; cursor: pointer;" title="Delete image">
                                <input type="checkbox" name="delete_images[]" value="{{ $img->id }}" class="d-none" onchange="this.parentElement.classList.toggle('btn-secondary', this.checked); this.parentElement.classList.toggle('btn-danger', !this.checked);">
                                <i class="fa-solid fa-xmark small"></i>
                            </label>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="form-text text-danger mt-1">Check to delete image upon update.</div>
                @endif
            </div>

            <!-- Section ⑤: Documents -->
            <div class="admin-card p-4 mb-4">
                <h5 class="mb-4 text-primary"><i class="fa-solid fa-file-invoice me-2"></i> ⑤ Documents</h5>
                <div class="row g-3">
                    @php
                        $docs = [
                            'rc_book' => 'RC Book Status',
                            'insurance' => 'Insurance Status',
                            'pollution_certificate' => 'Pollution Cert',
                            'loan_status' => 'Loan Status',
                            'hypothecation' => 'Hypothecation Status'
                        ];
                    @endphp
                    @foreach($docs as $key => $label)
                    <div class="col-12">
                        <label class="form-label text-muted small mb-1">{{ $label }}</label>
                        <input type="text" name="{{ $key }}" class="form-control bg-dark text-white border-secondary" value="{{ old($key, $car->document->$key ?? '') }}" placeholder="e.g. Valid / Expired / None">
                    </div>
                    @endforeach
                    <div class="col-12">
                        <label class="form-label text-muted small">Verification Status</label>
                        <select name="doc_status" class="form-select bg-dark text-white border-secondary">
                            <option value="Pending" {{ old('doc_status', $car->document->status ?? '') == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Verified" {{ old('doc_status', $car->document->status ?? '') == 'Verified' ? 'selected' : '' }}>Verified</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Section ⑥: Status & Dates -->
            <div class="admin-card p-4 mb-4">
                <h5 class="mb-4 text-primary"><i class="fa-solid fa-calendar-days me-2"></i> ⑥ Lifecycle Status</h5>
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label text-muted">Listing Status</label>
                        <select name="status" class="form-select bg-dark text-white border-secondary">
                            <option value="Available" {{ old('status', $car->status ?? '') == 'Available' ? 'selected' : '' }}>Available</option>
                            <option value="Sold" {{ old('status', $car->status ?? '') == 'Sold' ? 'selected' : '' }}>Sold</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label text-muted">Purchase Date (By Dealer)</label>
                        <input type="date" name="purchase_date" class="form-control bg-dark text-white border-secondary" value="{{ old('purchase_date', $car->purchase_date ?? '') }}">
                    </div>
                    <div class="col-12">
                        <label class="form-label text-muted">Sell Date (To Customer)</label>
                        <input type="date" name="sell_date" class="form-control bg-dark text-white border-secondary" value="{{ old('sell_date', $car->sell_date ?? '') }}">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary fw-bold w-100 py-3 mt-2">
                <i class="fa-solid fa-floppy-disk me-1"></i> Save Car Record
            </button>
        </div>
    </div>
</form>

<script>
    function calculateTotal() {
        const price = parseFloat(document.getElementById('car_price').value) || 0;
        const broker = parseFloat(document.getElementById('broker_amount').value) || 0;
        const total = price + broker;
        
        // Format as Indian Currency (approximation)
        document.getElementById('total_price_display').innerText = new Intl.NumberFormat('en-IN').format(total);
    }

    document.getElementById('file_upload_wrapper').addEventListener('change', function(event) {
        if (!event.target.classList.contains('file-upload-input')) return;

        const input = event.target;
        const files = input.files;
        if (files && files.length > 0) {
            const container = document.getElementById('image_preview_container');
            
            Array.from(files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const col = document.createElement('div');
                    col.className = 'col-4 position-relative';
                    
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'rounded img-fluid';
                    img.style.height = '60px';
                    img.style.width = '100%';
                    img.style.objectFit = 'cover';
                    
                    col.appendChild(img);
                    container.appendChild(col);
                }
                reader.readAsDataURL(file);
            });

            // Hide previous input
            input.style.display = 'none';

            // Create new fresh input
            const newInput = document.createElement('input');
            newInput.type = 'file';
            newInput.name = 'images[]';
            newInput.className = 'form-control bg-dark text-white border-secondary file-upload-input mt-2';
            newInput.multiple = true;
            newInput.accept = 'image/*';
            
            document.getElementById('active_file_input_container').appendChild(newInput);
        }
    });
</script>
@endsection
