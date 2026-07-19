@extends('theme.refurbishedphonesinkenya.layouts.main')
@section('title', 'Phone Rental & Corporate Leasing in Kenya')
@section('meta_description', 'Rent or lease smartphones in Kenya for business teams, events, and short-term projects. Flexible terms with ready-to-use devices.')
@section('meta_keywords', 'phone rental kenya, smartphone leasing kenya, corporate phones kenya')

@section('main')
<section class="section-padding">
    <div class="container">
        <div class="rpk-panel p-4 p-md-5 mb-4">
            <h1 class="h3 mb-2">Phone Rental & Corporate Leasing</h1>
            <p class="text-muted mb-0">Need temporary devices for teams, projects, or events? We provide flexible rental and lease options.</p>
        </div>

        <form action="{{ route('rental.store') }}" method="POST" class="rpk-panel p-4">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="customer_name" class="form-label">Customer Name</label>
                    <input type="text" name="customer_name" id="customer_name" class="form-control" value="{{ old('customer_name') }}" required>
                    @error('customer_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input type="tel" name="phone_number" id="phone_number" class="form-control" value="{{ old('phone_number') }}" required>
                    @error('phone_number')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date') }}" required>
                    @error('start_date')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date') }}" required>
                    @error('end_date')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" name="quantity" id="quantity" class="form-control" min="1" value="{{ old('quantity', 1) }}" required>
                    @error('quantity')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn rpk-gradient-btn">Submit Rental Request</button>
            </div>
        </form>
    </div>
</section>
@endsection
