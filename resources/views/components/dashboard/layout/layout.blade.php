<!DOCTYPE html>
<html lang="{{config('app.locale')}}" @if(config('app.locale')=='ar') dir="rtl" @else dir="ltr" @endif>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="{{asset('favicon.ico')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Fonts and icons -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link id="pagestyle" href="{{ asset('assets/css/dashboard/external/material-dashboard.css?v=3.1.0') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('assets/css/dashboard/main.css')}}">
    
    <style>
        /* Sidebar Responsive Styles */
        @media (max-width: 1199.98px) {
            .sidenav {
                transform: translateX(-100%);
                transition: transform 0.3s ease-in-out;
                z-index: 1030;
            }
            
            [dir="rtl"] .sidenav {
                transform: translateX(100%);
            }
            
            .sidenav.show {
                transform: translateX(0);
            }
            
            .main-content {
                margin-right: 0 !important;
                margin-left: 0 !important;
            }
            
            .sidenav #sidenav-collapse-main {
                display: block !important;
            }
        }
        
        /* Sidebar Overlay */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1029;
            transition: opacity 0.3s ease-in-out;
        }
        
        .sidebar-overlay.show {
            display: block;
        }
        
        /* Dropdown Styles */
        .nav-dropdown {
            position: relative;
        }
        
        .nav-dropdown-menu {
            display: none;
            padding: 0;
            border-bottom: 1px solid #474646;
        }
        
        .nav-dropdown.active .nav-dropdown-menu {
            display: block;
        }
        
        .nav-dropdown > .nav-link {
            position: relative;
        }
        
        .nav-dropdown > .nav-link .dropdown-arrow {
            position: absolute;
            left: 20px;
            transition: transform 0.3s ease;
            font-size: 20px;
        }
        
        [dir="rtl"] .nav-dropdown > .nav-link .dropdown-arrow {
            left: auto;
            right: 20px;
        }
        
        .nav-dropdown.active > .nav-link .dropdown-arrow {
            transform: rotate(180deg);
        }
        
        .nav-dropdown-menu .nav-link {
            padding-right: 50px;
            font-size: 0.875rem;
        }
        
        [dir="rtl"] .nav-dropdown-menu .nav-link {
            padding-right: 0;
            padding-left: 50px;
        }
        
        /* Navbar Responsive Styles */
        .mobile-menu-btn {
            display: none;
            width: 40px;
            height: 40px;
            padding: 0;
            border: none;
            background: transparent;
            cursor: pointer;
            align-items: center;
            justify-content: center;
        }
        
        .mobile-menu-btn .material-icons {
            font-size: 28px;
            color: #344767;
        }
        
        @media (max-width: 1199.98px) {
            .mobile-menu-btn {
                display: flex;
            }
            
            /* Hide breadcrumb on mobile */
            .navbar .breadcrumb-wrapper {
                display: none !important;
            }
            
            /* Show page title on mobile */
            .navbar .mobile-title {
                display: block !important;
            }
        }
        
        .navbar .mobile-title {
            display: none;
        }
        
        /* Navbar items responsive */
        @media (max-width: 767.98px) {
            /* Hide search on small mobile */
            .navbar .input-group {
                display: none !important;
            }
            
            /* Hide some nav items on mobile */
            .navbar-nav .nav-item.d-md-only {
                display: none !important;
            }
        }
        
        @media (min-width: 768px) {
            .navbar-nav .nav-item.d-md-only {
                display: flex !important;
            }
        }
        
        /* Responsive navbar layout */
        .navbar-main {
            display: flex;
            align-items: center;
        }
        
        .navbar-main .container-fluid {
            display: flex;
            align-items: center;
            flex-wrap: nowrap;
        }
        
        @media (max-width: 575.98px) {
            .navbar-main .navbar-nav {
                gap: 0.5rem;
            }
            
            .navbar-main .nav-link {
                padding: 0.5rem 0.25rem !important;
            }
        }
    </style>
    
    @stack('style')
    <title>{{ $title }}</title>
</head>

