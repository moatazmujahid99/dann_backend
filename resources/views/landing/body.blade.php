<!-- ========================= hero-section start ========================= -->
<section id="home" class="hero-section">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-xxl-5 col-xl-6 col-lg-6 col-md-10">
          <div class="hero-content">
                          <h1>Dann Business Park <span>For Business</span></h1>
                          <p>Egypt's first social commerce platform. A High Technology Enabled E-Commerce Platform for Micro and Small Businesses </p>
{{-- jetstram --}}
                          @if (Route::has('login'))
  <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block ">
      @auth
          <a href="{{ url('/dashboard') }}" class="main-btn btn-hover">Go to the Dashboard</a>
      @else
          <a href="{{ route('login') }}" class="main-btn btn-hover">Log in</a>

          @if (Route::has('register'))
              <a href="{{ route('register') }}" class="main-btn btn-hover ms-3">Register</a>
          @endif
      @endauth
  </div>
@endif
{{-- end jetstream --}}
          </div>
                  </div>
                  <div class="col-xxl-6 col-xl-6 col-lg-6 offset-xxl-1">
                      <div class="hero-image text-center text-lg-start">

                          <img src=" {{ asset('landing/assets/images/hero/hero-image.svg') }}" alt="">
                      </div>
                  </div>
      </div>
          </div>
  </section>
      <!-- ========================= hero-section end ========================= -->

      <!-- ========================= brands-section start ========================= -->
      {{-- <section class="brands-section pt-120">
          <div class="container">
              <div class="row align-items-center">
                  <div class="col-lg-3 col-md-3 col-sm-6">
                      <div class="single-brands">

                          <img src="{{ asset('landing/assets/images/brands/graygrids.svg') }}" alt="">
                      </div>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-6">
                      <div class="single-brands">

                          <img src="{{ asset('landing/assets/images/brands/lineicons.svg') }}" alt="">

                      </div>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-6">
                      <div class="single-brands">

                          <img src="{{ asset('landing/assets/images/brands/uideck.svg') }}" alt="">
                      </div>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-6">
                      <div class="single-brands">

                          <img src=" {{ asset('landing/assets/images/brands/pagebulb.svg') }}" alt="">
                      </div>
                  </div>
              </div>
          </div>
      </section> --}}
      <!-- ========================= brands-section end ========================= -->

      <!-- ========================= feature-section start ========================= -->
      <section id="features" class="feature-section">
          <div class="container">
              <div class="row justify-content-center">
                  <div class="col-xxl-6 col-xl-7 col-lg-8 col-md-11">
                      <div class="section-title text-center mb-60">
                          <h2>Welcome to  <br class="d-block"> your business community</h2><br/>
                      </div>
                  </div>
              </div>

              <div class="row">
                  <div class="col-lg-4 col-md-6">
                      <div class="single-feature">
                          <div class="feature-icon color-1">
                              <i class="lni lni-infinite"></i>
                          </div>
                          <div class="feature-content">
                              <h4>Connect with people in your city</h4>
                              <p>Connect with people nearby, build your business community, find new opportunities and much more! </p>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-4 col-md-6">
                      <div class="single-feature">
                          <div class="feature-icon color-2">
                              <i class="lni lni-map"></i>
                          </div>
                          <div class="feature-content">
                              <h4>Find best products & deals</h4>
                              <p>Explore thousands of products from local sellers near you, get your order in only few minutes</p>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-4 col-md-6">
                      <div class="single-feature">
                          <div class="feature-icon color-3">
                              <i class="lni lni-bolt"></i>
                          </div>
                          <div class="feature-content">
                              <h4>Always be up-to-date</h4>
                              <p>Get instant news and updates from your community, never miss deals and promotions again!</p>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
      <!-- ========================= feature-section end ========================= -->

      <!-- ========================= feature-section-1 start ========================= -->
      <section id="feature-1" class="feature-section-1">
          <div class="shape-image">

              <img src="{{ asset('landing/assets/images/feature/shape.svg') }}" alt="">
          </div>
          <div class="container">
              <div class="row align-items-center">
                  <div class="col-lg-6 order-last order-lg-first">
                      <div class="feature-image text-center text-lg-start">

                          <img src=" {{ asset('landing/assets/images/feature/feature-image-1.svg') }}" alt="">
                      </div>
                  </div>
                  <div class="col-lg-6 col-xxl-5 col-md-10 offset-xxl-1">
                      <div class="feature-content-wrapper">
                          <div class="section-title">
                              <h2 class="mb-20">About Our Creative Platform</h2>
                              <p class="mb-30">Dann Business Park, Egypt's first social commerce platform, that combines all the pros of social media networks along with the power of online marketplaces, A powerful website and mobile app, specially designed for local small and micro businesses.

                                We aim to make online local communities for trade and business in each city of Egypt, to boost our economy, and help people grow their businesses. </p>
                              <a href="https://dann.store" target="_blank" class="main-btn btn-hover border-btn">Visit Dann</a>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
      <!-- ========================= feature-section-1 end ========================= -->

      <!-- ========================= feature-section-2 start ========================= -->
      <section id="feature-2" class="feature-section-2">
          <div class="shape-image">

              <img src="{{ asset('landing/assets/images/feature/shape.svg')}}" alt="">
          </div>
          <div class="container">
              <div class="row align-items-center">
                  <div class="col-lg-6 col-md-10">
                      <div class="feature-content-wrapper">
                          <div class="section-title">
                              <h2 class="mb-30">The most trusted shopping destination in Egypt</h2><br/>

                              <div class="row">
                                  <div class="col-lg-12 col-md-12">
                                      <div class="single-feature">
                                          <div class="feature-icon color-1">
                                              <i class="lni lni-map-marker"></i>
                                          </div>
                                          <div class="feature-content">
                                              <h4>Explore shops, services & more!</h4>
                                              <p>Find and follow nearby shops, service providers and hand-made artists, all gathered in one place, save your time, and shop from home</p>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-lg-12 col-md-12">
                                      <div class="single-feature feature-2">
                                          <div class="feature-icon color-2">
                                              <i class="lni lni-write"></i>
                                          </div>
                                          <div class="feature-content">
                                              <h4>Post your reviews for millions of people to see</h4>
                                              <p>Write about products, sellers, or about any interesting topics, and engage with your business community</p>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-lg-12 col-md-12">
                                      <div class="single-feature feature-3">
                                          <div class="feature-icon color-3">
                                              <i class="lni lni-revenue"></i>
                                          </div>
                                          <div class="feature-content">
                                              <h4>Buy with the Best Prices in Egypt</h4>
                                              <p>Compare prices from all sellers, find the best price, order & enjoy!</p>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-6">
                      <div class="feature-image text-lg-end">
                          <img src="  {{ asset('landing/assets/images/feature/feature-image-2.svg') }}" alt="">
                      </div>
                  </div>
              </div>
          </div>
      </section>
      <!-- ========================= feature-section-2 end ========================= -->
