@extends('theme.refurbishedphonesinkenya.layouts.main')

@section('title', 'Contact Us | Refurbished Phones in Kenya')
@section('meta_description', 'Contact our team for the best refurbished phones in Kenya. Get help choosing a phone, placing an order, or requesting device recommendations.')
@section('meta_keywords', 'contact refurbished phones in kenya, buy phone kenya support, smartphone shop contacts kenya')

@section('main')
<section class="section-padding">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="rpk-panel p-4 p-md-5 h-100">
                    <h1 class="h3 mb-3">Talk to Our Phone Experts</h1>
                    <p class="text-muted mb-4">
                        Need help finding the right device? We can guide you based on budget, performance, camera needs, and battery requirements.
                    </p>
                    <div class="mb-3">
                        <p class="mb-1 text-muted">Call or WhatsApp</p>
                        <h2 class="h5"><a href="tel:{{ get_option('contact_phone') }}">{{ get_option('contact_phone') }}</a></h2>
                    </div>
                    <div class="mb-3">
                        <p class="mb-1 text-muted">Email</p>
                        <h2 class="h5"><a href="mailto:{{ get_option('contact_email') }}">{{ get_option('contact_email') }}</a></h2>
                    </div>
                    <div>
                        <p class="mb-1 text-muted">Address</p>
                        <p class="mb-0">{{ get_option('address') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="rpk-panel p-4 h-100">
                    <h2 class="h5 mb-3">Our Location</h2>
                    {!! get_option('map') !!}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
