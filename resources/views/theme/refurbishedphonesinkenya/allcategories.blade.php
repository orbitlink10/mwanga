@extends('theme.refurbishedphonesinkenya.layouts.main')

@section('title', 'Phone Categories | Refurbished Phones in Kenya')
@section('meta_description', 'Explore categories of refurbished phones in Kenya, including iPhone, Samsung, Xiaomi, and more. Compare models and shop quality-tested devices.')
@section('meta_keywords', 'phone categories kenya, refurbished phones in kenya, iphone refurbished kenya, samsung refurbished kenya')
@section('og_title', 'Phone Categories | Refurbished Phones in Kenya')
@section('og_description', 'Browse all categories of quality-tested refurbished phones in Kenya.')
@section('twitter_title', 'Phone Categories | Refurbished Phones in Kenya')
@section('twitter_description', 'Browse all categories of quality-tested refurbished phones in Kenya.')

@section('main')
<section class="section-padding pb-0">
    <div class="container">
        <div class="rpk-panel p-4">
            <h1 class="h2 mb-2 text-dark">All Categories for Refurbished Phones in Kenya</h1>
            <p class="text-muted mb-0">Choose your preferred brand or device class and discover currently available phones.</p>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div class="row g-3">
            @foreach($categories as $category)
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="{{ route('view_product_category', ['slug' => $category->slug]) }}" class="text-decoration-none">
                        <article class="rpk-category-card h-100">
                            <img src="{{ $category->photo }}" alt="{{ $category->name }} refurbished phones in Kenya">
                            <div class="p-3 text-center">
                                <h2 class="h6 text-dark mb-0">{{ $category->name }}</h2>
                            </div>
                        </article>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
