
@extends('theme.starlite.layouts.orbit_main')
@php
    $termsContent = trim((string) ($termsHtml ?? '')) !== '' ? $termsHtml : get_option('terms');
@endphp
@section('title', 'Terms for ' . get_option('site_name'))
@section('meta_description', Str::limit(strip_tags((string) $termsContent), 155, ''))
@section('main')

<section class="py-5" id="terms">
    <div class="container">
       <h1 class="mb-3">Terms and Conditions</h1>
       {!! $termsContent !!}
    </div>
</section>
 @endsection
