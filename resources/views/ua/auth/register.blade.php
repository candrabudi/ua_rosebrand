<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=9">
    <meta name="description" content="PT  Sungai Budi">
    <meta name="author" content="PT  Sungai Budi">
    <title>Daftar - PT  Sungai Budi</title>
    <link rel="icon" type="image/png" href="images/fav.png">
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@300;400;500;600;700&amp;display=swap"
        rel="stylesheet">
    <link href='{{ asset('user_access/vendor/unicons-2.0.1/css/unicons.css') }}' rel='stylesheet'>
    <link href="{{ asset('user_access/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('user_access/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('user_access/css/night-mode.css') }}" rel="stylesheet">
    <link href="{{ asset('user_access/css/step-wizard.css') }}" rel="stylesheet">

    <link href="{{ asset('user_access/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user_access/vendor/OwlCarousel/assets/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('user_access/vendor/OwlCarousel/assets/owl.theme.default.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user_access/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user_access/vendor/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet">

</head>

<body>
    <div class="sign-inup">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="sign-form">
                        <div class="sign-inner">
                            <div class="sign-logo" id="logo">
                                <a href="index.html"><img src="images/logo.svg" alt=""></a>
                                <a href="index.html"><img class="logo-inverse" src="images/dark-logo.svg"
                                        alt=""></a>
                            </div>
                            <div class="form-dt">
                                <div class="form-inpts checout-address-step">
                                    <form action="{{ route('ua.register.submit') }}" method="POST">
                                        @csrf
                                        <div class="form-title mb-4">
                                            <h6>Sign Up</h6>
                                        </div>

                                        <div class="form-group pos_rel mb-3">
                                            <input name="full_name" type="text" placeholder="Full Name"
                                                class="form-control lgn_input" required>
                                            <i class="uil uil-user-circle lgn_icon"></i>
                                        </div>

                                        <div class="form-group pos_rel mb-3">
                                            <input name="username" type="text" placeholder="Username"
                                                class="form-control lgn_input" required>
                                            <i class="uil uil-user lgn_icon"></i>
                                        </div>

                                        <div class="form-group pos_rel mb-3">
                                            <input name="phone_number" type="text" placeholder="Phone Number"
                                                class="form-control lgn_input" required>
                                            <i class="uil uil-mobile-android-alt lgn_icon"></i>
                                        </div>

                                        <div class="form-group pos_rel mb-3">
                                            <input name="password" type="password" placeholder="Password"
                                                class="form-control lgn_input" required>
                                            <i class="uil uil-padlock lgn_icon"></i>
                                        </div>

                                        <div class="form-group pos_rel mb-3">
                                            <input name="password_confirmation" type="password"
                                                placeholder="Confirm Password" class="form-control lgn_input" required>
                                            <i class="uil uil-padlock lgn_icon"></i>
                                        </div>

                                        <button class="login-btn hover-btn" type="submit">Daftar Sekarang</button>
                                    </form>

                                </div>
                                <div class="signup-link">
                                    <p>Apakah kamu punya akun ? - <a href="{{ route('ua.login') }}">Masuk Sekarang</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="copyright-text text-center mt-4">
                        <i class="uil uil-copyright"></i>Copyright 2024 <b>PT  Sungai Budi</b> . All rights reserved
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('user_access/js/jquery.min.js') }}"></script>
    <script src="{{ asset('user_access/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('user_access/vendor/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('user_access/vendor/OwlCarousel/owl.carousel.js') }}"></script>
    <script src="{{ asset('user_access/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('user_access/js/custom.js') }}"></script>
    <script src="{{ asset('user_access/js/product.thumbnail.slider.js') }}"></script>
    <script src="{{ asset('user_access/js/offset_overlay.js') }}"></script>
    <script src="{{ asset('user_access/js/night-mode.js') }}"></script>


</body>

</html>
