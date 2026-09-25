<!--
=========================================================
* Material Dashboard 2 - v3.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard
* Copyright 2023 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
    {{-- <link rel="canonical" href="https://www.creative-tim.com/product/material-dashboard" /> --}}
    {{-- external css file --}}
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    
  
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link id="pagestyle" href="{{ asset('assets/css/dashboard/external/material-dashboard.css?v=3.1.0') }}"
        rel="stylesheet" />

    {{-- internal css file --}}
    <link rel="stylesheet" href="{{asset('assets/css/dashboard/auth/auth.css')}}">
    <title>
        تسجيل الدخول
    </title>

</head>

<body class="bg-gray-200">
  
    <main class="main-content  mt-0">
        <div class="page-header align-items-start min-vh-100">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container my-auto">
                <div class="row">
                    <div class="col-lg-4 col-md-8 col-12 mx-auto">
                        <div class="card z-index-0 fadeIn3 fadeInBottom">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                    <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">
                                        لوحة التحكم
                                    </h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <form  action="{{route('dashboard.auth.store')}}" method="POST" role="form" class="text-start">
                                    @csrf
                                    @if(Session::has('error'))
                                        <div class="alert alert-danger">
                                            {{Session::get('error')}}
                                        </div>
                                    @endif
                                    <div class="input-group input-group-outline my-3">
                                        <label>
                                            أسم المستخدم
                                        </label>
                                        <input type="username" name="username" class="form-control" placeholder="أسم المستخدم">
                                        @error('username')
                                            <div class="alert alert-danger">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="input-group input-group-outline mb-3">
                                        <label>كلمة المرور</label>
                                        <input type="password" name="password" class="form-control" placeholder="كلمة المرور">
                                        @error('password')
                                            <div class="alert alert-danger">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-check form-switch d-flex align-items-center mb-3">
                                        <label class="form-check-label mb-0 ms-3" for="rememberMe">
                                            تذكرني
                                        </label>
                                        <input class="form-check-input" type="checkbox" id="rememberMe">
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">
                                            دخول
                                        </button>
                                    </div>
                                    {{-- <p class="mt-4 text-sm text-center">
                                        Don't have an account?
                                        <a href="../pages/sign-up.html"
                                            class="text-primary text-gradient font-weight-bold">
                                            Sign up
                                        </a>
                                    </p> --}}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer position-absolute bottom-2 py-2 w-100">
                <div class="container">
                    <div class="row align-items-center justify-content-lg-between">
                        <div class="col-lg-6 mb-lg-0 mb-4">
                            <div class="copyright text-center text-sm text-muted text-lg-start">
                                ©
                                <script>
                                    document.write(new Date().getFullYear())
                                </script>,
                                made with <i class="ri-heart-fill"></i> by
                                <a href="https://www.facebook.com/mustafa.gamal.5688" class="font-weight-bold"
                                    target="_blank">Mustafa Gamal</a>
                                for a better web.
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                                <li class="nav-item">
                                    <a href="https://www.facebook.com/mustafa.gamal.5688" class="nav-link text-muted"
                                        target="_blank">Facebook</a>
                                </li>
                                
                                <li class="nav-item">
                                    <a href="https://api.whatsapp.com/send?phone=201098091004" class="nav-link text-muted"
                                        target="_blank">Whatsapp</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://www.facebook.com/mustafa.gamal.5688" class="nav-link text-muted"
                                        target="_blank">About Us</a>
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </main>
    <div id="particles-js"></div>
  <!--   Core JS Files   -->
  <script src="{{ asset('assets/js/dashboard/external/core/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/dashboard/external/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/dashboard/external/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/js/dashboard/external/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('assets/js/dashboard/external/material-dashboard.min.js?v=3.1.0') }}"></script>
  <script src="{{ asset('assets/js/dashboard/auth/auth.js') }}"></script>

</body>

</html>
