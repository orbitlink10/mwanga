@extends('theme.refurbishedphonesinkenya.layouts.main')

@php
    $postTitle = trim((string) ($post->meta_title ?: $post->title));
    $seoTitle = \Illuminate\Support\Str::contains(strtolower($postTitle), 'refurbished phones in kenya')
        ? $postTitle
        : $postTitle . ' | Refurbished Phones in Kenya';
    $postDescriptionSource = trim(strip_tags((string) ($post->meta_description ?: $post->description ?: $post->content)));
    $postDescriptionBase = $postDescriptionSource !== '' ? $postDescriptionSource : $postTitle;
    $postDescriptionText = \Illuminate\Support\Str::contains(strtolower($postDescriptionBase), 'refurbished phones in kenya')
        ? $postDescriptionBase
        : $postDescriptionBase . ' Find trusted refurbished phones in Kenya with warranty and fast delivery.';
    $postDescription = \Illuminate\Support\Str::limit($postDescriptionText, 160, '');
    $postImage = $post->photo ? asset('storage/' . ltrim($post->photo, '/')) : null;
    $postKeywords = implode(', ', array_filter([$post->title, 'refurbished phones in kenya', 'phone buying guides kenya']));
@endphp

@section('title', $seoTitle)
@section('meta_description', $postDescription)
@section('meta_keywords', $postKeywords)
@section('og_title', $seoTitle)
@section('og_description', $postDescription)
@section('og_type', 'article')
@section('twitter_title', $seoTitle)
@section('twitter_description', $postDescription)
@if($postImage)
@section('og_image', $postImage)
@section('twitter_image', $postImage)
@endif

@section('main')

@push('styles')
<style>
    .uniform-height {
        height: 350px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .product-content-wrap {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .media-card2 {
        overflow: hidden;
        border-radius: 10px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .media-card2 img {
        transition: transform 0.3s ease;
    }

    .media-card2:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
    }

    .media-card2:hover img {
        transform: scale(1.1);
    }
</style>
@endpush

<section id="header" class="py-5" style="background-color: #f9fafc;">
    <div class="container py-5">
        <div class="row align-items-center min-vh-75 min-vh-xl-100">
            <!-- Header Content -->
            <div class="col-md-6 text-md-start text-center mb-4 mb-md-0">
                <h1 class="display-4 fw-bold text-dark mb-3">{{ $post->title }}</h1>
                <p class="lead text-secondary">{{ $post->meta_description }}</p>
                <div class="pt-4">
                    <a class="btn btn-lg btn-dark rounded-pill me-3 px-4 py-2 shadow" href="{{ route('product.keyword') }}">Shop Refurbished Phones</a>
                    <a class="btn btn-lg btn-dark rounded-pill me-3 px-4 py-2 shadow" href="{{ route('contacts') }}">Talk to an Expert</a>
                </div>
            </div>

            <!-- Header Image -->
            <div class="col-md-6 text-center">
                <img class="img-fluid rounded shadow-lg"
                     src="{{ $post->photo ? asset('storage/' . $post->photo) : asset('assets/img/default-placeholder.jpg') }}"
                     alt="{{ $post->title }} image" style="max-width: 90%; border-radius: 20px;">
            </div>
        </div>
    </div>
</section>

@if($medias && $medias->count() > 0)
<section class="bg-light py-5" id="medias">
    <div class="container">
        <div id="mediaCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-inner">
                @foreach($medias->chunk(4) as $key => $mediaChunk)
                    <div class="carousel-item @if($key == 0) active @endif">
                        <div class="row justify-content-center">
                            @foreach($mediaChunk as $media)
                                <div class="col-md-3 col-sm-6 mb-4">
                                    <a href="{{ asset($media->file_path) }}" class="media-card2 position-relative" data-lg-size="1600-1200">
                                        <img src="{{ asset($media->file_path) }}" alt="Media Image" class="img-fluid rounded shadow-sm" style="object-fit: cover; height: 200px; width: 100%;">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#mediaCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#mediaCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>
@endif

<section class="py-5" id="homepage-description">
    <div class="container">
        {!! $post->description !!}
    </div>
</section>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/lightgallery/lightgallery.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        lightGallery(document.getElementById('mediaCarousel'), {
            selector: '.media-card2',
            download: false,
            mode: 'lg-slide',
            speed: 600,
        });
    });
</script>
@endpush

@endsection
