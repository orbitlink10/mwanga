<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    @php
        $canonicalBase = 'https://refurbishedphonesinkenya.co.ke';
        $requestPath = request()->getPathInfo() ?: '/';
        $requestPath = '/' . ltrim($requestPath, '/');
        if ($requestPath === '/index.php') {
            $requestPath = '/';
        }

        $pageNumber = (int) request()->query('page', 1);
        $canonicalQuery = $pageNumber > 1 ? '?page=' . $pageNumber : '';
        $canonicalUrl = rtrim($canonicalBase, '/') . ($requestPath === '/' ? '' : $requestPath) . $canonicalQuery;

        $rawSiteName = trim((string) get_option('site_name'));
        $siteName = ($rawSiteName === '' || $rawSiteName === 'site_name') ? 'Refurbished Phones Kenya' : $rawSiteName;

        $rawDescription = trim(strip_tags((string) get_option('hero_header_description')));
        $defaultDescription = ($rawDescription === '' || $rawDescription === 'hero_header_description')
            ? 'Buy certified refurbished phones in Kenya with warranty, quality checks, secure checkout, and countrywide delivery.'
            : \Illuminate\Support\Str::limit($rawDescription, 160, '');

        $rawKeywords = trim(strip_tags((string) get_option('meta_keywords')));
        $defaultKeywords = ($rawKeywords === '' || $rawKeywords === 'meta_keywords')
            ? 'refurbished phones in kenya, smartphones kenya, used iphones kenya, affordable phones kenya'
            : $rawKeywords;

        $rawHeroImage = trim((string) get_option('hero_image'));
        if ($rawHeroImage === '' || $rawHeroImage === 'hero_image') {
            $rawHeroImage = trim((string) get_option('logo'));
        }
        $defaultImage = asset('default-favicon.png');
        if ($rawHeroImage !== '' && !in_array($rawHeroImage, ['hero_image', 'logo'], true)) {
            $defaultImage = \Illuminate\Support\Str::startsWith($rawHeroImage, ['http://', 'https://'])
                ? $rawHeroImage
                : asset(ltrim($rawHeroImage, '/'));
        }

        $isSearchResults = request()->is('shop') && request()->filled('q');
        $isPrivatePath = request()->is('cart') || request()->is('cart/*')
            || request()->is('checkout') || request()->is('checkout/*')
            || request()->is('account') || request()->is('account/*')
            || request()->is('login') || request()->is('register')
            || request()->is('password') || request()->is('password/*')
            || request()->is('wishlist') || request()->is('wishlist/*');
        $robotsDirective = ($isSearchResults || $isPrivatePath)
            ? 'noindex, follow'
            : 'index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1';

        $metaTitle = trim(strip_tags($__env->yieldContent('title', $siteName)));
        if ($metaTitle === '') {
            $metaTitle = $siteName;
        }
        $metaDescription = trim(strip_tags($__env->yieldContent('meta_description', $defaultDescription)));
        if ($metaDescription === '') {
            $metaDescription = $defaultDescription;
        }
        $metaKeywords = trim(strip_tags($__env->yieldContent('meta_keywords', $defaultKeywords)));
        if ($metaKeywords === '') {
            $metaKeywords = $defaultKeywords;
        }

        $ogTitle = trim(strip_tags($__env->yieldContent('og_title', $metaTitle)));
        $ogDescription = trim(strip_tags($__env->yieldContent('og_description', $metaDescription)));
        $ogImage = trim((string) $__env->yieldContent('og_image', $defaultImage));
        if ($ogImage === '') {
            $ogImage = $defaultImage;
        }
        $ogType = trim((string) $__env->yieldContent('og_type', 'website'));

        $twitterTitle = trim(strip_tags($__env->yieldContent('twitter_title', $ogTitle)));
        $twitterDescription = trim(strip_tags($__env->yieldContent('twitter_description', $ogDescription)));
        $twitterImage = trim((string) $__env->yieldContent('twitter_image', $ogImage));
        if ($twitterImage === '') {
            $twitterImage = $ogImage;
        }

        $rawLogo = trim((string) get_option('logo'));
        $logoUrl = $defaultImage;
        if ($rawLogo !== '' && $rawLogo !== 'logo') {
            $logoUrl = \Illuminate\Support\Str::startsWith($rawLogo, ['http://', 'https://'])
                ? $rawLogo
                : asset(ltrim($rawLogo, '/'));
        }

        $rawPhone = trim((string) get_option('contact_phone'));
        $contactPhone = ($rawPhone === '' || $rawPhone === 'contact_phone') ? null : $rawPhone;
        $rawAddress = trim((string) get_option('address'));
        $address = ($rawAddress === '' || $rawAddress === 'address') ? null : $rawAddress;

        $sameAs = collect([
            trim((string) get_option('facebook')),
            trim((string) get_option('twitter')),
            trim((string) get_option('instagram')),
            trim((string) get_option('linkedin')),
            trim((string) get_option('youtube')),
        ])->filter(fn ($link) => $link !== '' && filter_var($link, FILTER_VALIDATE_URL))->values()->all();

        $organizationSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            '@id' => rtrim($canonicalBase, '/') . '/#organization',
            'name' => $siteName,
            'url' => rtrim($canonicalBase, '/'),
            'logo' => $logoUrl,
            'image' => $ogImage,
            'sameAs' => $sameAs,
        ];
        if ($contactPhone) {
            $organizationSchema['telephone'] = $contactPhone;
        }
        if ($address) {
            $organizationSchema['address'] = [
                '@type' => 'PostalAddress',
                'streetAddress' => $address,
                'addressCountry' => 'KE',
            ];
        }

        $websiteSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            '@id' => rtrim($canonicalBase, '/') . '/#website',
            'url' => rtrim($canonicalBase, '/'),
            'name' => $siteName,
            'inLanguage' => 'en-KE',
            'publisher' => ['@id' => rtrim($canonicalBase, '/') . '/#organization'],
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => rtrim($canonicalBase, '/') . '/shop?q={search_term_string}',
                'query-input' => 'required name=search_term_string',
            ],
        ];
    @endphp

    <title>{{ $metaTitle }}</title>

    <meta name="description" content="{{ $metaDescription }}">
    <meta name="keywords" content="{{ $metaKeywords }}">
    <meta name="robots" content="@yield('robots', $robotsDirective)">
    <meta name="googlebot" content="@yield('robots', $robotsDirective)">
    <meta property="og:title" content="{{ $ogTitle }}" />
    <meta property="og:description" content="{{ $ogDescription }}" />
    <meta property="og:image" content="{{ $ogImage }}" />
    <meta property="og:url" content="@yield('og_url', $canonicalUrl)" />
    <meta property="og:site_name" content="{{ $siteName }}" />
    <meta property="og:type" content="{{ $ogType }}" />
    <meta property="og:locale" content="en_KE" />

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@yield('twitter_site', 'https://refurbishedphonesinkenya.co.ke')" />
    <meta name="twitter:title" content="{{ $twitterTitle }}" />
    <meta name="twitter:description" content="{{ $twitterDescription }}" />
    <meta name="twitter:image" content="{{ $twitterImage }}" />

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ get_option('favicon', asset('default-favicon.png')) }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ get_option('favicon', asset('default-favicon.png')) }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ get_option('favicon', asset('default-favicon.png')) }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ get_option('favicon', asset('default-favicon.png')) }}">
    <link rel="manifest" href="{{ asset('dark/assets/img/favicons/manifest.json') }}">
    <meta name="msapplication-TileImage" content="{{ get_option('favicon', asset('default-favicon.png')) }}">

    <link rel="canonical" href="@yield('canonical', $canonicalUrl)">
    <link rel="alternate" hreflang="en-ke" href="@yield('canonical', $canonicalUrl)">
    <link rel="alternate" hreflang="x-default" href="https://refurbishedphonesinkenya.co.ke/">
    <link rel="sitemap" type="application/xml" title="Sitemap" href="https://refurbishedphonesinkenya.co.ke/sitemap.xml">

    <!-- Preload Critical CSS -->
    <link rel="preload" href="{{ url('/') }}/refurbishedphonesinkenya/assets/css/main.css?v=3.4" as="style">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" as="style">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ url('/') }}/refurbishedphonesinkenya/assets/css/main.css?v=3.4">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('/') }}/refurbishedphonesinkenya/assets/css/style.css">
    <style>
        :root {
            --rpk-primary: #0f172a;
            --rpk-accent: #f97316;
            --rpk-soft: #e2e8f0;
            --rpk-bg: #f8fafc;
        }

        body {
            background: radial-gradient(circle at top right, #f8fafc 0, #eef2ff 45%, #ffffff 100%);
        }

        .rpk-announcement {
            background: linear-gradient(90deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);
            color: #ffffff;
            font-size: 0.92rem;
            letter-spacing: 0.02em;
        }

        .rpk-announcement a {
            color: #fed7aa;
            font-weight: 700;
        }

        .rpk-hero-chip {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 14px;
            border-radius: 999px;
            background: #fff7ed;
            color: #9a3412;
            font-size: 0.82rem;
            font-weight: 700;
            border: 1px solid #fdba74;
        }

        .rpk-panel {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.06);
            border-radius: 18px;
        }

        .rpk-gradient-btn {
            background: linear-gradient(135deg, #ea580c, #c2410c);
            border: 0;
            color: #fff;
            border-radius: 999px;
            padding: 0.75rem 1.35rem;
            font-weight: 700;
        }

        .rpk-gradient-btn:hover {
            color: #fff;
            transform: translateY(-1px);
        }

        .product-cart-wrap {
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 16px 32px rgba(15, 23, 42, 0.05);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .product-cart-wrap:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.12);
        }

        .product-img img {
            border-radius: 12px;
        }

        .rpk-category-card {
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            background: #fff;
            overflow: hidden;
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .rpk-category-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 30px rgba(15, 23, 42, .12);
        }

        .rpk-category-card img {
            height: 170px;
            width: 100%;
            object-fit: cover;
        }

        .product-extra-link2 a.rpk-order-whatsapp-btn,
        .product-extra-link2 a.rpk-order-call-btn {
            width: auto;
            min-width: 220px;
            max-width: 100%;
            height: auto;
            line-height: 1.2;
            padding: 12px 22px;
            margin: 0;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            white-space: nowrap;
            font-weight: 700;
        }

        .product-extra-link2 a.rpk-order-whatsapp-btn {
            background: #25d366;
            border-color: #25d366;
            color: #ffffff;
        }

        .product-extra-link2 a.rpk-order-whatsapp-btn:hover {
            background: #1ebe5a;
            border-color: #1ebe5a;
            color: #ffffff;
        }

        .product-extra-link2 a.rpk-order-call-btn {
            background: #111827;
            border-color: #111827;
            color: #ffffff;
        }

        .product-extra-link2 a.rpk-order-call-btn:hover {
            background: #000000;
            border-color: #000000;
            color: #ffffff;
        }

        @media (max-width: 767px) {
            .rpk-announcement {
                font-size: 0.8rem;
                line-height: 1.4;
            }

            .product-extra-link2 a.rpk-order-whatsapp-btn,
            .product-extra-link2 a.rpk-order-call-btn {
                width: 100%;
                min-width: 0;
            }
        }
    </style>

    <script type="application/ld+json">@json($organizationSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE)</script>
    <script type="application/ld+json">@json($websiteSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE)</script>

    @stack('meta')
    @yield('styles')
