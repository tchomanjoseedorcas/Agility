<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">

    <title> Agility</title>
    <meta content="Page de Connexion AIBEF ADMIN" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicons -->

    @include('pages.layouts.header')
</head>

<body>

    <!-- ======= Header ======= -->
    @include('pages.partials.navigation')

    <!-- ======= Sidebar ======= -->
    @include('pages.partials.sidebar')


    <main id="main" class="main">

        @yield('content')

    </main>

    @include('pages.partials.footer')

    <!-- ======= Footer ======= -->
    @include('pages.layouts.footer')

</body>

</html>
