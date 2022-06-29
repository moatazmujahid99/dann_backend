<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <a href="{{ url('/') }}">
                <img src="{{ asset('backend/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
            </a>
        </div>
        {{-- omar - check --}}
        {{-- <div>
					<h4 class="logo-text">Dann</h4>
				</div> --}}
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">

        @if (Auth::guard('seller')->check())
            <li>
                <a href="{{ route('seller.dashboard') }}">
                    <div class="parent-icon"><i class='bx bx-store'></i>
                    </div>
                    <div class="menu-title">Home</div>
                </a>
            </li>
        @endif
        @if (Auth::guard('web')->check())
            <li>
                <a href="{{ url('/dashboard') }}">
                    <div class="parent-icon"><i class='bx bx-store'></i>
                    </div>
                    <div class="menu-title">Home</div>
                </a>
            </li>
        @endif





        <li class="menu-label">Manage </li>

        @if (Auth::guard('web')->check())
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-grid-alt'></i>
                    </div>
                    <div class="menu-title">Categories</div>
                </a>
                <ul>
                    <li> <a href="{{ route('all.category') }}"><i class="bx bx-right-arrow-alt"></i>All Categories</a>
                    </li>
                    <li> <a href="{{ route('add.category') }}"><i class="bx bx-right-arrow-alt"></i>Add Category </a>
                    </li>

                </ul>
            </li>


            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class='bx bx-grid-small'></i>
                    </div>
                    <div class="menu-title">Subcategories</div>
                </a>
                <ul>
                    <li> <a href="{{ route('all.subcategory') }}"><i class="bx bx-right-arrow-alt"></i>All
                            Subcategories</a>
                    </li>
                    <li> <a href="{{ route('add.subcategory') }}"><i class="bx bx-right-arrow-alt"></i>Add
                            Subcategory</a>
                    </li>

                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class="bx bx-image"></i>
                    </div>
                    <div class="menu-title"> Image Slider</div>
                </a>
                <ul>
                    <li> <a href="{{ route('all.slider') }}"><i class="bx bx-right-arrow-alt"></i>All Images</a>
                    </li>
                    <li> <a href="{{ route('add.slider') }}"><i class="bx bx-right-arrow-alt"></i>Add Image Slider</a>
                    </li>

                </ul>
            </li>
        @endif


        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-purchase-tag-alt"></i>
                </div>
                <div class="menu-title">Products</div>
            </a>
            <ul>
                <li> <a href="{{ route('all.product') }}"><i class="bx bx-right-arrow-alt"></i>All Products</a>
                </li>
                <li> <a href="{{ route('add.product') }}"><i class="bx bx-right-arrow-alt"></i>Add Product</a>
                </li>

            </ul>
        </li>



        <li>
            <a href="{{ route('contact.message') }}">
                <div class="parent-icon"><i class="bx bx-message"></i>
                </div>
                <div class="menu-title">Contact Messages</div>
            </a>
        </li>


        <li>
            <a href="{{ route('all.review') }}">
                <div class="parent-icon"><i class="bx bx-star"></i>
                </div>
                <div class="menu-title">Product Reviews</div>
            </a>
        </li>






        @if (Auth::guard('web')->check())
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"> <i class="bx bx-info-square"></i>
                    </div>
                    <div class="menu-title">Site Info </div>
                </a>
                <ul>
                    <li> <a href="{{ route('getsite.info') }}"><i class="bx bx-right-arrow-alt"></i>Edit Site
                            Info</a>
                    </li>

                </ul>
            </li>
        @endif

        <li class="menu-label">Customer Orders</li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title">Manage Orders</div>
            </a>

            <ul>
                <li> <a href="{{ route('pending.order') }}"><i class="bx bx-right-arrow-alt"></i>Pending Orders </a>
                </li>
                <li> <a href="{{ route('processing.order') }}"><i class="bx bx-right-arrow-alt"></i>Processing
                        Orders</a>
                </li>
                <li> <a href="{{ route('complete.order') }}"><i class="bx bx-right-arrow-alt"></i>Complete Orders</a>
                </li>


            </ul>
        </li>




    </ul>
    <!--end navigation-->
</div>
