@extends('theme.refurbishedphonesinkenya.layouts.main')

@php
    $landingUrl = url('/refurbished-phones-in-kenya');
    $page = max(1, (int) request()->query('page', 1));
    $filterQuery = collect(request()->query())->except(['page'])->filter(function ($value) {
        return $value !== null && $value !== '';
    })->all();
    $hasFilters = !empty($filterQuery);

    $canonicalUrl = $hasFilters ? url()->current() : $landingUrl;
    if (!$hasFilters && $page > 1) {
        $canonicalUrl .= '?page=' . $page;
    }

    $productsTitle = $activeCategory
        ? "{$activeCategory->name} Refurbished Phones in Kenya"
        : 'Refurbished Phones in Kenya | Verified iPhones & Android Devices';
    $productsDescription = $activeCategory
        ? "Shop {$activeCategory->name} refurbished phones in Kenya. Quality tested smartphones with warranty, fair pricing, and fast delivery."
        : 'Find the best refurbished phones in Kenya. Shop tested iPhones and Android phones with warranty, secure payment, and quick nationwide delivery.';
    $productsKeywords = $activeCategory
        ? strtolower($activeCategory->name) . ', refurbished phones in kenya, used smartphones kenya'
        : 'refurbished phones in kenya, affordable smartphones kenya, refurbished iphone kenya, refurbished samsung kenya';
@endphp

@section('title', $productsTitle)
@section('meta_description', $productsDescription)
@section('meta_keywords', $productsKeywords)
@section('og_title', $productsTitle)
@section('og_description', $productsDescription)
@section('twitter_title', $productsTitle)
@section('twitter_description', $productsDescription)
@section('canonical', $canonicalUrl)
@if($hasFilters)
@section('robots', 'noindex, follow')
@endif

@push('meta')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "CollectionPage",
  "name": "{{ addslashes($productsTitle) }}",
  "url": "{{ $canonicalUrl }}",
  "description": "{{ addslashes($productsDescription) }}"
}
</script>
@if($products->count() > 0)
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ItemList",
  "name": "{{ addslashes($productsTitle) }}",
  "itemListElement": [
    @foreach($products as $index => $product)
    {
      "@type": "ListItem",
      "position": {{ $products->firstItem() + $index }},
      "name": "{{ addslashes($product->name) }}",
      "url": "{{ route('product_details', $product->slug) }}"
    }@if(!$loop->last),@endif
    @endforeach
  ]
}
</script>
@endif
@endpush

@section('main')
<style>
    .rpk-shop-hero {
        margin-top: 22px;
        border-radius: 18px;
        border: 1px solid #e2e8f0;
        background: linear-gradient(120deg, #ffffff 0, #f8fafc 58%, #fff7ed 100%);
        padding: 28px;
    }

    .rpk-pill-link {
        display: inline-flex;
        align-items: center;
        border: 1px solid #cbd5e1;
        border-radius: 999px;
        padding: 6px 12px;
        color: #0f172a;
        font-size: .85rem;
        margin: 0 8px 8px 0;
        text-decoration: none;
    }

    .rpk-pill-link.active,
    .rpk-pill-link:hover {
        border-color: #ea580c;
        color: #ea580c;
    }
</style>

<section class="section-padding pb-0">
    <div class="container">
        <div class="rpk-shop-hero">
            <div class="row align-items-center g-3">
                <div class="col-lg-8">
                    <span class="rpk-hero-chip mb-2">
                        <i class="fas fa-mobile-alt"></i> Refurbished Phones in Kenya
                    </span>
                    <h1 class="h2 mb-2 text-dark">{{ $productsTitle }}</h1>
                    <p class="text-muted mb-0">{{ $productsDescription }}</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <div class="small text-muted mb-2">Showing {{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }} of {{ $products->total() }} products</div>
                    <a href="{{ route('product.keyword') }}" class="btn btn-dark rounded-pill">All Refurbished Phones</a>
                </div>
            </div>
        </div>
        <div class="mt-3">
            <a href="{{ route('product.keyword') }}" class="rpk-pill-link {{ !$activeCategory ? 'active' : '' }}">All</a>
            @foreach($categories->take(18) as $category)
                <a href="{{ route('view_product_category', ['slug' => $category->slug]) }}" class="rpk-pill-link {{ $activeCategory && $activeCategory->id === $category->id ? 'active' : '' }}">{{ $category->name }}</a>
            @endforeach
        </div>
    </div>
</section>

<section class="product-tabs section-padding position-relative wow fadeIn animated">
    <div class="container">
        <div class="row product-grid-4">
            @foreach($products as $product)
            <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                <article class="product-cart-wrap mb-30 h-100">
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
                        <h2><a href="{{ route('product_details', $product->slug) }}">{{ \Illuminate\Support\Str::limit($product->name, 48) }}</a></h2>
                        <div class="product-price">
                            @if($product->has_price)
                                <span>{{ price($product) }}</span>
                            @else
                                <span>Request price</span>
                            @endif
                        </div>
                        <div class="product-action-1 show">
                            <a aria-label="View product" class="action-btn hover-up" href="{{ route('product_details', $product->slug) }}"><i class="fi-rs-eye"></i></a>
                        </div>
                    </div>
                </article>
            </div>
            @endforeach
        </div>

        <div class="mt-3 d-flex justify-content-center">
            {{ $products->withQueryString()->links('pagination::bootstrap-4') }}
        </div>
    </div>
</section>

<section class="pb-5">
    <div class="container">
        <div class="rpk-panel p-4">
            <h2 class="h4 mb-2">Why our refurbished phones rank among the best in Kenya</h2>
            <p class="text-muted mb-0">
                We focus on device quality, battery health checks, transparent pricing, and strong after-sales support. This makes us a reliable choice when buying refurbished phones in Kenya for daily use, business, or gifting.
            </p>
        </div>
    </div>
</section>
@endsection
