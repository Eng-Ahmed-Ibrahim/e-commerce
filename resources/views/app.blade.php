<!doctype html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Sash – Bootstrap 5  Admin & Dashboard Template">
    <meta name="author" content="Spruko Technologies Private Limited">
    <meta name="keywords" content="admin,admin dashboard,admin panel,admin template,bootstrap,clean,dashboard,flat,jquery,modern,responsive,premium admin templates,responsive admin,ui,ui kit.">

    <!-- FAVICON -->
    <link rel="shortcut icon" href="{{asset('assets/assets/images/favicon.png')}}" type="image/x-icon">

    <!-- TITLE -->
    <title>@yield('title')</title>

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" />

    <!-- STYLE CSS -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/dark-style.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/transparent-style.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/skin-modes.css')}}" rel="stylesheet" />

    <!--C3 CHARTS CSS -->
    <link href="{{asset('assets/plugins/charts-c3/c3-chart.css')}}" rel="stylesheet" />

    <!-- P-scroll bar css-->
    <link href="{{asset('assets/plugins/p-scroll/perfect-scrollbar.css')}}" rel="stylesheet" />

    <!--- FONT-ICONS CSS -->
    <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet" />

    <!-- INTERNAL Jvectormap css -->
    <link href="{{asset('assets/plugins/jvectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet" />

    <!-- SIDEBAR CSS -->
    <link href="{{asset('assets/plugins/sidebar/sidebar.css')}}" rel="stylesheet">

    <!-- SELECT2 CSS -->
    <link href="{{asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet" />

    <!-- INTERNAL Data table css -->
    <link href="{{asset('assets/plugins/datatable/css/dataTables.bootstrap5.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/datatable/responsive.bootstrap5.css')}}" rel="stylesheet" />

    @yield('css')








<!-- COLOR SKIN CSS -->
<link id="theme" rel="stylesheet" type="text/css" media="all" href="{{asset('assets/colors/color1.css')}}" />


    <style>
        :root{
            /* 95 20 15 */
            --main-bg:#f0f0f5 ;
        }
        body.dark-mode{
            --main-bg:#1a1a3c ;
        }

        body.light-mode .main-border{
            border-left: 7px solid #f0f0f5 !important;
            border-right: 7px solid #f0f0f5 !important;
        }
        body.dark-mode .main-border{
            border-left: 7px solid #1a1a3c !important;
            border-right: 7px solid #1a1a3c !important;
        }
        body.light-mode *{
        }
        body.dark-mode *{
            color: #dedefd !important;
        }

        .bold{
            font-weight: bold;
        }
        .gray{
            color: gray;
        }
        .pointer{
        cursor: pointer;
        }
        
        .dropdown-toggle::after {

        display: none !important;
        }
        .form-label{
            text-align: left;
        }
        .slide a::before {
            content: "";
            font-family: typicons;
            font-style: normal;
            font-weight: normal;
            top: 0px;
            font-size: 10px;
            margin-right: 7px;
            color: rgb(104, 121, 139);
            text-decoration: inherit;
        }
        [aria-label="Pagination Navigation"] > div:first-child {
            display: none;
        }
        [aria-label="Pagination Navigation"] > div:last-child >div:first-child {
            display: none;
        }
        [aria-current="page"] span{
            background-color: #6c5ffc !important;
            color:white;
        }

    </style>
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>
    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="{{asset('assets/colors/color1.css')}}" />

    @if(session('lang') == 'ar')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo&display=swap');
        *{
            font-family: 'Cairo', sans-serif ;
            font-size: 18px;
        }
        .page .page-main .app-sidebar{
            position: fixed;
            top: 0;
            bottom: 0;
            right:0 !important;
            left: inherit !important;

        }
        .app-content {
            margin-right: 270px;
            margin-left: 0;
        }
        .side-header {
            left: inherit;
        }
        .app-header {
                padding-left: 10px;
                z-index: 9 !important;
            }
        @media (min-width: 767px){

            
            .app-header {
                padding-left: 10px;
                padding-right: 285px;
                z-index: 9 !important;
            }
        }
            @media (max-width: 767px)
        {
            .page .page-main .app-sidebar {
                right: -270px !important; 
                left:1 ;
                top: 73px;
            }
        }
        .app-sidebar__toggle{
            position: absolute;
            right: 0;
        }
        .page .page-main .app-sidebar.side-open{
            right: 0 !important;
        }
        .page .page-main .app-sidebar.side-close{
            right: -270px !important;
        }
        @media (min-width: 768px){

            .sidebar-mini.sidenav-toggled .app-content {
                margin-left: 0;
            }
        }
        @media (min-width: 768px){

            .sidebar-mini.sidenav-toggled .app-content {
                margin-right: 80px;
            }
        }
        @media (min-width: 768px){

            .sidebar-mini.sidenav-toggled .app-header.header {
                padding-right: 100px;
            }
        }
        .dropdown-menu{
            left:  0 !important;
        }
        .dropdown-menu-arrow.dropdown-menu-end:before, .dropdown-menu-arrow.dropdown-menu-end:after {
                right: auto !important;
                left: 18px !important;
            }
        table  td,th{
            text-align: center !important;
        }
    </style>
    @endif


