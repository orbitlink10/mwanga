@extends('theme.refurbishedphonesinkenya.layouts.main')

@section('title', 'About Us | Refurbished Phones in Kenya')
@section('meta_description', 'Learn about our mission to make premium refurbished phones in Kenya affordable and reliable, with strong quality checks and customer support.')
@section('meta_keywords', 'about refurbished phones in kenya, phone quality checks kenya, trusted phone seller kenya')

@section('main')
<section class="section-padding">
    <div class="container">
        <div class="rpk-panel p-4 p-md-5">
            <h1 class="h2 mb-3">About {{ get_option('site_name') }}</h1>
            <p class="text-muted mb-3">
                We are a Kenyan-focused smartphone store helping customers buy quality-tested devices at better prices. Our goal is simple: make premium smartphones accessible through trusted refurbished options.
            </p>
            <p class="text-muted mb-0">
                Every phone goes through condition checks before listing. We prioritize transparency, fair pricing, and after-sales support so you can shop with confidence.
            </p>
        </div>
    </div>
</section>

<section class="pb-5">
    <div class="container">
        <div class="row g-3">
            <div class="col-md-4">
                <div class="rpk-panel p-4 h-100">
                    <h2 class="h5">Quality First</h2>
                    <p class="text-muted mb-0">Functional tests, battery review, and device inspection before delivery.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="rpk-panel p-4 h-100">
                    <h2 class="h5">Fair Pricing</h2>
                    <p class="text-muted mb-0">Competitive rates for refurbished phones in Kenya without compromising reliability.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="rpk-panel p-4 h-100">
                    <h2 class="h5">Customer Support</h2>
                    <p class="text-muted mb-0">Fast response on product selection, orders, and post-purchase assistance.</p>
                </div>
            </div>
        </div>
    </div>
</section>

@if(get_option('about') && get_option('about') !== 'about')
<section class="pb-5">
    <div class="container">
        <div class="rpk-panel p-4">
            {!! get_option('about') !!}
        </div>
    </div>
</section>
@endif
@endsection
