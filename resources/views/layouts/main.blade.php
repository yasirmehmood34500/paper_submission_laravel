<!doctype html>
<html class="no-js" lang="en">

<head>
    @include('includes.css')
    @yield('css')
</head>

<body>
    <div class="main-wrapper">
        <div class="app" id="app">
            @include('includes.header')
            @include('includes.left-side')
            <div class="sidebar-overlay" id="sidebar-overlay"></div>
            <div class="sidebar-mobile-menu-handle" id="sidebar-mobile-menu-handle"></div>
            <div class="mobile-menu-handle"></div>
            <article class="content dashboard-page">
                @yield('content')
            </article>
            @include('includes.footer')
        </div>
    </div>
    @include('includes.primary-color')
    @include('includes.js')
    @yield('js')
</body>

</html>
