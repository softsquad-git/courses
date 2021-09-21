<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
          content="Kurs języka - panel admina">
    <meta name="robots" content="noindex,nofollow">
    <title>@yield('title')</title>
    <link rel="icon" type="image/png" sizes="16x16" href="">
    <link href="{{ asset('fontello/css/fontello.css') }}" rel="stylesheet">
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <script src="{{ asset('admin/ckeditor/ckeditor.js') }}"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
<div class="preloader">
    <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
    </div>
</div>

<div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
     data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <header class="topbar" data-navbarbg="skin5">
        <nav class="navbar top-navbar navbar-expand-md navbar-dark">
            <div class="navbar-header" data-logobg="skin5">

                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <a class="navbar-brand" href="{{ route('admin.index') }}">
                    <!-- Logo icon -->
                    <b class="logo-icon ps-2">
                        <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                        <!-- Dark Logo icon -->
                        <img src="{{ asset('admin/assets/images/logo-icon.png') }}" alt="homepage" class="light-logo" />

                    </b>
                    <!--End Logo icon -->
                    <!-- Logo text -->
                    <span class="logo-text">
                            <!-- dark Logo text -->
                            Admin Panel

                        </span>
                    <!-- Logo icon -->
                    <!-- <b class="logo-icon"> -->
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->
                    <!-- <img src="../../assets/images/logo-text.png" alt="homepage" class="light-logo" /> -->

                    <!-- </b> -->
                    <!--End Logo icon -->
                </a>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Toggle which is visible on mobile only -->
                <!-- ============================================================== -->
                <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                        class="ti-menu ti-close"></i></a>
            </div>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                <!-- ============================================================== -->
                <!-- toggle and nav items -->
                <!-- ============================================================== -->
                <ul class="navbar-nav float-start me-auto">
                    <li class="nav-item d-none d-lg-block"><a
                            class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)"
                            data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                </ul>
                <!-- ============================================================== -->
                <!-- Right side toggle and nav items -->
                <!-- ============================================================== -->
                <ul class="navbar-nav float-end">
                    <!-- ============================================================== -->
                    <!-- Comment -->
                    <!-- ============================================================== -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-bell font-24"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <!-- ============================================================== -->
                    <!-- End Comment -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Messages -->
                    <!-- ============================================================== -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" id="2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="font-24 mdi mdi-comment-processing"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end mailbox animated bounceInDown" aria-labelledby="2">
                            <ul class="list-style-none">
                                <li>
                                    <div class="">
                                        <!-- Message -->
                                        <a href="javascript:void(0)" class="link border-top">
                                            <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-success btn-circle"><i
                                                            class="ti-calendar"></i></span>
                                                <div class="ms-2">
                                                    <h5 class="mb-0">Event today</h5>
                                                    <span class="mail-desc">Just a reminder that event</span>
                                                </div>
                                            </div>
                                        </a>
                                        <!-- Message -->
                                        <a href="javascript:void(0)" class="link border-top">
                                            <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-info btn-circle"><i
                                                            class="ti-settings"></i></span>
                                                <div class="ms-2">
                                                    <h5 class="mb-0">Settings</h5>
                                                    <span class="mail-desc">You can customize this template</span>
                                                </div>
                                            </div>
                                        </a>
                                        <!-- Message -->
                                        <a href="javascript:void(0)" class="link border-top">
                                            <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-primary btn-circle"><i
                                                            class="ti-user"></i></span>
                                                <div class="ms-2">
                                                    <h5 class="mb-0">Pavan kumar</h5>
                                                    <span class="mail-desc">Just see the my admin!</span>
                                                </div>
                                            </div>
                                        </a>
                                        <!-- Message -->
                                        <a href="javascript:void(0)" class="link border-top">
                                            <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-danger btn-circle"><i
                                                            class="fa fa-link"></i></span>
                                                <div class="ms-2">
                                                    <h5 class="mb-0">Luanch Admin</h5>
                                                    <span class="mail-desc">Just see the my new admin!</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </ul>
                    </li>
                    <!-- ============================================================== -->
                    <!-- End Messages -->
                    <!-- ============================================================== -->

                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('admin/assets/images/users/1.jpg') }}" alt="user" class="rounded-circle" width="31">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end user-dd animated" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="javascript:void(0)"><i class="ti-user me-1 ms-1"></i>
                                My Profile</a>
                            <a class="dropdown-item" href="javascript:void(0)"><i class="ti-wallet me-1 ms-1"></i>
                                My Balance</a>
                            <a class="dropdown-item" href="javascript:void(0)"><i class="ti-email me-1 ms-1"></i>
                                Inbox</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)"><i
                                    class="ti-settings me-1 ms-1"></i> Account Setting</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)"><i
                                    class="fa fa-power-off me-1 ms-1"></i> Logout</a>
                            <div class="dropdown-divider"></div>
                            <div class="ps-4 p-10"><a href="javascript:void(0)"
                                                      class="btn btn-sm btn-success btn-rounded text-white">View Profile</a></div>
                        </ul>
                    </li>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                </ul>
            </div>
        </nav>
    </header>
    <!-- ============================================================== -->
    <!-- End Topbar header -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <aside class="left-sidebar" data-sidebarbg="skin5">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav">
                <ul id="sidebarnav" class="pt-4">
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                                 href="{{ route('admin.index') }}" aria-expanded="false"><i class="icon icon-windows"></i><span
                                class="hide-menu">Dashboard</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                                                 href="javascript:void(0)" aria-expanded="false"><i class="icon icon-hand-paper-o"></i><span
                                class="hide-menu">Kursy </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="{{ route('admin.courses') }}" class="sidebar-link"><i
                                        class="icon icon-list"></i><span class="hide-menu"> Lista
                                        </span></a></li>
                            <li class="sidebar-item"><a href="{{ route('admin.course.create') }}" class="sidebar-link"><i
                                        class="icon icon-plus"></i><span class="hide-menu"> Dodaj
                                        </span></a></li>
                            <li class="sidebar-item"><a href="{{ route('admin.course.levels') }}" class="sidebar-link"><i
                                        class="icon icon-level-up"></i><span class="hide-menu"> Poziomy trudności
                                        </span></a></li>
                            <li class="sidebar-item"><a href="{{ route('admin.course.lessons') }}" class="sidebar-link"><i
                                        class="icon icon-paragraph"></i><span class="hide-menu"> Lekcje
                                        </span></a></li>
                        </ul>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                                 href="{{ route('admin.users') }}" aria-expanded="false"><i class="icon icon-user"></i><span
                                class="hide-menu">Użytkownicy</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                                 href="{{ route('admin.languages') }}" aria-expanded="false"><i class="icon icon-globe"></i><span
                                class="hide-menu">Języki</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                                 href="{{ route('admin.testimonials') }}" aria-expanded="false"><i class="icon icon-star-empty"></i><span
                                class="hide-menu">Opinie</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                                                 href="javascript:void(0)" aria-expanded="false"><i class="icon icon-credit-card"></i><span
                                class="hide-menu">Płatności </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="{{ route('admin.payments.index') }}" class="sidebar-link"><i
                                        class="icon icon-list"></i><span class="hide-menu"> Lista
                                        </span></a></li>
                            <li class="sidebar-item"><a href="{{ route('admin.discount_codes') }}" class="sidebar-link"><i
                                        class="icon icon-cc-discover"></i><span class="hide-menu"> Kody rabatowe
                                        </span></a></li>
                            <li class="sidebar-item"><a href="{{ route('admin.subscriptions') }}" class="sidebar-link"><i
                                        class="icon icon-subscript"></i><span class="hide-menu"> Abnamenty
                                        </span></a></li>
                        </ul>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                                                 href="javascript:void(0)" aria-expanded="false"><i class="icon icon-home"></i><span
                                class="hide-menu">Strona główna </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="{{ route('admin.home.information.index') }}" class="sidebar-link"><i
                                        class="icon icon-list"></i><span class="hide-menu"> Lista informacji
                                        </span></a></li>
                            <li class="sidebar-item"><a href="{{ route('admin.home.information_images.index') }}" class="sidebar-link"><i
                                        class="icon icon-list"></i><span class="hide-menu"> Lista informacji ze zdjęciem
                                        </span></a></li>
                            <li class="sidebar-item"><a href="{{ route('admin.home.words.index') }}" class="sidebar-link"><i
                                        class="icon icon-list"></i><span class="hide-menu"> Lista słów
                                        </span></a></li>
                            <li class="sidebar-item"><a href="{{ route('admin.home.images.index') }}" class="sidebar-link"><i
                                        class="icon icon-list"></i><span class="hide-menu"> Zdjęcia na stronie głównej
                                        </span></a></li>
                        </ul>
                    </li>

                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                                                 href="javascript:void(0)" aria-expanded="false"><i class="icon icon-pagelines"></i><span
                                class="hide-menu">Strony </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="{{ route('admin.pages.static_pages.index') }}" class="sidebar-link"><i
                                        class="icon icon-pagelines"></i><span class="hide-menu"> Statyczne
                                        </span></a></li>
                        </ul>
                    </li>


                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                                 href="{{ route('admin.setting.index') }}" aria-expanded="false"><i
                                class="icon icon-cog-alt"></i><span class="hide-menu">Ustawienia</span></a></li>


                </ul>
            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
    </aside>
    <div class="page-wrapper">
        @yield('content')
    </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
<script>
    CKEDITOR.replaceClass = 'editor';
</script>
<script>
    $('.remove-form').submit(function () {
        return  confirm('Czy na pewno chcesz usunąć ten element?');
    });
</script>
@yield('customJs')
</body>
</html>
