@extends('theme.refurbishedphonesinkenya.layouts.main')

@php
    $siteName = get_option('site_name') !== 'site_name' ? get_option('site_name') : 'Refurbished Phones Kenya';
    $homeTitle = 'Refurbished Phones in Kenya | Buy Verified iPhones & Android Devices';
    $homeDescription = 'Shop premium refurbished phones in Kenya at the best prices. Get quality-tested iPhones and Android smartphones with warranty, fast delivery, and secure payment.';
    $homeKeywords = 'refurbished phones in kenya, refurbished iphone kenya, used smartphones kenya, affordable smartphones kenya, buy phones online kenya';

    $heroSlider = $sliders->first();
    $heroImage = $heroSlider?->img_url ?: get_option('hero_image');
    $heroImage = $heroImage && !in_array($heroImage, ['hero_image', 'logo'], true)
        ? (\Illuminate\Support\Str::startsWith($heroImage, ['http://', 'https://']) ? $heroImage : asset(ltrim($heroImage, '/')))
        : asset('default-favicon.png');

    $featuredProducts = $products->take(8);
    $featuredCategories = $categories->take(8);
    $phone = get_option('contact_phone');
@endphp

@section('title', $homeTitle)
@section('meta_description', $homeDescription)
@section('meta_keywords', $homeKeywords)
@section('og_title', $homeTitle)
@section('og_description', $homeDescription)
@section('og_image', $heroImage)
@section('twitter_title', $homeTitle)
@section('twitter_description', $homeDescription)
@section('twitter_image', $heroImage)
@section('canonical', 'https://refurbishedphonesinkenya.co.ke/')

@push('meta')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "name": "{{ $homeTitle }}",
  "url": "https://refurbishedphonesinkenya.co.ke/",
  "description": "{{ $homeDescription }}",
  "primaryImageOfPage": "{{ $heroImage }}"
}
</script>
@if($featuredProducts->count() > 0)
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ItemList",
  "name": "Top Refurbished Phones in Kenya",
  "itemListElement": [
    @foreach($featuredProducts as $index => $product)
    {
      "@type": "ListItem",
      "position": {{ $index + 1 }},
      "url": "{{ route('product_details', $product->slug) }}",
      "name": "{{ addslashes($product->name) }}"
    }@if(!$loop->last),@endif
    @endforeach
  ]
}
</script>
@endif
@endpush

@section('main')
<style>
    .rpk-home-hero {
        padding: 72px 0 56px;
        background: linear-gradient(145deg, #ffffff 0%, #f1f5f9 60%, #fff7ed 100%);
        border-bottom: 1px solid #e2e8f0;
    }

    .rpk-hero-title {
        font-size: clamp(2rem, 4vw, 3.2rem);
        line-height: 1.1;
        font-weight: 800;
        color: #0f172a;
    }

    .rpk-hero-accent {
        color: #c2410c;
    }

    .rpk-hero-copy {
        color: #334155;
        font-size: 1.05rem;
    }

    .rpk-trust-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 14px;
    }

    .rpk-trust-item {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 14px 12px;
        text-align: center;
        font-weight: 600;
        color: #0f172a;
    }

    .rpk-category-card {
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        background: #fff;
        overflow: hidden;
        height: 100%;
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .rpk-category-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 30px rgba(15, 23, 42, .12);
    }

    .rpk-category-card img {
        height: 170px;
        width: 100%;
        object-fit: cover;
    }

    .rpk-section-title {
        font-size: clamp(1.6rem, 3vw, 2.4rem);
        font-weight: 800;
        color: #0f172a;
    }

    .rpk-feature {
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        background: #fff;
        padding: 22px;
        height: 100%;
    }

    @media (max-width: 991px) {
        .rpk-trust-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }
</style>

