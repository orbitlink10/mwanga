@extends('theme.refurbishedphonesinkenya.layouts.main')
@php
    $productUrl = route('product_details', $product->slug);
    $rawPhone = preg_replace('/\D+/', '', (string) get_option('contact_phone'));
    if (\Illuminate\Support\Str::startsWith($rawPhone, '0')) {
        $rawPhone = '254' . \Illuminate\Support\Str::substr($rawPhone, 1);
    }
    $waOrderMessage = urlencode(implode("\n", array_filter([
        'Hi, I want to order this phone:',
        $product->name,
        $product->has_price ? 'Price: KES ' . number_format((float) $product->price, 2) : null,
        'Product link: ' . $productUrl,
    ])));
    $waOrderLink = $rawPhone ? "https://wa.me/{$rawPhone}?text={$waOrderMessage}" : null;
@endphp
@section('title', ($product->meta_title ?: $product->name) . ' | Refurbished Phones in Kenya')
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags(($product->meta_description ?: $product->description ?: $product->name) . ' Buy this refurbished phone in Kenya with warranty and fast delivery.'), 160, ''))
@section('meta_keywords', implode(', ', array_filter([$product->name, 'refurbished phones in kenya', 'smartphones kenya'])))

@section('main')
<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ url('/') }}" rel="nofollow">Home</a>
            <span></span>
            <a href="{{ route('view_product_category', ['slug' => App\Models\Category::find($product->category_id)->slug]) }}">
                      {{ App\Models\Category::find($product->category_id)->name }}
            </a>
            <span></span> {{ $product->name }}
        </div>
    </div>
</div>

<section class="mt-50 mb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="product-detail accordion-detail">
                    <div class="row mb-50">
                        <div class="col-md-6">
    <div class="detail-gallery uniform-height-gallery">
        <span class="zoom-icon"><i class="fi-rs-search"></i></span>
        <!-- MAIN SLIDES -->
        <div class="product-image-slider">
            @if($mediafiles->count() > 0)
                @foreach($mediafiles as $media)
                    <figure class="border-radius-10">
                        <img src="{{ $media->file_path }}" alt="{{ $product->name }}">
                    </figure>
                @endforeach
            @else
                <figure class="border-radius-10">
                    <img src="{{ url('/') }}/storage/{{ $product->photo }}" alt="{{ $product->name }}">
                </figure>
            @endif
        </div>
        <!-- THUMBNAILS -->
        <div class="slider-nav-thumbnails pl-15 pr-15">
            @foreach($mediafiles as $media)
                <div><img src="{{ $media->file_path }}" alt="{{ $product->name }}"></div>
            @endforeach
        </div>
    </div>
</div>


                        <div class="col-md-6">
                            <div class="detail-info">
                                <h2 class="title-detail">{{ $product->name }}</h2>
                                <div class="product-detail-rating">
                                    <div class="pro-details-brand">
                                        <span>Category: <a href="{{ route('view_product_category', ['slug' => App\Models\Category::find($product->category_id)->slug]) }}">     {{ App\Models\Category::find($product->category_id)->name }}</a></span>
                                    </div>
                                </div>
                                <div class="clearfix product-price-cover">
                                    <div class="product-price primary-color float-left">
    @if($product->has_price)
                                        <ins><span class="text-brand">KES {{ number_format($product->price, 2) }}</span></ins>
                                        <ins><span class="old-price font-md ml-15">KES {{ number_format($product->price * 1.25, 2) }}</span></ins>
                                        <span class="save-price font-md color3 ml-15">25% Off</span>

                                        @endif
                                    </div>
                                </div>
                                <div class="bt-1 border-color-1 mt-15 mb-15"></div>
                                <div class="short-desc mb-30">
                                    {!! Str::words(strip_tags($product->description), 40, '...') !!}
                                </div>
                                <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                                <div class="detail-extralink">
                                    <div class="product-extra-link2">
                                        @if($product->quantity > 0)
                                            @if($product->has_price)

                                             
                                                <div class="product-extra-link2">
                                                    @if($waOrderLink)
                                                        <a href="{{ $waOrderLink }}" target="_blank" rel="noopener" class="button button-add-to-cart rpk-order-whatsapp-btn">Order via WhatsApp</a>
                                                    @else
                                                        <a href="tel:{{ get_option('contact_phone') }}" class="button button-add-to-cart rpk-order-call-btn">Call to Order</a>
                                                    @endif

                                                     <a aria-label="Add To Wishlist" class="action-btn hover-up"
                                                    href="{{ route('wishlist.store', $product->id)}}"><i class="fi-rs-heart"></i></a>

                                                </div>


                                                                                               
                                               
                                            @else
                                                <button type="button" class="btn btn-dark btn-lg" data-bs-toggle="modal" data-bs-target="#quoteModal">Get Quote</button>
                                            @endif
                                        @else
                                            <button type="button" class="btn btn-dark btn-lg" data-bs-toggle="modal" data-bs-target="#notifyModal">Notify Me</button>
                                        @endif
                                        @include('theme.refurbishedphonesinkenya.modals.notify')
                                        @include('theme.refurbishedphonesinkenya.modals.quote')
                                    </div>
                                </div>
                                <ul class="product-meta font-xs color-grey mt-50">
                                    @if($product->has_price)
                                    <li>Availability:<span class="in-stock text-success ml-5">{{ $product->quantity > 0 ? 'Available in store' : 'Out of stock' }}</span></li>

                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-style3">
                        <ul class="nav nav-tabs text-uppercase">
                            <li class="nav-item">
                                <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description">Description</a>
                            </li>
                        </ul>
                        <div class="tab-content shop_info_tab entry-main-content">
                            <div class="tab-pane fade show active" id="Description">
                                <div>{!! $product->description !!}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('styles')
@endsection

@section('scripts')
@endsection
