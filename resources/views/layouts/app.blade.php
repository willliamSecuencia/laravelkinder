<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.partials.head')
</head>
<body>
    <div id="app">
        <div id="wrapper">
            @include('layouts.partials.nav')
            <div class="d-flex flex-column" id="content-wrapper">
                <div class="content">
                    @include('layouts.partials.navtop')
                    <div class="container-fluid">
                        <main class="py-4">
                                @yield('content')
                        </main>
                    </div>
                </div>
                @include('layouts.partials.footer')
                @include('layouts.partials.bottontop')
            </div>
        </div>
        @include('layouts.partials.returntop')
    </div>
</body>
</html>
