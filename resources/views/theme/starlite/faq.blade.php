@extends('theme.starlite.layouts.orbit_main')
@php
    $faqContent = trim((string) ($faqHtml ?? '')) !== '' ? $faqHtml : get_option('faq');
@endphp
@section('title', 'FAQs for ' . get_option('site_name'))
@section('meta_description', Str::limit(strip_tags((string) ($faqContent ?: get_option('hero_header_description'))), 155, ''))
@section('main')



<section class="py-5" id="homepage-description">
    <div class="container">
          <h1 class="mb-3">Frequently Asked Questions</h1>
          {!! $faqContent !!}
    </div>
</section>
 @endsection
