@extends('theme.starlite.layouts.orbit_main')
@php
    $aboutContent = trim((string) ($aboutHtml ?? '')) !== ''
        ? $aboutHtml
        : get_option('about', 'Welcome to our website. Learn more about our services and company.');
@endphp
@section('title', 'About ' . get_option('site_name'))
@section('meta_description', Str::limit(strip_tags((string) ($aboutContent ?: get_option('hero_header_description'))), 155, ''))

@section('main')

<!-- Homepage Description Section -->
<section class="py-5" id="homepage-description">
    <div class="container">
        <h1 class="mb-3">About {{ get_option('site_name') }}</h1>
        {!! $aboutContent !!}
    </div>
</section>

@endsection