<body class="g-sidenav-show bg-gray-100">
    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    
    <!-- Global Action Alert -->
    <div class="globle-action-alert-container">
        <div class="globle-action-alert-content">
            <div class="globle-alert-content"></div>
        </div>
    </div>

    <!-- Sidebar -->
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 @if(config('app.locale')=='ar') fixed-end @else fixed-start @endif me-3 rotate-caret bg-gradient-dark" id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute start-0 top-0 d-xl-none" aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="https://www.facebook.com/mustafa.gamal.5688/" target="_blank">
                <img src="{{asset('assets/media/dashboard/external/img/logo-ct.png')}}" class="navbar-brand-img h-100" alt="main_logo">
                <span class="me-1 font-weight-bold text-white">Material Dashboard 2</span>
            </a>
        </div>
        <hr class="horizontal light mt-0 mb-2">
        
        <div class="collapse navbar-collapse px-0 w-auto" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a class="nav-link @if(Route::is('dashboard.home.*')) active @endif" href="{{route('dashboard.home.index')}}">
                        <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <span class="material-icons">dashboard</span>
                        </div>
                        <span class="nav-link-text me-1">لوحة القيادة</span>
                    </a>
                </li>

                 <li class="nav-item">
                    <a class="nav-link @if(Route::is('dashboard.banners.*')) active @endif" href="{{route('dashboard.banners.index')}}">
                        <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <span class="material-icons">campaign</span>
                        </div>
                        <span class="nav-link-text me-1"> البانرات</span>
                    </a>
                </li>

                <!-- Brands & Offers Group -->
                <li class="nav-item nav-dropdown">
                    <a class="nav-link" href="javascript:void(0)">
                        <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <span class="material-icons">storefront</span>
                        </div>
                        <span class="nav-link-text me-1">العلامات والعروض</span>
                        <span class="material-icons dropdown-arrow">expand_more</span>
                    </a>
                    <ul class="nav-dropdown-menu">
                        <li class="nav-item">
                            <a class="nav-link @if(Route::is('dashboard.brands.*')) active @endif" href="{{route('dashboard.brands.index')}}">
                                <span class="nav-link-text me-1">الماركات</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(Route::is('dashboard.sliders.*')) active @endif" href="{{route('dashboard.sliders.index')}}">
                                <span class="nav-link-text me-1">السلايدر</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(Route::is('dashboard.offers.*')) active @endif" href="{{route('dashboard.offers.index')}}">
                                <span class="nav-link-text me-1">العروض</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Categories Group -->
                <li class="nav-item nav-dropdown">
                    <a class="nav-link" href="javascript:void(0)">
                        <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <span class="material-icons">category</span>
                        </div>
                        <span class="nav-link-text me-1">التصنيفات</span>
                        <span class="material-icons dropdown-arrow">expand_more</span>
                    </a>
                    <ul class="nav-dropdown-menu">
                        <li class="nav-item">
                            <a class="nav-link @if(Route::is('dashboard.categories.*')) active @endif" href="{{route('dashboard.categories.index')}}">
                                <span class="nav-link-text me-1">التصنيفات الرئيسية</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(Route::is('dashboard.subcategories.*')) active @endif" href="{{route('dashboard.subcategories.index')}}">
                                <span class="nav-link-text me-1">التصنيفات الفرعية</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Products Group -->
                <li class="nav-item nav-dropdown active">
                    <a class="nav-link" href="javascript:void(0)">
                        <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <span class="material-icons">inventory_2</span>
                        </div>
                        <span class="nav-link-text me-1">المنتجات</span>
                        <span class="material-icons dropdown-arrow">expand_more</span>
                    </a>
                    <ul class="nav-dropdown-menu">
                        <li class="nav-item">
                            <a class="nav-link @if(Route::is('dashboard.products.index')) active @endif" href="{{route('dashboard.products.index')}}">
                                <span class="nav-link-text me-1">جميع المنتجات</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(Route::is('dashboard.products.archived')) active @endif" href="{{route('dashboard.products.archived')}}">
                                <span class="nav-link-text me-1">منتجات غير مفعلة</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(Route::is('dashboard.products.out.of.stock')) active @endif" href="{{route('dashboard.products.out.of.stock')}}">
                                <span class="nav-link-text me-1">منتجات منتهية من المخزن</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Orders & Refunds -->
                <li class="nav-item">
                    <a class="nav-link @if(Route::is('dashboard.orders.*')) active @endif" href="{{route('dashboard.orders.index')}}">
                        <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <span class="material-icons">list_alt</span>
                        </div>
                        <span class="nav-link-text me-1">الطلبات</span>
                        @if ($newPendingOrderCount)
                            <span class="nav-link-text-count" style="@if(config('app.locale')=='ar') left:10px; @else right:10px; @endif">
                                {{$newPendingOrderCount}}
                            </span>
                        @endif
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link @if(Route::is('dashboard.refunds.*')) active @endif" href="{{route('dashboard.refunds.index')}}">
                        <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <span class="material-icons">assignment_return</span>
                        </div>
                        <span class="nav-link-text me-1">المرتجعات</span>
                        @if ($newRefundOrderItemsCount)
                            <span class="nav-link-text-count" style="@if(config('app.locale')=='ar') left:10px; @else right:10px; @endif">
                                {{$newRefundOrderItemsCount}}
                            </span>
                        @endif
                    </a>
                </li>

                <!-- Coupons -->
                <li class="nav-item">
                    <a class="nav-link" href="{{route('dashboard.coupons.index')}}">
                        <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <span class="material-icons">discount</span>
                        </div>
                        <span class="nav-link-text me-1">الكوبونات</span>
                    </a>
                </li>

                <!-- Users Group -->
                <li class="nav-item nav-dropdown">
                    <a class="nav-link" href="javascript:void(0)">
                        <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <span class="material-icons">people</span>
                        </div>
                        <span class="nav-link-text me-1">المستخدمين</span>
                        <span class="material-icons dropdown-arrow">expand_more</span>
                    </a>
                    <ul class="nav-dropdown-menu">
                        <li class="nav-item">
                            <a class="nav-link @if(Route::is('dashboard.users.index')) active @endif" href="{{route('dashboard.users.index')}}">
                                <span class="nav-link-text me-1">المستخدمين النشطين</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(Route::is('dashboard.users.blocked')) active @endif" href="{{route('dashboard.users.blocked')}}">
                                <span class="nav-link-text me-1">المستخدمين المحظورين</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Content & Settings -->
                <li class="nav-item">
                    <a class="nav-link" href="{{route('dashboard.contacts.index')}}">
                        <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <span class="material-icons">mail</span>
                        </div>
                        <span class="nav-link-text me-1">رسائل التواصل</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{route('dashboard.abouts.index')}}">
                        <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <span class="material-icons">info</span>
                        </div>
                        <span class="nav-link-text me-1">من نحن</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{route('dashboard.admins.index')}}">
                        <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <span class="material-icons">admin_panel_settings</span>
                        </div>
                        <span class="nav-link-text me-1">المدراء</span>
                    </a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link" href="{{route('dashboard.notifications.index')}}">
                        <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <span class="material-icons">notifications</span>
                        </div>
                        <span class="nav-link-text me-1">
                        إرسال اشعارات
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('dashboard.settings.index')}}">
                        <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <span class="material-icons">settings</span>
                        </div>
                        <span class="nav-link-text me-1">الاعدادات</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <div class="sidenav-footer position-absolute w-100 bottom-0">
            <div class="mx-3">
                <a class="btn bg-gradient-primary w-100" href="https://www.facebook.com/mustafa.gamal.5688" type="button">
                    <span class="material-icons">api</span>
                    Developer
                </a>
            </div>
        </div>
    </aside>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg overflow-x-hidden">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <div class="d-flex align-items-center w-100">
                    <!-- Mobile Menu Button -->
                    <button class="mobile-menu-btn me-3" id="mobileMenuBtn" type="button">
                        <span class="material-icons">menu</span>
                    </button>
                    
                    <!-- Breadcrumb (Desktop) -->
                    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
                        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0">
                            <li class="breadcrumb-item text-sm ps-2">
                                <a class="opacity-5 text-dark" href="{{route('dashboard.home.index')}}">لوحات القيادة</a>
                            </li>
                            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">RTL</li>
                        </ol>
                        <h6 class="font-weight-bolder mb-0">RTL</h6>
                    </nav>
                    
                    <!-- Page Title (Mobile) -->
                    <h6 class="font-weight-bolder mb-0 mobile-title">لوحة القيادة</h6>
                    
                    <!-- Right Section -->
                    <div class="collapse navbar-collapse mt-sm-0 mt-2 px-0 ms-auto" id="navbar">
                        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                            <div class="input-group input-group-outline">
                                <label class="form-label">أكتب هنا...</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        
                        <ul class="navbar-nav ms-0 justify-content-end">
                            <li class="nav-item d-md-only">
                                <a href="" class="nav-link text-body font-weight-bold">
                                    <span class="material-icons">logout</span>
                                </a>
                            </li>
                            
                            <li class="nav-item px-3 d-md-only align-items-center">
                                <a href="javascript:;" class="nav-link text-body p-0">
                                    <span class="material-icons">settings_suggest</span>
                                </a>
                            </li>
                            
                            <li class="nav-item dropdown ps-2 d-flex align-items-center">
                                <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="material-icons">notifications</span>
                                </a>
                                <ul class="dropdown-menu px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                                    <li class="mb-2">
                                        <a class="dropdown-item border-radius-md" href="javascript:;">
                                            <div class="d-flex py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="text-sm font-weight-normal mb-1">
                                                        <span class="font-weight-bold">إشعار جديد</span>
                                                    </h6>
                                                    <p class="text-xs text-secondary mb-0">
                                                        <i class="fa fa-clock me-1"></i>
                                                        منذ 13 دقيقة
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            
                            <li class="nav-item d-md-only">
                                <a href="" class="nav-link text-body font-weight-bold">
                                    <span class="material-icons">person</span>
                                    {{auth('admin')->user()->full_name}}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        
        <div class="container-fluid py-4">
            @if(Session::has('success'))
                <div class="alert-container">
                    <div class="alert alert-success alert-dismissible text-white" role="alert">
                        <span class="text-sm">{{Session::get('success')}}</span>
                        <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                </div>
            @endif
            
            <x-Dashboard.statistics.statistics></x-Dashboard.statistics.statistics>
            {{ $slot }}
        </div>

        <footer class="footer py-4">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <div class="copyright text-center text-sm text-muted text-lg-start">
                            © <script>document.write(new Date().getFullYear())</script>,
                            made with <i class="ri-heart-fill"></i> by
                            <a href="https://www.facebook.com/mustafa.gamal.5688" class="font-weight-bold" target="_blank">Mustafa Gamal</a>
                            for a better web.
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                            <li class="nav-item">
                                <a href="https://www.facebook.com/mustafa.gamal.5688" class="nav-link text-muted" target="_blank">Facebook</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://api.whatsapp.com/send?phone=201098091004" class="nav-link text-muted" target="_blank">Whatsapp</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link text-muted" target="_blank">About Us</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </main>

    <!-- Scripts -->
    <script src="https://cdn.tiny.cloud/1/1zf7d3cm6ok7sf45uyk62f4412dwvzizt35nsk345a05ia93/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="{{ asset('assets/js/dashboard/external/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard/external/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard/external/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard/external/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        // Sidebar Toggle
        $(document).ready(function() {
            // Toggle sidebar on mobile
            $('#mobileMenuBtn, #iconSidenav').click(function() {
                $('#sidenav-main').toggleClass('show');
                $('#sidebarOverlay').toggleClass('show');
                $('body').toggleClass('overflow-hidden');
            });

            // Close sidebar when clicking overlay
            $('#sidebarOverlay').click(function() {
                $('#sidenav-main').removeClass('show');
                $(this).removeClass('show');
                $('body').removeClass('overflow-hidden');
            });

            // Dropdown functionality
            $('.nav-dropdown > .nav-link').click(function(e) {
                e.preventDefault();
                $(this).parent('.nav-dropdown').toggleClass('active');
            });

            // Auto-expand active dropdown
            $('.nav-dropdown .nav-link.active').each(function() {
                $(this).closest('.nav-dropdown').addClass('active');
            });

            // Close sidebar when clicking a link on mobile
            $('.nav-dropdown-menu .nav-link').click(function() {
                if ($(window).width() < 1200) {
                    setTimeout(function() {
                        $('#sidenav-main').removeClass('show');
                        $('#sidebarOverlay').removeClass('show');
                        $('body').removeClass('overflow-hidden');
                    }, 300);
                }
            });
        });

        // Scrollbar initialization
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <script>
        // اختفاء كل العناصر التي تحمل الكلاس auto-dismiss بعد 3 ثواني
        setTimeout(function() {
            document.querySelectorAll('.alert').forEach(function(alertEl) {
                var alert = new bootstrap.Alert(alertEl);
                alert.close();
            });
        }, 3000); // 3 ثواني
    </script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="{{ asset('assets/js/dashboard/external/material-dashboard.min.js?v=3.1.0') }}"></script>
    
    @stack('script')
</body>
</html>