</main>
<footer class="main">
    @php
        $featuredCategories = \App\Models\Category::orderBy('name')->take(6)->get();
        $rawPhone = preg_replace('/\D+/', '', (string) get_option('contact_phone'));
        if (\Illuminate\Support\Str::startsWith($rawPhone, '0')) {
            $rawPhone = '254' . \Illuminate\Support\Str::substr($rawPhone, 1);
        }
        $waMessage = urlencode('Hi, I want to buy a refurbished phone in Kenya. Please share available options.');
        $waLink = $rawPhone ? "https://wa.me/{$rawPhone}?text={$waMessage}" : null;
    @endphp
    <section class="section-padding footer-mid">
        <div class="container pt-15 pb-20">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="widget-about font-md mb-md-5 mb-lg-0">
                        <div class="logo logo-width-1 wow fadeIn animated">
                            <a href="{{ url('/') }}"><img src="{{ get_option('logo') }}" alt="{{ get_option('site_name') }}"></a>
                        </div>
                        <p class="mt-20 wow fadeIn animated text-muted">
                            Buy certified smartphones from the most trusted store for refurbished phones in Kenya. Every device is quality-tested and backed by support.
                        </p>
                        <h5 class="mt-20 mb-10 fw-600 text-grey-4 wow fadeIn animated">Contact</h5>
                        <p class="wow fadeIn animated">
                            <strong>Address: </strong>{{ get_option('address') }}
                        </p>
                        <p class="wow fadeIn animated">
                            <strong>Phone: </strong>{{ get_option('contact_phone') }}
                        </p>
                        <p class="wow fadeIn animated">
                            <strong>Hours: </strong>8:00 - 19:00, Mon - Sat
                        </p>

                        <div class="d-flex flex-wrap gap-2 mt-20">
                            <span class="badge bg-light text-dark border">Warranty Included</span>
                            <span class="badge bg-light text-dark border">Countrywide Delivery</span>
                            <span class="badge bg-light text-dark border">Secure Checkout</span>
                        </div>

                        <h5 class="mb-10 mt-20 fw-600 text-grey-4 wow fadeIn animated">Follow Us</h5>

                        <div class="mobile-social-icon wow fadeIn animated mb-sm-5 mb-md-0">
                            <a href="{{ get_option('facebook') }}"><img src="{{ url('/') }}/refurbishedphonesinkenya/assets/imgs/theme/icons/icon-facebook.svg" alt="Facebook"></a>
                            <a href="{{ get_option('twitter') }}"><img src="{{ url('/') }}/refurbishedphonesinkenya/assets/imgs/theme/icons/icon-twitter.svg" alt="Twitter"></a>
                            <a href="{{ get_option('instagram') }}"><img src="{{ url('/') }}/refurbishedphonesinkenya/assets/imgs/theme/icons/icon-instagram.svg" alt="Instagram"></a>
                        </div>

                    </div>
                </div>
                <div class="col-lg-2 col-md-3">
                    <h5 class="widget-title wow fadeIn animated">Quick Links</h5>
                    <ul class="footer-list wow fadeIn animated mb-sm-5 mb-md-0">
                        <li><a href="{{ route('product.keyword') }}">Refurbished Phones in Kenya</a></li>
                        <li><a href="{{ route('product') }}">Shop All Phones</a></li>
                        <li><a href="{{ route('refurbished.pricing') }}">Price Guide</a></li>
                        <li><a href="{{ route('allcategories') }}">Phone Categories</a></li>
                        <li><a href="{{ route('about_us') }}">About Us</a></li>
                        <li><a href="{{ route('faq') }}">FAQs</a></li>
                        <li><a href="{{ route('contacts') }}">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-3">
                    <h5 class="widget-title wow fadeIn animated">Top Categories</h5>
                    <ul class="footer-list wow fadeIn animated">
                        @forelse($featuredCategories as $category)
                            <li><a href="{{ route('view_product_category', ['slug' => $category->slug]) }}">{{ $category->name }}</a></li>
                        @empty
                            <li><a href="{{ route('allcategories') }}">Browse Categories</a></li>
                        @endforelse
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h5 class="widget-title wow fadeIn animated">Need Help Choosing a Phone?</h5>
                    <p class="wow fadeIn animated text-muted mb-2">
                        Chat with our team for the best refurbished phone deals in Kenya based on your budget and needs.
                    </p>
                    <ul class="footer-list wow fadeIn animated">
                        <li><a href="{{ route('product.keyword') }}">Best-Selling Refurbished Smartphones</a></li>
                        <li><a href="{{ route('product') }}">Affordable iPhones & Samsung Devices</a></li>
                        <li><a href="{{ route('cart.view') }}">View Cart</a></li>
                        <li><a href="{{ route('login') }}">My Account</a></li>
                    </ul>
                    <div class="mt-3">
                        <a href="tel:{{ get_option('contact_phone') }}" class="btn btn-dark btn-sm me-2 mb-2">Call Us</a>
                        @if($waLink)
                            <a href="{{ $waLink }}" target="_blank" rel="noopener" class="btn btn-success btn-sm mb-2">WhatsApp</a>
                        @endif
                    </div>
                    <p class="mb-20 mt-3 wow fadeIn animated">Secured Payment Gateways</p>
                    <img class="wow fadeIn animated" src="{{ url('/') }}/refurbishedphonesinkenya/assets/imgs/theme/payment-method.png" alt="Secure payment methods">
                </div>
            </div>
        </div>
    </section>
    <div class="container pb-20 wow fadeIn animated">
        <div class="row">
            <div class="col-12 mb-20">
                <div class="footer-bottom"></div>
            </div>
            <div class="col-lg-6">
                <p class="float-md-left font-sm text-muted mb-0">&copy; {{ date('Y') }}, <strong class="text-brand">{{ get_option('site_name') }}</strong></p>
            </div>
            <div class="col-lg-6">
                <p class="text-lg-end text-start font-sm text-muted mb-0">
                    Refurbished phones in Kenya, delivered fast and backed by support.
                </p>
            </div>
        </div>
    </div>