</head>

<body class="app sidebar-mini ltr light-mode">

    <!-- GLOBAL-LOADER -->
    <div id="global-loader">
        <img src="{{asset('assets/images/loader.svg')}}" class="loader-img" alt="Loader">
    </div>
    <!-- /GLOBAL-LOADER -->

    <!-- PAGE -->
    <div class="page">
        <div class="page-main">

            <!-- app-Header -->
            @include('layouts.header')

            <!-- /app-Header -->
            @include('layouts.sidebar')

            <!--app-content open-->
            <div class="main-content app-content mt-0">
                <div class="side-app">

                    @yield('content')
                    <!-- CONTAINER END -->
                </div>
            </div>
            <!--app-content close-->

        </div>

        <!-- Sidebar-right -->
        <div class="sidebar sidebar-right sidebar-animate">
            <div class="panel panel-primary card mb-0 shadow-none border-0">
                <div class="tab-menu-heading border-0 d-flex p-3">
                    <div class="card-title mb-0"><i class="fe fe-bell me-2"></i><span class=" pulse"></span>Notifications</div>
                    <div class="card-options ms-auto">
                        <a href="javascript:void(0);" class="sidebar-icon text-end float-end me-3 mb-1" data-bs-toggle="sidebar-right" data-target=".sidebar-right"><i class="fe fe-x text-white"></i></a>
                    </div>
                </div>
                <div class="panel-body tabs-menu-body latest-tasks p-0 border-0">
                    <div class="tabs-menu border-bottom">
                        <!-- Tabs -->
                        <ul class="nav panel-tabs">
                            <li class=""><a href="#side1" class="active" data-bs-toggle="tab"><i class="fe fe-settings me-1"></i>Feeds</a></li>
                            <li><a href="#side2" data-bs-toggle="tab"><i class="fe fe-message-circle"></i> Chat</a></li>
                            <li><a href="#side3" data-bs-toggle="tab"><i class="fe fe-anchor me-1"></i>Timeline</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active" id="side1">
                            <div class="p-3 fw-semibold ps-5">Feeds</div>
                            <div class="card-body pt-2">
                                <div class="browser-stats">
                                    <div class="row mb-4">
                                        <div class="col-sm-2 mb-sm-0 mb-3">
                                            <span class="feeds avatar-circle brround bg-primary-transparent"><i class="fe fe-user text-primary"></i></span>
                                        </div>
                                        <div class="col-sm-10 ps-sm-0">
                                            <div class="d-flex align-items-end justify-content-between ms-2">
                                                <h6 class="">New user registered</h6>
                                                <div>
                                                    <a href="#"><i class="fe fe-settings me-1"></i></a>
                                                    <a href="#"><i class="fe fe-x"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-sm-2 mb-sm-0 mb-3">
                                            <span class="feeds avatar-circle avatar-circle-secondary brround bg-secondary-transparent"><i class="fe fe-shopping-cart text-secondary"></i></span>
                                        </div>
                                        <div class="col-sm-10 ps-sm-0">
                                            <div class="d-flex align-items-end justify-content-between ms-2">
                                                <h6 class="">New order delivered</h6>
                                                <div>
                                                    <a href="#"><i class="fe fe-settings me-1"></i></a>
                                                    <a href="#"><i class="fe fe-x"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-sm-2 mb-sm-0 mb-3">
                                            <span class="feeds avatar-circle avatar-circle-danger brround bg-danger-transparent"><i class="fe fe-bell text-danger"></i></span>
                                        </div>
                                        <div class="col-sm-10 ps-sm-0">
                                            <div class="d-flex align-items-end justify-content-between ms-2">
                                                <h6 class="">You have pending tasks</h6>
                                                <div>
                                                    <a href="#"><i class="fe fe-settings me-1"></i></a>
                                                    <a href="#"><i class="fe fe-x"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-sm-2 mb-sm-0 mb-3">
                                            <span class="feeds avatar-circle avatar-circle-warning brround bg-warning-transparent"><i class="fe fe-gitlab text-warning"></i></span>
                                        </div>
                                        <div class="col-sm-10 ps-sm-0">
                                            <div class="d-flex align-items-end justify-content-between ms-2">
                                                <h6 class="">New version arrived</h6>
                                                <div>
                                                    <a href="#"><i class="fe fe-settings me-1"></i></a>
                                                    <a href="#"><i class="fe fe-x"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-sm-2 mb-sm-0 mb-3">
                                            <span class="feeds avatar-circle avatar-circle-pink brround bg-pink-transparent"><i class="fe fe-database text-pink"></i></span>
                                        </div>
                                        <div class="col-sm-10 ps-sm-0">
                                            <div class="d-flex align-items-end justify-content-between ms-2">
                                                <h6 class="">Server #1 overloaded</h6>
                                                <div>
                                                    <a href="#"><i class="fe fe-settings me-1"></i></a>
                                                    <a href="#"><i class="fe fe-x"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-2 mb-sm-0 mb-3">
                                            <span class="feeds avatar-circle avatar-circle-info brround bg-info-transparent"><i class="fe fe-check-circle text-info"></i></span>
                                        </div>
                                        <div class="col-sm-10 ps-sm-0">
                                            <div class="d-flex align-items-end justify-content-between ms-2">
                                                <h6 class="">New project launched</h6>
                                                <div>
                                                    <a href="#"><i class="fe fe-settings me-1"></i></a>
                                                    <a href="#"><i class="fe fe-x"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="p-3 fw-semibold ps-5">Settings</div>
                            <div class="card-body pt-2">
                                <div class="browser-stats">
                                    <div class="row mb-4">
                                        <div class="col-sm-2 mb-sm-0 mb-3">
                                            <span class="feeds avatar-circle brround bg-primary-transparent"><i class="fe fe-settings text-primary"></i></span>
                                        </div>
                                        <div class="col-sm-10 ps-sm-0">
                                            <div class="d-flex align-items-end justify-content-between ms-2">
                                                <h6 class="">General Settings</h6>
                                                <div>
                                                    <a href="#"><i class="fe fe-settings me-1"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-sm-2 mb-sm-0 mb-3">
                                            <span class="feeds avatar-circle avatar-circle-secondary brround bg-secondary-transparent"><i class="fe fe-map-pin text-secondary"></i></span>
                                        </div>
                                        <div class="col-sm-10 ps-sm-0">
                                            <div class="d-flex align-items-end justify-content-between ms-2">
                                                <h6 class="">Map Settings</h6>
                                                <div>
                                                    <a href="#"><i class="fe fe-settings me-1"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-sm-2 mb-sm-0 mb-3">
                                            <span class="feeds avatar-circle avatar-circle-danger brround bg-danger-transparent"><i class="fe fe-headphones text-danger"></i></span>
                                        </div>
                                        <div class="col-sm-10 ps-sm-0">
                                            <div class="d-flex align-items-end justify-content-between ms-2">
                                                <h6 class="">Support Settings</h6>
                                                <div>
                                                    <a href="#"><i class="fe fe-settings me-1"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-sm-2 mb-sm-0 mb-3">
                                            <span class="feeds avatar-circle avatar-circle-warning brround bg-warning-transparent"><i class="fe fe-credit-card text-warning"></i></span>
                                        </div>
                                        <div class="col-sm-10 ps-sm-0">
                                            <div class="d-flex align-items-end justify-content-between ms-2">
                                                <h6 class="">Payment Settings</h6>
                                                <div>
                                                    <a href="#"><i class="fe fe-settings me-1"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-sm-2 mb-sm-0 mb-3">
                                            <span class="feeds avatar-circle avatar-circle-pink brround bg-pink-transparent"><i class="fe fe-bell text-pink"></i></span>
                                        </div>
                                        <div class="col-sm-10 ps-sm-0">
                                            <div class="d-flex align-items-end justify-content-between ms-2">
                                                <h6 class="">Notification Settings</h6>
                                                <div>
                                                    <a href="#"><i class="fe fe-settings me-1"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="side2">
                            <div class="list-group list-group-flush">
                                <div class="pt-3 fw-semibold ps-5">Today</div>
                                <div class="list-group-item d-flex align-items-center">
                                    <div class="me-2">
                                        <span class="avatar avatar-md brround cover-image" data-bs-image-src="{{asset('assets/images/users/2.jpg')}}"></span>
                                    </div>
                                    <div class="">
                                        <a href="chat.html">
                                            <div class="fw-semibold text-dark" data-bs-toggle="modal" data-target="#chatmodel">Addie Minstra</div>
                                            <p class="mb-0 fs-12 text-muted"> Hey! there I' am available.... </p>
                                        </a>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-center">
                                    <div class="me-2">
                                        <span class="avatar avatar-md brround cover-image" data-bs-image-src="{{asset('assets/images/users/11.jpg')}}"><span class="avatar-status bg-success"></span></span>
                                    </div>
                                    <div class="">
                                        <a href="chat.html">
                                            <div class="fw-semibold text-dark" data-bs-toggle="modal" data-target="#chatmodel">Rose Bush</div>
                                            <p class="mb-0 fs-12 text-muted"> Okay...I will be waiting for you </p>
                                        </a>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-center">
                                    <div class="me-2">
                                        <span class="avatar avatar-md brround cover-image" data-bs-image-src="{{asset('assets/images/users/10.jpg')}}"></span>
                                    </div>
                                    <div class="">
                                        <a href="chat.html">
                                            <div class="fw-semibold text-dark" data-bs-toggle="modal" data-target="#chatmodel">Claude Strophobia</div>
                                            <p class="mb-0 fs-12 text-muted"> Hi we can explain our new project...... </p>
                                        </a>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-center">
                                    <div class="me-2">
                                        <span class="avatar avatar-md brround cover-image" data-bs-image-src="{{asset('assets/images/users/13.jpg')}}"></span>
                                    </div>
                                    <div class="">
                                        <a href="chat.html">
                                            <div class="fw-semibold text-dark" data-bs-toggle="modal" data-target="#chatmodel">Eileen Dover</div>
                                            <p class="mb-0 fs-12 text-muted"> New product Launching... </p>
                                        </a>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-center">
                                    <div class="me-2">
                                        <span class="avatar avatar-md brround cover-image" data-bs-image-src="{{asset('assets/images/users/12.jpg')}}"><span class="avatar-status bg-success"></span></span>
                                    </div>
                                    <div class="">
                                        <a href="chat.html">
                                            <div class="fw-semibold text-dark" data-bs-toggle="modal" data-target="#chatmodel">Willie Findit</div>
                                            <p class="mb-0 fs-12 text-muted"> Okay...I will be waiting for you </p>
                                        </a>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-center">
                                    <div class="me-2">
                                        <span class="avatar avatar-md brround cover-image" data-bs-image-src="{{asset('assets/images/users/15.jpg')}}"></span>
                                    </div>
                                    <div class="">
                                        <a href="chat.html">
                                            <div class="fw-semibold text-dark" data-bs-toggle="modal" data-target="#chatmodel">Manny Jah</div>
                                            <p class="mb-0 fs-12 text-muted"> Hi we can explain our new project...... </p>
                                        </a>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-center">
                                    <div class="me-2">
                                        <span class="avatar avatar-md brround cover-image" data-bs-image-src="{{asset('assets/images/users/4.jpg')}}"></span>
                                    </div>
                                    <div class="">
                                        <a href="chat.html">
                                            <div class="fw-semibold text-dark" data-bs-toggle="modal" data-target="#chatmodel">Cherry Blossom</div>
                                            <p class="mb-0 fs-12 text-muted"> Hey! there I' am available....</p>
                                        </a>
                                    </div>
                                </div>
                                <div class="pt-3 fw-semibold ps-5">Yesterday</div>
                                <div class="list-group-item d-flex align-items-center">
                                    <div class="me-2">
                                        <span class="avatar avatar-md brround cover-image" data-bs-image-src="{{asset('assets/images/users/7.jpg')}}"><span class="avatar-status bg-success"></span></span>
                                    </div>
                                    <div class="">
                                        <a href="chat.html">
                                            <div class="fw-semibold text-dark" data-bs-toggle="modal" data-target="#chatmodel">Simon Sais</div>
                                            <p class="mb-0 fs-12 text-muted">Schedule Realease...... </p>
                                        </a>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-center">
                                    <div class="me-2">
                                        <span class="avatar avatar-md brround cover-image" data-bs-image-src="{{asset('assets/images/users/9.jpg')}}"></span>
                                    </div>
                                    <div class="">
                                        <a href="chat.html">
                                            <div class="fw-semibold text-dark" data-bs-toggle="modal" data-target="#chatmodel">Laura Biding</div>
                                            <p class="mb-0 fs-12 text-muted"> Hi we can explain our new project...... </p>
                                        </a>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-center">
                                    <div class="me-2">
                                        <span class="avatar avatar-md brround cover-image" data-bs-image-src="{{asset('assets/images/users/2.jpg')}}"><span class="avatar-status bg-success"></span></span>
                                    </div>
                                    <div class="">
                                        <a href="chat.html">
                                            <div class="fw-semibold text-dark" data-bs-toggle="modal" data-target="#chatmodel">Addie Minstra</div>
                                            <p class="mb-0 fs-12 text-muted">Contact me for details....</p>
                                        </a>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-center">
                                    <div class="me-2">
                                        <span class="avatar avatar-md brround cover-image" data-bs-image-src="{{asset('assets/images/users/9.jpg')}}"></span>
                                    </div>
                                    <div class="">
                                        <a href="chat.html">
                                            <div class="fw-semibold text-dark" data-bs-toggle="modal" data-target="#chatmodel">Ivan Notheridiya</div>
                                            <p class="mb-0 fs-12 text-muted"> Hi we can explain our new project...... </p>
                                        </a>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-center">
                                    <div class="me-2">
                                        <span class="avatar avatar-md brround cover-image" data-bs-image-src="{{asset('assets/images/users/14.jpg')}}"></span>
                                    </div>
                                    <div class="">
                                        <a href="chat.html">
                                            <div class="fw-semibold text-dark" data-bs-toggle="modal" data-target="#chatmodel">Dulcie Veeta</div>
                                            <p class="mb-0 fs-12 text-muted"> Okay...I will be waiting for you </p>
                                        </a>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-center">
                                    <div class="me-2">
                                        <span class="avatar avatar-md brround cover-image" data-bs-image-src="{{asset('assets/images/users/11.jpg')}}"></span>
                                    </div>
                                    <div class="">
                                        <a href="chat.html">
                                            <div class="fw-semibold text-dark" data-bs-toggle="modal" data-target="#chatmodel">Florinda Carasco</div>
                                            <p class="mb-0 fs-12 text-muted">New product Launching...</p>
                                        </a>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-center">
                                    <div class="me-2">
                                        <span class="avatar avatar-md brround cover-image" data-bs-image-src="{{asset('assets/images/users/4.jpg')}}"><span class="avatar-status bg-success"></span></span>
                                    </div>
                                    <div class="">
                                        <a href="chat.html">
                                            <div class="fw-semibold text-dark" data-bs-toggle="modal" data-target="#chatmodel">Cherry Blossom</div>
                                            <p class="mb-0 fs-12 text-muted">cherryblossom@gmail.com</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="side3">
                            <ul class="task-list timeline-task">
                                <li class="d-sm-flex mt-4">
                                    <div>
                                        <i class="task-icon1"></i>
                                        <h6 class="fw-semibold">Task Finished<span class="text-muted fs-11 ms-2 fw-normal">09 July 2021</span></h6>
                                        <p class="text-muted fs-12">Adam Berry finished task on<a href="#" class="fw-semibold"> Project Management</a></p>
                                    </div>
                                    <div class="ms-auto d-md-flex me-3">
                                        <a href="#" class="text-muted me-2"><span class="fe fe-edit"></span></a>
                                        <a href="#" class="text-muted"><span class="fe fe-trash-2"></span></a>
                                    </div>
                                </li>
                                <li class="d-sm-flex">
                                    <div>
                                        <i class="task-icon1"></i>
                                        <h6 class="fw-semibold">New Comment<span class="text-muted fs-11 ms-2 fw-normal">05 July 2021</span></h6>
                                        <p class="text-muted fs-12">Victoria commented on Project <a href="#" class="fw-semibold"> AngularJS Template</a></p>
                                    </div>
                                    <div class="ms-auto d-md-flex me-3">
                                        <a href="#" class="text-muted me-2"><span class="fe fe-edit"></span></a>
                                        <a href="#" class="text-muted"><span class="fe fe-trash-2"></span></a>
                                    </div>
                                </li>
                                <li class="d-sm-flex">
                                    <div>
                                        <i class="task-icon1"></i>
                                        <h6 class="fw-semibold">New Comment<span class="text-muted fs-11 ms-2 fw-normal">25 June 2021</span></h6>
                                        <p class="text-muted fs-12">Victoria commented on Project <a href="#" class="fw-semibold"> AngularJS Template</a></p>
                                    </div>
                                    <div class="ms-auto d-md-flex me-3">
                                        <a href="#" class="text-muted me-2"><span class="fe fe-edit"></span></a>
                                        <a href="#" class="text-muted"><span class="fe fe-trash-2"></span></a>
                                    </div>
                                </li>
                                <li class="d-sm-flex">
                                    <div>
                                        <i class="task-icon1"></i>
                                        <h6 class="fw-semibold">Task Overdue<span class="text-muted fs-11 ms-2 fw-normal">14 June 2021</span></h6>
                                        <p class="text-muted mb-0 fs-12">Petey Cruiser finished task <a href="#" class="fw-semibold"> Integrated management</a></p>
                                    </div>
                                    <div class="ms-auto d-md-flex me-3">
                                        <a href="#" class="text-muted me-2"><span class="fe fe-edit"></span></a>
                                        <a href="#" class="text-muted"><span class="fe fe-trash-2"></span></a>
                                    </div>
                                </li>
                                <li class="d-sm-flex">
                                    <div>
                                        <i class="task-icon1"></i>
                                        <h6 class="fw-semibold">Task Overdue<span class="text-muted fs-11 ms-2 fw-normal">29 June 2021</span></h6>
                                        <p class="text-muted mb-0 fs-12">Petey Cruiser finished task <a href="#" class="fw-semibold"> Integrated management</a></p>
                                    </div>
                                    <div class="ms-auto d-md-flex me-3">
                                        <a href="#" class="text-muted me-2"><span class="fe fe-edit"></span></a>
                                        <a href="#" class="text-muted"><span class="fe fe-trash-2"></span></a>
                                    </div>
                                </li>
                                <li class="d-sm-flex">
                                    <div>
                                        <i class="task-icon1"></i>
                                        <h6 class="fw-semibold">Task Finished<span class="text-muted fs-11 ms-2 fw-normal">09 July 2021</span></h6>
                                        <p class="text-muted fs-12">Adam Berry finished task on<a href="#" class="fw-semibold"> Project Management</a></p>
                                    </div>
                                    <div class="ms-auto d-md-flex me-3">
                                        <a href="#" class="text-muted me-2"><span class="fe fe-edit"></span></a>
                                        <a href="#" class="text-muted"><span class="fe fe-trash-2"></span></a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/Sidebar-right-->

        <!-- Country-selector modal-->

        <!-- Country-selector modal-->

        <!-- FOOTER -->
        <!-- <footer class="footer">
            <div class="container">
                <div class="row align-items-center flex-row-reverse">
                    <div class="col-md-12 col-sm-12 text-center">
                        Copyright © 2022 <a href="#">Sash</a>. Designed with <span class="fa fa-heart text-danger"></span> by <a href="#"> Spruko </a> All rights reserved.
                    </div>
                </div>
            </div>
        </footer> -->
        <!-- FOOTER END -->

    </div>

    <!-- BACK-TO-TOP -->
    <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

    <!-- JQUERY JS -->
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>

    <!-- BOOTSTRAP JS -->
    <script src="{{asset('assets/plugins/bootstrap/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

    <!-- SPARKLINE JS-->
    <script src="{{asset('assets/js/jquery.sparkline.min.js')}}"></script>

    <!-- Sticky js -->
    <script src="{{asset('assets/js/sticky.js')}}"></script>

    <!-- CHART-CIRCLE JS-->
    <script src="{{asset('assets/js/circle-progress.min.js')}}"></script>

    <!-- PIETY CHART JS-->
    <script src="{{asset('assets/plugins/peitychart/jquery.peity.min.js')}}"></script>
    <script src="{{asset('assets/plugins/peitychart/peitychart.init.js')}}"></script>

    <!-- SIDEBAR JS -->
    <script src="{{asset('assets/plugins/sidebar/sidebar.js')}}"></script>

    <!-- Perfect SCROLLBAR JS-->
    <script src="{{asset('assets/plugins/p-scroll/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('assets/plugins/p-scroll/pscroll.js')}}"></script>
    <script src="{{asset('assets/plugins/p-scroll/pscroll-1.js')}}"></script>

    <!-- INTERNAL CHARTJS CHART JS-->
    <script src="{{asset('assets/plugins/chart/Chart.bundle.js')}}"></script>
    <script src="{{asset('assets/plugins/chart/rounded-barchart.js')}}"></script>
    <script src="{{asset('assets/plugins/chart/utils.js')}}"></script>

    <!-- INTERNAL SELECT2 JS -->
    <script src="{{asset('assets/plugins/select2/select2.full.min.js')}}"></script>

    <!-- INTERNAL Data tables js-->
    <script src="{{asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/js/dataTables.bootstrap5.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/dataTables.responsive.min.js')}}"></script>

    <!-- INTERNAL APEXCHART JS -->
    <script src="{{asset('assets/js/apexcharts.js')}}"></script>
    <script src="{{asset('assets/plugins/apexchart/irregular-data-series.js')}}"></script>

    <!-- C3 CHART JS -->
    <script src="{{asset('assets/plugins/charts-c3/d3.v5.min.js')}}"></script>
    <script src="{{asset('assets/plugins/charts-c3/c3-chart.js')}}"></script>

    <!-- CHART-DONUT JS -->
    <script src="{{asset('assets/js/charts.js')}}"></script>

    <!-- INTERNAL Flot JS -->
    <script src="{{asset('assets/plugins/flot/jquery.flot.js')}}"></script>
    <script src="{{asset('assets/plugins/flot/jquery.flot.fillbetween.js')}}"></script>
    <script src="{{asset('assets/plugins/flot/chart.flot.sampledata.js')}}"></script>
    <script src="{{asset('assets/plugins/flot/dashboard.sampledata.js')}}"></script>

    <!-- INTERNAL Vector js -->
    <script src="{{asset('assets/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
    <script src="{{asset('assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>

    <!-- SIDE-MENU JS-->
    <script src="{{asset('assets/plugins/sidemenu/sidemenu.js')}}"></script>

    <!-- INTERNAL INDEX JS -->
    <script src="{{asset('assets/js/index1.js')}}"></script>

    <!-- Color Theme js -->
    <script src="{{asset('assets/js/themeColors.js')}}"></script>

    <!-- CUSTOM JS -->
    <script src="{{asset('assets/js/custom.js')}}"></script>

    
    <!-- JQUERY JS -->
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>

    <!-- BOOTSTRAP JS -->
    <script src="{{asset('assets/plugins/bootstrap/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

    <!-- CHARTJS CHART JS-->
    <script src="{{asset('assets/plugins/chart/Chart.bundle.js')}}"></script>
    <script src="{{asset('assets/plugins/chart/utils.js')}}"></script>

    <!-- C3 CHART JS -->
    <script src="{{asset('assets/plugins/charts-c3/d3.v5.min.js')}}"></script>
    <script src="{{asset('assets/plugins/charts-c3/c3-chart.js')}}"></script>

    <!-- SIDEBAR JS -->
    <script src="{{asset('assets/plugins/sidebar/sidebar.js')}}"></script>

    <!-- INPUT MASK JS-->
    <script src="{{asset('assets/plugins/input-mask/jquery.mask.min.js')}}"></script>

    <!-- SIDE-MENU JS-->
    <script src="{{asset('assets/plugins/sidemenu/sidemenu.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>

    <!-- Perfect SCROLLBAR JS-->
    <script src="{{asset('assets/plugins/select2/select2.full.min.js')}}"></script>



    <script>
        function toggleFunction(){
            let sidebar=document.querySelector(".app-sidebar")
            if(sidebar.classList.contains("side-open") ){
                sidebar.classList.add("side-close")
                sidebar.classList.remove("side-open")
            }else if(sidebar.classList.contains("side-close")){
                sidebar.classList.add("side-open")
                sidebar.classList.remove("side-close")
            }else{
                sidebar.classList.add("side-open")
            }

        }
        function LightkMode(actives,disactives){
            document.body.classList.remove("light-mode")
            document.body.classList.add("dark-mode")
            var activesEl=document.querySelectorAll(`.light-layout`)
            var disactivesEl=document.querySelectorAll(`.dark-layout`)
            activesEl.forEach(item=>{
                item.style.display="none"
            })
            disactivesEl.forEach(item=>{
                item.style.display="block"
            })


        }
        function DarkMode(actives,disactives){
            document.body.classList.add("light-mode")
            document.body.classList.remove("dark-mode")
            var activesEl=document.querySelectorAll(`.dark-layout`)
            var disactivesEl=document.querySelectorAll(`.light-layout`)
            activesEl.forEach(item=>{
                item.style.display="none"
            })
            disactivesEl.forEach(item=>{
                item.style.display="block"
            })

        }
    </script>
    @yield('js')




</body>

</html>