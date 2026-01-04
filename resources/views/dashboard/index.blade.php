<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ config('app.name') }} - Dashboard</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="CodedThemes">
    <meta name="keywords"
        content=" Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="CodedThemes">
    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('dashboard/images/favicon.ico') }}" type="image/x-icon">
    <!-- font awesome style -->
    <link href="{{ asset('template/css/font-awesome.min.css') }}" rel="stylesheet" />
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/css/bootstrap/css/bootstrap.min.css') }}">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/icon/themify-icons/themify-icons.css') }}">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/icon/icofont/css/icofont.css') }}">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/css/jquery.mCustomScrollbar.css') }}">
    <!-- Datatables start -->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/datatables/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/datatables/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/datatables/css/icon-font.min.css') }}">
    <!-- Datatables end -->
</head>

<body>
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">

                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">

                    <div class="navbar-logo">
                        <a class="mobile-menu" id="mobile-collapse" href="#!">
                            <i class="ti-menu"></i>
                        </a>
                        <a class="mobile-search morphsearch-search" href="#">
                            <i class="ti-search"></i>
                        </a>
                        <a href="">
                            {{ config('app.name') }} - Dashboard
                        </a>
                        <a class="mobile-options">
                            <i class="ti-more"></i>
                        </a>
                    </div>

                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">
                            <li>
                                <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a>
                                </div>
                            </li>

                            <li>
                                <a href="#!" onclick="javascript:toggleFullScreen()">
                                    <i class="ti-fullscreen"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav-right">
                            <li class="user-profile header-notification">
                                <a href="#">
                                    <img src="{{ asset('images/user/' . auth()->user()->imageUrl) }}"
                                        class="rounded-circle" alt="User-Profile-Image">
                                    <span>{{ auth()->user()->name }}</span>
                                    <i class="ti-angle-down"></i>
                                </a>
                                <ul class="show-notification profile-notification">
                                    <li>
                                        <a href="{{ route('logout') }}">
                                            <i class="ti-layout-sidebar-left"></i> Logout
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <nav class="pcoded-navbar">
                        <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
                        <div class="pcoded-inner-navbar main-menu">
                            <div class="">
                                <div class="main-menu-header">
                                    <img class="img-40 img-radius"
                                        src="{{ asset('images/user/' . auth()->user()->imageUrl) }}"
                                        alt="User-Profile-Image">
                                    <div class="user-details">
                                        <span>{{ auth()->user()->name }}</span>
                                        <span id="more-details">
                                            {{ auth()->user()->email }}<i class="ti-angle-down"></i>
                                        </span>
                                    </div>
                                </div>

                                <div class="main-menu-content">
                                    <ul>
                                        <li class="more-details">
                                            <a href="{{ route('logout') }}">
                                                <i class="ti-layout-sidebar-left"></i>Logout
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation">Layout</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="">
                                    <a href="/dashboard/main">
                                        <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>

                            <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation">Products</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="">
                                    <a href="{{ route('category.index') }}">
                                        <span class="pcoded-micon"><i class="ti-menu"></i><b>D</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Category</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('product.index') }}">
                                        <span class="pcoded-micon"><i class="ti-agenda"></i><b>D</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Product</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>

                            <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation">Orders &
                                Reservations</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="">
                                    <a href="{{ route('order.status') }}">
                                        <span class="pcoded-micon"><i class="ti-info-alt"></i><b>D</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Order Status</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="{{ route('table-reservations.index') }}">
                                        <span class="pcoded-micon"><i class="ti-book"></i><b>D</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Reserved Tables</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="{{ route('reports') }}">
                                        <span class="pcoded-micon"><i class="ti-receipt"></i><b>D</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Selling Reports</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>

                            <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation">Registered Users
                            </div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="">
                                    <a href="{{ route('user.index') }}">
                                        <span class="pcoded-micon"><i class="ti-user"></i><b>D</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Manage Users</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="card borderless-card mb-0">
                                <div class="card-block inverse-breadcrumb">
                                    <div class="page-header-breadcrumb">
                                        <ul class="breadcrumb-title">
                                            <li class="breadcrumb-item">
                                                <a href="/">
                                                    <i class="icofont icofont-home"></i>
                                                </a>
                                            </li>
                                            <li class="breadcrumb-item">
                                                <!-- set page name in bread crumb -->
                                                <a href="">{{ $page }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pcoded-content">
                        <div class="pcoded-inner-content p-0 pl-3">
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <div class="page-body">
                                        @yield('content')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Required Jquery -->
    <script type="text/javascript" src="{{ asset('dashboard/js/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('dashboard/js/jquery-ui/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('dashboard/js/popper.js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('dashboard/js/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="{{ asset('dashboard/js/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="{{ asset('dashboard/js/modernizr/modernizr.js') }}"></script>
    <!-- am chart -->
    <script src="{{ asset('dashboard/pages/widget/amchart/amcharts.min.js') }}"></script>
    <script src="{{ asset('dashboard/pages/widget/amchart/serial.min.js') }}"></script>
    <!-- Todo js -->
    <script type="text/javascript " src="{{ asset('dashboard/pages/todo/todo.js') }}"></script>
    <!-- Custom js -->
    <script type="text/javascript" src="{{ asset('dashboard/pages/dashboard/custom-dashboard.js') }}"></script>
    <script type="text/javascript" src="{{ asset('dashboard/js/script.js') }}"></script>
    <script type="text/javascript " src="{{ asset('dashboard/js/SmoothScroll.js') }}"></script>
    <script src="{{ asset('dashboard/js/pcoded.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/demo-12.js') }}"></script>
    <script src="{{ asset('dashboard/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>

    <!-- Added for Datatables - starts here -->
    <script src="{{ asset('dashboard/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dashboard/datatables/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('dashboard/datatables/js/responsive.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('dashboard/datatables/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('dashboard/datatables/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dashboard/datatables/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('dashboard/datatables/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('dashboard/datatables/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('dashboard/datatables/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('dashboard/datatables/js/vfs_fonts.js') }}"></script>

    <script src="{{ asset('dashboard/datatables/js/datatable-setting.js') }}"></script>
    <!-- Added for Datatables - ends here -->

    <script>
        /*for disappearing alert message*/
        window.onload = function() {
            var seconds = 10;
            setTimeout(function() {
                document.getElementById("message").style.display = "none";
            }, seconds * 1000);
        };
    </script>
    <script>
        var $window = $(window);
        var nav = $('.fixed-button');
        $window.scroll(function() {
            if ($window.scrollTop() >= 200) {
                nav.addClass('active');
            } else {
                nav.removeClass('active');
            }
        });
    </script>
    <!-- Tooltip -->
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    <!-- End Tooltip -->
</body>

</html>
