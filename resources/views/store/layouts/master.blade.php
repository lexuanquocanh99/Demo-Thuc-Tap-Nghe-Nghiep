<!DOCTYPE html>
<html lang="zxx">
<head>
    @include('store.layouts.head')
</head>
<body class="js">

<!-- Preloader -->
<div class="preloader">
    <div class="preloader-inner">
        <div class="preloader-icon">
            <span></span>
            <span></span>
        </div>
    </div>
</div>
<!-- End Preloader -->

@include('store.layouts.notification')
<!-- Header -->
@include('store.layouts.header')
<!--/ End Header -->
@yield('main-content')

@include('store.layouts.footer')

</body>
</html>