</footer>

    <!-- Preloader Start -->
    <!-- <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="text-center">
                    <h5 class="mb-10">Now Loading</h5>
                    <div class="loader">
                        <div class="bar bar1"></div>
                        <div class="bar bar2"></div>
                        <div class="bar bar3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Vendor JS-->
    <script src="{{ url('/') }}/refurbishedphonesinkenya/assets/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="{{ url('/') }}/refurbishedphonesinkenya/assets/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="{{ url('/') }}/refurbishedphonesinkenya/assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>
    <script src="{{ url('/') }}/refurbishedphonesinkenya/assets/js/vendor/bootstrap.bundle.min.js"></script>
    <script src="{{ url('/') }}/refurbishedphonesinkenya/assets/js/plugins/slick.js"></script>
    <script src="{{ url('/') }}/refurbishedphonesinkenya/assets/js/plugins/jquery.syotimer.min.js"></script>
    <script src="{{ url('/') }}/refurbishedphonesinkenya/assets/js/plugins/wow.js"></script>
    <script src="{{ url('/') }}/refurbishedphonesinkenya/assets/js/plugins/jquery-ui.js"></script>
    <script src="{{ url('/') }}/refurbishedphonesinkenya/assets/js/plugins/perfect-scrollbar.js"></script>
    <script src="{{ url('/') }}/refurbishedphonesinkenya/assets/js/plugins/magnific-popup.js"></script>
    <script src="{{ url('/') }}/refurbishedphonesinkenya/assets/js/plugins/select2.min.js"></script>
    <script src="{{ url('/') }}/refurbishedphonesinkenya/assets/js/plugins/waypoints.js"></script>
    <script src="{{ url('/') }}/refurbishedphonesinkenya/assets/js/plugins/counterup.js"></script>
    <script src="{{ url('/') }}/refurbishedphonesinkenya/assets/js/plugins/jquery.countdown.min.js"></script>
    <script src="{{ url('/') }}/refurbishedphonesinkenya/assets/js/plugins/images-loaded.js"></script>
    <script src="{{ url('/') }}/refurbishedphonesinkenya/assets/js/plugins/isotope.js"></script>
    <script src="{{ url('/') }}/refurbishedphonesinkenya/assets/js/plugins/scrollup.js"></script>
    <script src="{{ url('/') }}/refurbishedphonesinkenya/assets/js/plugins/jquery.vticker-min.js"></script>
    <script src="{{ url('/') }}/refurbishedphonesinkenya/assets/js/plugins/jquery.theia.sticky.js"></script>
    <script src="{{ url('/') }}/refurbishedphonesinkenya/assets/js/plugins/jquery.elevatezoom.js"></script>
    <!-- Template  JS -->
    <script src="{{ url('/') }}/refurbishedphonesinkenya/assets/js/main.js?v=3.4"></script>
    <script src="{{ url('/') }}/refurbishedphonesinkenya/assets/js/shop.js?v=3.4"></script>




<nav class="navbar navbar-light bg-light fixed-bottom border-top shadow-sm d-md-none">
  <div class="container-fluid px-3">
    <ul class="navbar-nav nav-justified w-100 d-flex flex-row">
      <!-- Home Link -->
      <li class="nav-item">
        <a class="nav-link text-center" href="{{ url('/') }}">
          <i class="fas fa-home fs-4 d-block"></i>
          <span class="d-block small">Home</span>
        </a>
      </li>
      <!-- Products Link -->
      <li class="nav-item">
        <a class="nav-link text-center" href="{{ route('product.keyword') }}">
          <i class="fas fa-store fs-4 d-block"></i>
          <span class="d-block small">Products</span>
        </a>
      </li>
      <!-- My Account Link -->
      <li class="nav-item">
        <a class="nav-link text-center" href="{{ auth()->check() ? route('account.dashboard') : route('login') }}">
          <i class="fas fa-user-cog fs-4 d-block"></i>
          <span class="d-block small">My Account</span>
        </a>
      </li>
    </ul>
  </div>
</nav>

 <style>
.navbar-light .nav-link {
  color: #6c757d; /* Neutral gray for default state */
  transition: color 0.3s ease-in-out;
}

.navbar-light .nav-link:hover {
  color: #0d6efd; /* Highlight on hover */
}

.navbar-light .nav-link i {
  margin-bottom: 2px; /* Spacing between icon and label */
}

.navbar-light .nav-link.active {
  color: #0d6efd; /* Highlight active link */
  font-weight: bold;
}

.rpk-whatsapp-fab {
  position: fixed;
  right: 16px;
  bottom: 90px;
  z-index: 999;
  width: 54px;
  height: 54px;
  border-radius: 50%;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  background: #25d366;
  color: #fff;
  box-shadow: 0 12px 24px rgba(37, 211, 102, 0.35);
}


</style>
@if($waLink)
<a href="{{ $waLink }}" target="_blank" rel="noopener" class="rpk-whatsapp-fab" aria-label="Chat on WhatsApp">
  <i class="fab fa-whatsapp fa-lg"></i>
</a>
@endif
{!! get_option('chat') !!}
@stack('scripts')




  @include('chat_widget')



</body>

</html>
