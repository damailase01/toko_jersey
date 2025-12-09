<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
  
    @stack('styles')
</head>
<body>
    @include('layouts.header')

    <main class="">
        @yield('content')
    </main>

    @include('layouts.footer')

    
    @stack('scripts')
</body>
</html>
