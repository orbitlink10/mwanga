@extends('theme.refurbishedphonesinkenya.layouts.main')

@php
    $categoryName = trim((string) $category->name);
    $categoryTitle = "{$categoryName} Refurbished Phones in Kenya";
    $categoryDescription = trim(strip_tags((string) $category->meta_description));
    if ($categoryDescription === '') {
        $categoryDescription = "Buy {$categoryName} refurbished phones in Kenya. Verified quality, affordable prices, and quick delivery.";
    }
@endphp

@section('title', $categoryTitle)
@section('meta_description', \Illuminate\Support\Str::limit($categoryDescription, 160, ''))
@section('meta_keywords', strtolower($categoryName) . ', refurbished phones in kenya, refurbished smartphones kenya')
@section('og_title', $categoryTitle)
@section('og_description', \Illuminate\Support\Str::limit($categoryDescription, 160, ''))
@section('twitter_title', $categoryTitle)
@section('twitter_description', \Illuminate\Support\Str::limit($categoryDescription, 160, ''))

@push('meta')
<script type="application/ld+json">
{
  "@context":"https://schema.org",
  "@type":"CollectionPage",
  "name":"{{ addslashes($categoryTitle) }}",
  "description":"{{ addslashes(\Illuminate\Support\Str::limit($categoryDescription, 160, '')) }}",
  "url":"{{ url()->current() }}"
}
</script>
@endpush

@section('main')
<section class="section-padding pb-0">
    <div class="container">
        <div class="rpk-panel p-4">
            <p class="mb-1 text-muted"><a href="{{ route('product.keyword') }}">Refurbished Phones in Kenya</a> / {{ $categoryName }}</p>
            <h1 class="h2 mb-2 text-dark">{{ $categoryTitle }}</h1>
            <p class="text-muted mb-0">{{ $categoryDescription }}</p>
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
                                <img class="default-img" src="{{ url('/') }}/storage/{{ $product->photo }}" alt="{{ $product->name }} {{ $categoryName }} refurbished phone">
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
            {!! $category->description !!}
        </div>
    </div>
</section>
@endsection