</head>


<body>
    <div class="rpk-announcement py-2 text-center">
        Shop verified devices at <a href="{{ route('product.keyword') }}">refurbished phones in kenya</a> with warranty and fast delivery.
    </div>
    <header class="header-area header-style-1 header-height-2">

        <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="header-wrap">
                    <div class="logo logo-width-1">
                        <a href="{{ url('/')}}">
                            <img src="{{ get_option('logo') }}" alt="logo">
                        </a>
                    </div>

                    <?php 

                    $categories = \App\Models\Category::all();
                    ?>
                    <div class="header-right">
                        <div class="search-style-2">
                            <form action="{{ url('shop') }}" method="get">
                                <input type="text" name="q" placeholder="Search refurbished phones in Kenya..." required>
                                <button type="submit">
                                    <i class="fi-rs-search"></i>
                                </button>
                            </form>
                        </div>
                        @php
                        $cart = session()->get('cart', []);
                        $total = 0;
                        foreach ($cart as $item) {
                            $total += $item['price'] * $item['quantity'];
                        }
                        @endphp

                        <div class="container-fluid">
                            <div class="d-flex justify-content-end align-items-center py-3">
                                <!-- Wishlist Icon -->
                                <div class="me-3">
                                    <a href="{{ route('wishlist.index') }}" class="text-dark text-decoration-none d-flex align-items-center">
                                        <img class="svgInject" alt="Evara" src="{{ url('/') }}/refurbishedphonesinkenya/assets/imgs/theme/icons/icon-heart.svg" width="24" height="24">
                                        <span class="badge bg-dark ms-2">0</span>
                                    </a>
                                </div>

                                <!-- Cart Icon -->
                                <div class="me-3">
                                    <a href="{{ route('cart.view') }}" class="text-dark text-decoration-none d-flex align-items-center">
                                        <img alt="Evara" src="{{ url('/') }}/refurbishedphonesinkenya/assets/imgs/theme/icons/icon-cart.svg" width="24" height="24">
                                        <span class="badge bg-dark ms-2">{{ count(Session::get('cart', [])) }}</span>
                                    </a>
                                </div>

                                <!-- Account Button -->
                                <div>
                                    <a href="{{ route('login') }}" class="btn btn-dark d-flex align-items-center px-3 py-2 rounded-pill text-white">
                                        <i class="bi bi-person-circle me-2" style="font-size: 20px;"></i> My Account
                                    </a>
                                </div>
                            </div>
                        </div>





                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom header-bottom-bg-color sticky-bar">
            <div class="container">
                <div class="header-wrap header-space-between position-relative">
                    <div class="logo logo-width-1 d-block d-lg-none">
                        <a href="{{ url('/')}}"><img src="{{ get_option('logo') }}" alt="logo"></a>
                    </div>
                    <div class="header-nav d-none d-lg-flex">

                        <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block">
                            <nav>
                                <ul>


                                    @foreach(\App\Models\Menu::all() as $menu)
                                    <li>
                                        <a href="{{ $menu->url }}">{{ $menu->name }}</a>
                                    </li>
                                    @endforeach




                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="hotline d-none d-lg-block">
                        <p><i class="fi-rs-headset"></i><span>Need Help?</span> {{ get_option('contact_phone') }} </p>
                    </div>

                    <div class="header-action-right d-block d-lg-none">
                        <div class="header-action-2">
                            <div class="header-action-icon-2">
                                <a href="{{ route('wishlist.index')}}">
                                    <img alt="Evara" src="{{ url('/') }}/refurbishedphonesinkenya/assets/imgs/theme/icons/icon-heart.svg">
                                    <span class="pro-count white">0</span>
                                </a>
                            </div>
                            <div class="header-action-icon-2">
                                <a class="mini-cart-icon" href="{{ route('cart.view') }}">
                                    <img alt="Evara" src="{{ url('/') }}/refurbishedphonesinkenya/assets/imgs/theme/icons/icon-cart.svg">
                                    <span class="pro-count white">0</span>
                                </a>
                                <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                    <ul>
                                        <li>
                                            <div class="shopping-cart-img">
                                                <a href="{{ route('product.keyword') }}"><img alt="Refurbished iPhone in Kenya" src="{{ url('/') }}/refurbishedphonesinkenya/assets/imgs/shop/thumbnail-3.jpg"></a>
                                            </div>
                                            <div class="shopping-cart-title">
                                                <h4><a href="{{ route('product.keyword') }}">Refurbished iPhone</a></h4>
                                                <h3><span>1 × </span>$800.00</h3>
                                            </div>
                                            <div class="shopping-cart-delete">
                                                <a href="#"><i class="fi-rs-cross-small"></i></a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="shopping-cart-img">
                                                <a href="{{ route('product.keyword') }}"><img alt="Refurbished Samsung in Kenya" src="{{ url('/') }}/refurbishedphonesinkenya/assets/imgs/shop/thumbnail-4.jpg"></a>
                                            </div>
                                            <div class="shopping-cart-title">
                                                <h4><a href="{{ route('product.keyword') }}">Refurbished Samsung</a></h4>
                                                <h3><span>1 × </span>$3500.00</h3>
                                            </div>
                                            <div class="shopping-cart-delete">
                                                <a href="#"><i class="fi-rs-cross-small"></i></a>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="shopping-cart-footer">
                                        <div class="shopping-cart-total">
                                            <h4>Total <span>$383.00</span></h4>
                                        </div>
                                        <div class="shopping-cart-button">
                                            <a href="{{ route('cart.view') }}">View cart</a>
                                            <a href="{{ route('cart.checkout') }}">Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="header-action-icon-2 d-block d-lg-none">
                                <div class="burger-icon burger-icon-white">
                                    <span class="burger-icon-top"></span>
                                    <span class="burger-icon-mid"></span>
                                    <span class="burger-icon-bottom"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="mobile-header-active mobile-header-wrapper-style">
        <div class="mobile-header-wrapper-inner">
            <div class="mobile-header-top">
                <div class="mobile-header-logo">
                    <a href="{{ url('/') }}"><img src="{{ get_option('logo') }}" alt="logo"></a>
                </div>
                <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                    <button class="close-style search-close">
                        <i class="icon-top"></i>
                        <i class="icon-bottom"></i>
                    </button>
                </div>
            </div>
            <div class="mobile-header-content-area">
                <div class="mobile-search search-style-3 mobile-header-border">
                   <form action="{{ url('shop') }}" method="get">
                    <input type="text" name="q" placeholder="Search refurbished phones in Kenya...">
                    <button type="submit"><i class="fi-rs-search"></i></button>
                </form>
            </div>
            <div class="mobile-menu-wrap mobile-header-border">

                <!-- mobile menu start -->
                <nav>
                    <ul class="mobile-menu">





                        @foreach(\App\Models\Menu::all() as $menu)
                        <li class="menu-item-has-children">
                            <a href="{{ $menu->url }}">{{ $menu->name }}</a>
                        </li>
                        @endforeach

                        
                    </ul>
                </nav>
                <!-- mobile menu end -->
            </div>
            <div class="mobile-header-info-wrap mobile-header-border">
                <div class="single-mobile-header-info mt-30">
                    <a href="{{ route('contacts') }}"> Our location </a>
                </div>
                <div class="single-mobile-header-info">
                    <a href="{{ url('login') }}">Log In / Sign Up </a>
                </div>
                <div class="single-mobile-header-info">
                    <a href="#">{{ get_option('contact_phone') }} </a>
                </div>
            </div>
            <div class="mobile-social-icon">
                <h5 class="mb-15 text-grey-4">Follow Us</h5>
                <a href="{{ get_option('facebook') }}"><img src="{{ url('/') }}/refurbishedphonesinkenya/assets/imgs/theme/icons/icon-facebook.svg" alt="Facebook"></a>
                <a href="{{ get_option('twitter') }}"><img src="{{ url('/') }}/refurbishedphonesinkenya/assets/imgs/theme/icons/icon-twitter.svg" alt="Twitter"></a>
                <a href="{{ get_option('instagram') }}"><img src="{{ url('/') }}/refurbishedphonesinkenya/assets/imgs/theme/icons/icon-instagram.svg" alt="Instagram"></a>
                <a href="{{ get_option('youtube') }}"><img src="{{ url('/') }}/refurbishedphonesinkenya/assets/imgs/theme/icons/icon-youtube.svg" alt="YouTube"></a>
            </div>
        </div>
    </div>
</div>
<main class="main">


   @include('flash_msg')
