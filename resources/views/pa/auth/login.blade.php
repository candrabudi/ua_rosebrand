<!DOCTYPE html>
<html lang="en" class="group" data-sidebar-size="lg">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login - Personal Akses</title>
    <meta name="robots" content="noindex, follow">
    <meta name="description" content="web development agency">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico">
    <link rel="stylesheet" href="{{ asset('personal_access/css/output.css') }}">
</head>

<body class="bg-body-light dark:bg-dark-body">
    <div id="loader" class="w-screen h-screen flex-center bg-white dark:bg-dark-card fixed inset-0 z-[9999]">
        <img src="{{ asset('personal_access/pre-loader/bar-loader.gif') }}" alt="loader">
    </div>

    <div class="main-content m-4">
        <div
            class="grid grid-cols-12 gap-y-7 sm:gap-7 card px-4 sm:px-10 2xl:px-[70px] py-15 lg:items-center lg:min-h-[calc(100vh_-_32px)]">
            <div class="col-span-full lg:col-span-6">
                <div class="flex flex-col items-center justify-center gap-10 text-center">
                    <div class="hidden sm:block">
                        <img src="{{ asset('personal_access/images/loti/loti-auth.svg') }}" alt="loti"
                            class="group-[.dark]:hidden">
                        <img src="{{ asset('personal_access/images/loti/loti-auth-dark.svg') }}" alt="loti"
                            class="group-[.light]:hidden">
                    </div>
                    <div>
                        <h3 class="text-xl md:text-[28px] leading-none font-semibold text-heading">
                            Selamat Datang Kembali!
                        </h3>
                        <p class="font-medium text-gray-500 dark:text-dark-text mt-4 px-[10%]">
                            Bersama Rosebrand, mari lanjutkan komitmen kami dalam menghadirkan kualitas terbaik untuk
                            setiap keluarga Indonesia.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-span-full lg:col-span-6 w-full lg:max-w-[600px]">
                <div
                    class="border border-form dark:border-dark-border p-5 md:p-10 rounded-20 md:rounded-30 dk-theme-card-square">
                    <h3 class="text-xl md:text-[28px] leading-none font-semibold text-heading">
                        Masuk
                    </h3>
                    <p class="font-medium text-gray-500 dark:text-dark-text mt-4">
                        Selamat Datang! Masuk untuk manajemen Rosebrand
                    </p>
                    <form method="POST" action="{{ route('pa.login.process') }}" class="leading-none mt-8">
                        @csrf

                        <div class="mb-2.5">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" id="username" name="username" value="{{ old('username') }}" required
                                placeholder="debra.holt" class="form-input px-4 py-3.5 rounded-lg">
                        </div>

                        <div class="mt-5">
                            <label for="password" class="form-label">Password</label>
                            <div class="relative">
                                <input type="password" id="password" name="password" placeholder="Password" required
                                    class="form-input px-4 py-3.5 rounded-lg">
                                <label for="toggleInputType"
                                    class="size-8 rounded-md flex-center hover:bg-gray-200 dark:hover:bg-dark-icon foucs:bg-gray-200 dark:foucs:bg-dark-icon position-center !left-auto -right-2.5">
                                    <input type="checkbox" id="toggleInputType" class="inputTypeToggle peer/it" hidden>
                                    <i
                                        class="ri-eye-off-line text-gray-500 dark:text-dark-text peer-checked/it:before:content-['\ecb5']"></i>
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn b-solid btn-primary-solid w-full dk-theme-card-square mt-5">
                            Sign In
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('personal_access/js/vendor/jquery.min.js') }}"></script>
    <script src="{{ asset('personal_access/js/switcher.js') }}"></script>
    <script src="{{ asset('personal_access/js/layout.js') }}"></script>
    <script src="{{ asset('personal_access/js/main.js') }}"></script>
</body>

</html>
