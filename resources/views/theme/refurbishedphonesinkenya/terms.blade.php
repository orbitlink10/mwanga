
@extends('theme.refurbishedphonesinkenya.layouts.main')
@section('title', 'Terms & Conditions | Refurbished Phones in Kenya')
@section('meta_description', 'Read our terms and conditions for buying refurbished phones in Kenya, including order processing, delivery, and support policies.')
@section('main')

<section class="py-5" id="terms">
    <div class="container">
       {!! get_option('terms') !!}
    </div>
</section>
 @endsection