<section class="rpk-home-hero">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-lg-6">
                <span class="rpk-hero-chip mb-3">
                    <i class="fas fa-check-circle"></i> Trusted Store for Refurbished Phones in Kenya
                </span>
                <h1 class="rpk-hero-title mb-3">
                    Refurbished Phones in Kenya,
                    <span class="rpk-hero-accent">Tested. Affordable. Reliable.</span>
                </h1>
                <p class="rpk-hero-copy mb-4">
                    Buy quality-assured iPhones and Android smartphones with verified condition, warranty support, and nationwide delivery. Get premium phones without paying brand-new prices.
                </p>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('product.keyword') }}" class="btn rpk-gradient-btn">Shop Refurbished Phones</a>
                    <a href="{{ route('contacts') }}" class="btn btn-outline-dark rounded-pill px-4">Talk to an Expert</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="rpk-panel p-3 p-md-4">
                    <img src="{{ $heroImage }}" class="img-fluid rounded-3" alt="Refurbished phones in Kenya display">
                </div>
            </div>
        </div>
        <div class="rpk-trust-grid mt-4">
            <div class="rpk-trust-item"><i class="fas fa-shield-alt me-2 text-warning"></i>Warranty Included</div>
            <div class="rpk-trust-item"><i class="fas fa-vial me-2 text-warning"></i>Quality Tested</div>
            <div class="rpk-trust-item"><i class="fas fa-truck me-2 text-warning"></i>Fast Delivery</div>
            <div class="rpk-trust-item"><i class="fas fa-headset me-2 text-warning"></i>After-Sales Support</div>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-4">
            <h2 class="rpk-section-title mb-0">Browse Phone Categories</h2>
            <a href="{{ route('allcategories') }}" class="btn btn-outline-dark rounded-pill">View All Categories</a>
        </div>
        <div class="row g-3">
            @foreach($featuredCategories as $category)
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="{{ route('view_product_category', ['slug' => $category->slug]) }}" class="text-decoration-none">
                        <article class="rpk-category-card">
                            <img src="{{ $category->photo }}" alt="{{ $category->name }} refurbished phones in Kenya">
                            <div class="p-3 text-center">
                                <h3 class="h6 mb-0 text-dark">{{ $category->name }}</h3>
                            </div>
                        </article>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="section-padding pt-0">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-4">
            <h2 class="rpk-section-title mb-0">Best-Selling Refurbished Phones in Kenya</h2>
            <a href="{{ route('product.keyword') }}" class="btn btn-dark rounded-pill">See All Phones</a>
        </div>
        <div class="row product-grid-4">
            @foreach($featuredProducts as $product)
                <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                    <div class="product-cart-wrap mb-30">
                        <div class="product-img-action-wrap">
                            <div class="product-img product-img-zoom">
                                <a href="{{ route('product_details', $product->slug) }}">
                                    <img class="default-img" src="{{ url('/') }}/storage/{{ $product->photo }}" alt="{{ $product->name }} refurbished phone in Kenya">
                                    <img class="hover-img" src="{{ url('/') }}/storage/{{ $product->photo }}" alt="{{ $product->name }} smartphone">
                                </a>
                            </div>
                        </div>
                        <div class="product-content-wrap">
                            <div class="product-category">
                                <a href="{{ route('view_product_category', ['slug' => category($product->category_id)->slug]) }}">{{ category($product->category_id)->name }}</a>
                            </div>
                            <h3 class="h6"><a href="{{ route('product_details', $product->slug) }}">{{ \Illuminate\Support\Str::limit($product->name, 45) }}</a></h3>
                            <div class="product-price">
                                @if($product->has_price)
                                <span>{{ price($product) }}</span>
                                @endif
                            </div>
                            <div class="product-action-1 show">
                                <a aria-label="View product" class="action-btn hover-up" href="{{ route('product_details', $product->slug) }}"><i class="fi-rs-eye"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="section-padding pt-0">
    <div class="container">
        <div class="row g-3">
            <div class="col-md-4">
                <div class="rpk-feature">
                    <h3 class="h5 mb-2">Why Buy Refurbished?</h3>
                    <p class="text-muted mb-0">You save significantly while still getting reliable performance from premium smartphone models.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="rpk-feature">
                    <h3 class="h5 mb-2">Fully Checked Devices</h3>
                    <p class="text-muted mb-0">Each phone is checked for battery health, screen quality, hardware function, and software stability.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="rpk-feature">
                    <h3 class="h5 mb-2">Support After Purchase</h3>
                    <p class="text-muted mb-0">Need setup help or recommendations? Our team supports you before and after your purchase.</p>
                </div>
            </div>
        </div>
    </div>
</section>

@if($testimonials->count() > 0)
<section class="section-padding pt-0">
    <div class="container">
        <h2 class="rpk-section-title text-center mb-4">What Customers Say</h2>
        <div class="row g-3">
            @foreach($testimonials->take(6) as $testimonial)
                <div class="col-md-4">
                    <article class="rpk-panel p-4 h-100">
                        <p class="mb-3 text-muted">"{{ \Illuminate\Support\Str::limit(strip_tags($testimonial->description), 170) }}"</p>
                        <h3 class="h6 mb-0">{{ $testimonial->name }}</h3>
                    </article>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@if($services->count() > 0)
<section class="section-padding pt-0">
    <div class="container">
        <h2 class="rpk-section-title text-center mb-4">Our Services</h2>
        <div class="row g-3">
            @foreach($services as $service)
                <div class="col-md-4">
                    <article class="rpk-panel p-4 h-100">
                        <h3 class="h5">{{ $service->name }}</h3>
                        <p class="text-muted">{{ \Illuminate\Support\Str::limit(strip_tags($service->meta_description), 140) }}</p>
                        <a href="{{ route('service_single', ['slug' => $service->slug ?? '0']) }}" class="text-decoration-underline">Learn more</a>
                    </article>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<section class="section-padding pt-0">
    <div class="container">
        <div class="rpk-panel p-4 p-md-5">
            <div class="row align-items-center g-3">
                <div class="col-md-8">
                    <h2 class="h3 mb-2">Looking for the best refurbished phones in Kenya?</h2>
                    <p class="text-muted mb-0">Call us on {{ $phone }} or browse our latest stock to find your perfect device today.</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="{{ route('product.keyword') }}" class="btn rpk-gradient-btn">Start Shopping</a>
                </div>
            </div>
        </div>
    </div>
</section>

@if(get_option('homepage_description') && get_option('homepage_description') !== 'homepage_description')
<section class="pb-5">
    <div class="container">
        <div class="rpk-panel p-4">
            {!! get_option('homepage_description') !!}
        </div>
    </div>
</section>
@endif
@endsection
