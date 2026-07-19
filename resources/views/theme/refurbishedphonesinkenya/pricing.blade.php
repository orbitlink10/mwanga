@extends('theme.refurbishedphonesinkenya.layouts.main')

@section('title', 'Refurbished Phone Prices in Kenya')
@section('meta_description', 'See our refurbished phone price guide in Kenya by device grade and budget range. Find affordable iPhones and Android phones with warranty.')
@section('meta_keywords', 'refurbished phone prices kenya, iphone prices kenya, used smartphone prices kenya, affordable phones kenya')

@section('main')
<section class="section-padding" id="refurbished-pricing">
    <div class="container">
        <div class="rpk-panel p-4 p-md-5 mb-4">
            <h1 class="h3 mb-2">Refurbished Phone Price Guide in Kenya</h1>
            <p class="text-muted mb-0">Pricing depends on model, storage, cosmetic grade, battery health, and accessories included.</p>
        </div>

        <div class="row g-3">
            <div class="col-md-4">
                <div class="rpk-panel p-4 h-100">
                    <h2 class="h5">Entry Budget Range</h2>
                    <p class="text-muted mb-2">Ksh 8,000 - Ksh 20,000</p>
                    <p class="mb-0">Great for everyday use: calls, WhatsApp, social media, and light apps.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="rpk-panel p-4 h-100">
                    <h2 class="h5">Mid-Range Value</h2>
                    <p class="text-muted mb-2">Ksh 20,000 - Ksh 45,000</p>
                    <p class="mb-0">Balanced performance with better camera quality, battery life, and storage.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="rpk-panel p-4 h-100">
                    <h2 class="h5">Premium Refurbished</h2>
                    <p class="text-muted mb-2">Ksh 45,000 and above</p>
                    <p class="mb-0">High-end iPhones and flagship Android phones at better-than-new pricing.</p>
                </div>
            </div>
        </div>

        <div class="rpk-panel p-4 mt-4">
            <h2 class="h5">What affects the final price?</h2>
            <ul class="mb-0">
                <li>Device model and storage capacity</li>
                <li>Physical grade (excellent, very good, good)</li>
                <li>Battery condition and replacement history</li>
                <li>Included accessories and warranty terms</li>
            </ul>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('product.keyword') }}" class="btn rpk-gradient-btn">Browse Current Deals</a>
        </div>
    </div>
</section>
@endsection
