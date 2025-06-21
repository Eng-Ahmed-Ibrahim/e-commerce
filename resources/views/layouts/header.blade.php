<div class="app-header header sticky">
                <div class="container-fluid main-container">

                    <div class="d-flex">
                            <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-bs-toggle="sidebar" href="#"></a>
                            <!-- sidebar-toggle-->
                            <a class="logo-horizontal " href="index.html">
                                <img  style="height: 55px;" src="{{asset('assets/assets/images/logo.png')}}" class="header-brand-img desktop-logo" alt="logo">
                                <img  style="height: 55px;" src="{{asset('assets/assets/images/logo.png')}}" class="header-brand-img light-logo1" alt="logo">
                            </a>

                            <div class="d-flex order-lg-2 ms-auto header-right-icons">
                                <!-- <div class="dropdown d-lg-none d-md-block d-none">
                                    <a href="#" class="nav-link icon" data-bs-toggle="dropdown">
                                        <i class="fe fe-search"></i>
                                    </a>
                                    <div class="dropdown-menu header-search dropdown-menu-start">
                                        <div class="input-group w-100 p-2">
                                            <input type="text" class="form-control" placeholder="Search....">
                                            <div class="input-group-text btn btn-primary">
                                                <i class="fe fe-search" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <!-- SEARCH -->
                                <button class="navbar-toggler navresponsive-toggler d-md-none ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="navbar-toggler-icon fe fe-more-vertical"></span>
                                    </button>
                                <div class="navbar navbar-collapse responsive-navbar p-0">
                                    <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                                        <div class="d-flex order-lg-2">
                                            <div class="dropdown d-md-none d-flex">
                                                <a href="#" class="nav-link icon" data-bs-toggle="dropdown">
                                                    <i class="fe fe-search"></i>
                                                </a>
                                                <div class="dropdown-menu header-search dropdown-menu-start">
                                                    <div class="input-group w-100 p-2">
                                                        <input type="text" class="form-control" placeholder="Search....">
                                                        <div class="input-group-text btn btn-primary">
                                                            <i class="fa fa-search" aria-hidden="true"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- COUNTRY -->
                                            <!-- <div class="d-flex country">
                                                <a  href="/lang?lang={{session('lang') == 'ar'? 'en' : 'ar'}}" class="nav-link icon text-center" stopAhmed-data-bs-target="#country-selector" stopAhmed-data-bs-toggle="modal">
                                                    <i class="fe fe-globe"></i>
                                                    <span class="fs-16 ms-2 d-none d-xl-block">
                                                        {{session('lang') == "ar" ? "English" : "عربي"}}
                                                    </span>
                                                </a>
                                            </div> -->
                                            <!-- SEARCH -->
                                            <div class="dropdown  d-flex">
                                                <a class="nav-link icon theme-layout nav-link-bg layout-setting">
                                                    <span class="dark-layout" onclick="DarkMode('dark-layout','dark-layout')"><i class="fe fe-moon"></i></span>
                                                    <span class="light-layout" onclick="LightkMode('light-layout','light-layout')"><i class="fe fe-sun"></i></span>
                                                </a>
                                            </div>
                                            <!-- Theme-Layout -->
                                            <!-- <div class="dropdown d-flex">
                                                <a class="nav-link icon full-screen-link nav-link-bg">
                                                    <i class="fe fe-minimize fullscreen-button"></i>
                                                </a>
                                            </div> -->
                                            <!-- FULL-SCREEN -->
                                            <div class="dropdown  d-flex notifications">
                                                <a class="nav-link icon" data-bs-toggle="dropdown"><i class="fe fe-bell"></i>
                                                @if(auth()->user()->unreadNotifications()->count() > 0 )
                                                <span class=" pulse"></span>
                                                @endif
                                                    </a>
                                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                    <div class="drop-heading border-bottom">
                                                        <div class="d-flex">
                                                            <h6 class="mt-1 mb-0 fs-16 fw-semibold text-dark">Notifications</h6>
                                                        </div>
                                                    </div>
                                                    <div class="notifications-menu" style="max-height: 250px;overflow-y: scroll;">
                                                    @foreach(auth()->user()->notifications()->orderBy('created_at',"DESC")->paginate(15) as $notification)

                                                        <div onclick="markAsSeen(event, '{{$notification->id}}', '{{$notification['data']['url']}}')" style="cursor: pointer;opacity: {{$notification->read_at == null ? '1' : '0.5'}};margin: 10px 0px; width:100% !important" class="dropdown-item d-flex ; w-100" >
                                                            <div class="me-3 notifyimg  bg-primary brround box-shadow-primary">
                                                                <i class="fe fe-mail"></i>
                                                            </div>
                                                            <div class="mt-1" style="width: 100%;">
                                                                <div style="display: flex; justify-content:space-between">
                                                                    <h5 class="notification-label mb-1">  {{$notification['data']['title']}}</h5>
                                                                    <span class="notification-subtext">{{ $notification->created_at->diffForHumans() }}</span>
                                                                </div>
                                                                <span class="notification-subtext"> {{$notification['data']['body']}} </span>
                                                                </div>
                                                        </div>
                                                    @endforeach
                                                    </div>
                                                    <div class="dropdown-divider m-0"></div>
                                                </div>
                                            </div>
                                            <!-- NOTIFICATIONS -->
                                            <div class="dropdown  d-flex message">
                                                <!-- <a class="nav-link icon text-center" data-bs-toggle="dropdown">
                                                    <i class="fe fe-message-square"></i><span class="pulse-danger"></span>
                                                </a> -->
                                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                    <div class="drop-heading border-bottom">
                                                        <div class="d-flex">
                                                            <h6 class="mt-1 mb-0 fs-16 fw-semibold text-dark">You have 5 Messages</h6>
                                                            <div class="ms-auto">
                                                                <a href="#" class="text-muted p-0 fs-12">make all unread</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="message-menu">
                                                        <a class="dropdown-item d-flex" href="chat.html">
                                                            <span class="avatar avatar-md brround me-3 align-self-center cover-image" data-bs-image-src="{{asset('assets/images/users/1.jpg')}}"></span>
                                                            <div class="wd-90p">
                                                                <div class="d-flex">
                                                                    <h5 class="mb-1">Peter Theil</h5>
                                                                    <small class="text-muted ms-auto text-end">
                                                                            6:45 am
                                                                        </small>
                                                                </div>
                                                                <span>Commented on file Guest list....</span>
                                                            </div>
                                                        </a>
                                                        <a class="dropdown-item d-flex" href="chat.html">
                                                            <span class="avatar avatar-md brround me-3 align-self-center cover-image" data-bs-image-src="{{asset('assets/images/users/15.jpg')}}"></span>
                                                            <div class="wd-90p">
                                                                <div class="d-flex">
                                                                    <h5 class="mb-1">Abagael Luth</h5>
                                                                    <small class="text-muted ms-auto text-end">
                                                                            10:35 am
                                                                        </small>
                                                                </div>
                                                                <span>New Meetup Started......</span>
                                                            </div>
                                                        </a>
                                                        <a class="dropdown-item d-flex" href="chat.html">
                                                            <span class="avatar avatar-md brround me-3 align-self-center cover-image" data-bs-image-src="{{asset('assets/images/users/12.jpg')}}"></span>
                                                            <div class="wd-90p">
                                                                <div class="d-flex">
                                                                    <h5 class="mb-1">Brizid Dawson</h5>
                                                                    <small class="text-muted ms-auto text-end">
                                                                            2:17 pm
                                                                        </small>
                                                                </div>
                                                                <span>Brizid is in the Warehouse...</span>
                                                            </div>
                                                        </a>
                                                        <a class="dropdown-item d-flex" href="chat.html">
                                                            <span class="avatar avatar-md brround me-3 align-self-center cover-image" data-bs-image-src="{{asset('assets/images/users/4.jpg')}}"></span>
                                                            <div class="wd-90p">
                                                                <div class="d-flex">
                                                                    <h5 class="mb-1">Shannon Shaw</h5>
                                                                    <small class="text-muted ms-auto text-end">
                                                                            7:55 pm
                                                                        </small>
                                                                </div>
                                                                <span>New Product Realease......</span>
                                                            </div>
                                                        </a>

                                                    </div>
                                                    <div class="dropdown-divider m-0"></div>
                                                    <a href="#" class="dropdown-item text-center p-3 text-muted">See all Messages</a>
                                                </div>
                                            </div>
                                            <!-- MESSAGE-BOX -->
                                            <!-- <div class="dropdown d-flex header-settings">
                                                <a href="javascript:void(0);" class="nav-link icon" data-bs-toggle="sidebar-right" data-target=".sidebar-right">
                                                    <i class="fe fe-align-right"></i>
                                                </a>
                                            </div> -->
                                            <!-- SIDE-MENU -->
                                            <div class="dropdown d-flex profile-1">
                                                <a href="#" data-bs-toggle="dropdown" class="nav-link leading-none d-flex">
                                                    <img src="{{auth()->user()->image}}" alt="profile-user" class="avatar  profile-user brround cover-image">
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                    <div class="drop-heading">
                                                        <div class="text-center">
                                                            <h5 class="text-dark mb-0 fs-14 fw-semibold">{{auth()->user()->name}}</h5>
                                                            <small class="text-muted">{{auth()->user()->email}}</small>
                                                        </div>
                                                    </div>
                                                    <div class="dropdown-divider m-0"></div>
                                                    <a class="dropdown-item" href="{{route('profile')}}">
                                                        <i class="dropdown-icon fe fe-user"></i> Profile
                                                    </a>
    
                                                    <form action="/logout" method="post"  enctype="multipart/form-data">
                                                        @csrf 
                                                        <button class="dropdown-item" type="submit">
                                                            <i class="dropdown-icon fe fe-alert-circle"></i> Sign out
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>

                </div>
            </div>


            <div class="modal fade" id="country-selector">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content country-select-modal">
                    <div class="modal-header">
                        <h6 class="modal-title">Choose Country</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row p-3">

                            <div class="col-lg-6">
                                <input type="radio" class="btn-check" name="btnradio" id="btnradio1"  checked="">
                                <a href="/lang?lang=en" class="btn btn-country btn-lg btn-block" >
                                    <span class="country-selector"><img alt="" src="{{asset('assets/images/flags/us_flag.jpg')}}" class="me-3 language"></span>English
                                </a>

                            </div>

                            <div class="col-lg-6">
                                <input type="radio" class="btn-check" name="btnradio" id="btnradio1"  checked="">
                                <a href="/lang?lang=ar" class="btn btn-country btn-lg btn-block" >
                                    <span class="country-selector"><img alt="" src="{{asset('assets/images/flags/eg.svg')}}" class="me-3 language"></span>Arabic
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
    function markAsSeen(event, notificationId, url) {
        event.preventDefault(); // Prevent default link behavior

        $.ajax({
            url: "{{ route('notifications.markAsSeen') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                notification_id: notificationId,
            },
            success: function(response) {
                window.location.href = url; // Navigate to the URL after marking as seen
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                window.location.href = url; // Navigate to the URL even if marking as seen fails
            }
        });
    }
</script>