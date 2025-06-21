<style>
    .total {
        padding: 0px 5px;
        background: #6C5FFD;
        color: white;
        border-radius: 50%;
        margin: 0 5px;
    }
</style>
<!--APP-SIDEBAR-->
<div class="sticky">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <div class="app-sidebar">
        <div class="side-header">
            <a class="header-brand1" href="/dashboard">
                <img src="{{asset('assets/images/brand/logo.png')}}" class="header-brand-img desktop-logo" alt="logo">
                <img src="{{asset('assets/images/brand/logo-1.png')}}" class="header-brand-img toggle-logo" alt="logo">
                <img src="{{asset('assets/images/brand/logo-2.png')}}" class="header-brand-img light-logo" alt="logo">
                <img src="{{asset('assets/images/brand/logo-3.png')}}" class="header-brand-img light-logo1" alt="logo">
            </a>
            <!-- LOGO -->
        </div>
        <div class="main-sidemenu">
            <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                </svg></div>
            <ul class="side-menu">
                <li class="sub-category">
                    <h3>Main</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="/dashboard">
                        <!-- <i class="side-menu__icon fe fe-home"></i> -->
                        Dashboard

                    </a>
                </li>
                <li class="sub-category">
                    <h3>Pages</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="#"><span class="side-menu__label">Pages</span><i class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu" style="display: none;">
                        <li class="side-menu-label1"><a href="#">page</a></li>
                        <li class="sub-slide is-expanded">
                            <a class="sub-side-menu__item" data-bs-toggle="sub-slide" href="#"><span class="sub-side-menu__label">Home</span><i class="sub-angle fe fe-chevron-right"></i></a>
                            <ul class="sub-slide-menu open" style="display: none;">
                                <li><a href="/sliders?section=home" class="sub-slide-item"> Sliders</a></li>
                                <li><a href="/sliders?section=home_icons" class="sub-slide-item"> Icons</a></li>
                                <li><a href="{{route('home.repair_section')}}" class="sub-slide-item"> Repair Section</a></li>
                                <li><a href="{{route('home.deal_section')}}" class="sub-slide-item"> Deal Section</a></li>
                                
                            </ul>
                        </li>
                        <li class="sub-slide is-expanded">
                            <a class="sub-side-menu__item" data-bs-toggle="sub-slide"><span class="sub-side-menu__label">About</span><i class="sub-angle fe fe-chevron-right"></i></a>
                            <ul class="sub-slide-menu open" style="display: none;">
                                <li><a href="{{route('about_section')}}" class="sub-slide-item"> Content</a></li>
                                <li><a href="/sliders?section=about_contries" class="sub-slide-item"> Countries</a></li>

                            </ul>
                        </li>
                        <li class="sub-slide is-expanded">
                            <a class="sub-side-menu__item" data-bs-toggle="sub-slide"><span class="sub-side-menu__label">Category</span><i class="sub-angle fe fe-chevron-right"></i></a>
                            <ul class="sub-slide-menu open" style="display: none;">
                                <li><a href="/background?section=category" class="sub-slide-item"> Background</a></li>

                            </ul>
                        </li>
                        <li class="sub-slide is-expanded">
                            <a class="sub-side-menu__item" data-bs-toggle="sub-slide"><span class="sub-side-menu__label">Products</span><i class="sub-angle fe fe-chevron-right"></i></a>
                            <ul class="sub-slide-menu open" style="display: none;">
                                <li><a href="/background?section=products" class="sub-slide-item"> Background</a></li>

                            </ul>
                        </li>
                        <li class="sub-slide is-expanded">
                            <a class="sub-side-menu__item" data-bs-toggle="sub-slide"><span class="sub-side-menu__label">Repair</span><i class="sub-angle fe fe-chevron-right"></i></a>
                            <ul class="sub-slide-menu open" style="display: none;">
                                <li><a href="/background?section=repair" class="sub-slide-item"> Background</a></li>

                            </ul>
                        </li>
                        <li class="sub-slide is-expanded">
                            <a class="sub-side-menu__item" data-bs-toggle="sub-slide"><span class="sub-side-menu__label">Contact Us</span><i class="sub-angle fe fe-chevron-right"></i></a>
                            <ul class="sub-slide-menu open" style="display: none;">
                                <li><a href="/background?section=contact" class="sub-slide-item"> Background</a></li>

                            </ul>
                        </li>

                    </ul>
                </li>
                <li class="sub-category">
                    <h3>Settings</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="#"><span class="side-menu__label">Settings</span><i class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu" style="display: none;">
                        <li class="side-menu-label1"><a href="#">page</a></li>
                        <li class="sub-slide is-expanded">
                            <a class="sub-side-menu__item" data-bs-toggle="sub-slide" href="{{route('setting_section')}}"><span class="sub-side-menu__label">Company Information</span></a>
                        </li>
                        <li class="sub-slide is-expanded">
                            <a class="sub-side-menu__item" data-bs-toggle="sub-slide" href="{{route('socials')}}"><span class="sub-side-menu__label">Social Media</span></a>
                        </li>
                        <li class="sub-slide is-expanded">
                            <a class="sub-side-menu__item" data-bs-toggle="sub-slide" href="{{route('advertisement')}}"><span class="sub-side-menu__label">Advertisement</span></a>
                        </li>


                    </ul>
                </li>
                <!-- categories -->
                <li class="sub-category">
                    <h3>Categories</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="#"><span class="side-menu__label">Categories</span><i class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu" style="display: none;">
                        <li class="side-menu-label1"><a href="#">page</a></li>
                        <li class="sub-slide is-expanded">
                            <a class="sub-side-menu__item" data-bs-toggle="sub-slide" href="{{route('categories')}}"><span class="sub-side-menu__label">Categories</span></a>
                        </li>
                        <li class="sub-slide is-expanded">
                            <a class="sub-side-menu__item" data-bs-toggle="sub-slide" href="{{route('subcategory')}}"><span class="sub-side-menu__label">Sub Category</span></a>
                        </li>


                    </ul>
                </li>
                <!-- end categories -->

                <!-- Products -->
                <li class="sub-category">
                    <h3>Products</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="{{route('products')}}">
                        Products
                    </a>
                </li>
                <!-- End Products -->

                <!-- Orders -->
                <li class="sub-category">
                    <h3>Orders</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="{{route('orders')}}">
                        Orders <span class="total">{{$sharedData['total_pending_booking']}}</span>
                    </a>
                </li>
                <!-- End  order -->

                <!-- Orders -->
                <li class="sub-category">
                    <h3>Repairs</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="{{route('repair')}}">
                        Repairs <span class="total">{{$sharedData['total_repairs']}}</span>
                    </a>
                </li>
                <!-- End  order -->

                <!-- Orders -->
                <li class="sub-category">
                    <h3>Messages</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="{{route('messages')}}">
                        Messages <span class="total">{{$sharedData['total_messages']}}</span>
                    </a>
                </li>
                <!-- End  order -->
                <!-- Orders -->
                <li class="sub-category">
                    <h3>Customer surveys</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="{{route('customer_surveys')}}">
                        Customer surveys <span class="total">{{$sharedData['total_customers_services_survey']}}</span>
                    </a>
                </li>
                <!-- End  order -->


            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                </svg></div>
        </div>
    </div>
    <!--/APP-SIDEBAR-->
</div>