@extends('theme.refurbishedphonesinkenya.layouts.main')

@php
    $faqFallback = 'Find answers about phone condition, warranty, payment, and delivery for refurbished phones in Kenya.';
    $faqText = trim(strip_tags((string) get_option('faq')));
@endphp

@section('title', 'FAQs | Refurbished Phones in Kenya')
@section('meta_description', \Illuminate\Support\Str::limit($faqText !== '' && $faqText !== 'faq' ? $faqText : $faqFallback, 160, ''))
@section('meta_keywords', 'refurbished phones in kenya faqs, warranty questions kenya, smartphone delivery kenya')

@section('main')
<section class="section-padding">
    <div class="container">
        <div class="rpk-panel p-4 p-md-5 mb-4">
            <h1 class="h3 mb-2">Frequently Asked Questions</h1>
            <p class="text-muted mb-0">Everything you need to know before buying refurbished phones in Kenya.</p>
        </div>

        <div class="rpk-panel p-4">
            {!! get_option('faq') !!}
        </div>
    </div>
</section>
@endsection
