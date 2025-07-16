<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>
        @yield('title')
    </title>
    <meta name="description" content="" />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/login/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/login/core.css') }}"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('css/login/theme-default.css') }}"
        class="template-customizer-theme-css" />
        <link rel="stylesheet" href="{{ asset('css/login/page-auth.css') }}" />
</head>

<body>

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">

                @yield('content')

            </div>
        </div>
    </div>

</body>

</html>
