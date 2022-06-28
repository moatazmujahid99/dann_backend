<!DOCTYPE html>
<html class="no-js" lang="">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Dann Business Park</title>
    <meta name="description" content="Dann Business Park" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('landing/assets/images/favicon.png') }}"/>
    <!-- Place favicon.ico in the root directory -->

    <!-- ========================= CSS here ========================= -->
    <link rel="stylesheet" href="{{ asset('landing/assets/css/bootstrap-5.0.0-beta2.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('landing/assets/css/LineIcons.2.0.css') }}"/>
    <link rel="stylesheet" href="{{ asset('landing/assets/css/tiny-slider.css') }}"/>
    <link rel="stylesheet" href="{{ asset('landing/assets/css/animate.css') }}"/>
    <link rel="stylesheet" href="{{ asset('landing/assets/css/main.css') }}"/>

  </head>
  <body>


    <!-- ========================= preloader start ========================= -->
    <div class="preloader">
      <div class="loader">
        <div class="spinner">
          <div class="spinner-container">
            <div class="spinner-rotator">
              <div class="spinner-left">
                <div class="spinner-circle"></div>
              </div>
              <div class="spinner-right">
                <div class="spinner-circle"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
		<!-- preloader end -->


    <!-- ========================= header start ========================= -->




     <header class="header">
      <div class="navbar-area">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-12">
              <nav class="navbar navbar-expand-lg">
                <a class="navbar-brand" href="/">
                  <img src=" {{ asset('landing/assets/images/logo/logo.png ') }}" alt="Logo" />
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="toggler-icon"></span>
                  <span class="toggler-icon"></span>
                  <span class="toggler-icon"></span>
								</button>

                <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
									<div class="ms-auto">
										<ul id="nav" class="navbar-nav ms-auto">
											<li class="nav-item">
												<a class="page-scroll" href="https://dann.store" target="_blank">For individuals</a>
											</li>

											</li>

										</ul>
									</div>
                </div>
								<div class="header-btn">
                                    {{-- jetstram --}}
							@if (Route::has('login'))
                            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block ">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="main-btn btn-hover">Dashboard</a>
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
                <!-- navbar collapse -->
              </nav>
              <!-- navbar -->
            </div>
          </div>
          <!-- row -->
        </div>
        <!-- container -->
      </div>
      <!-- navbar area -->
    </header>
    <!-- ========================= header end ========================= -->
