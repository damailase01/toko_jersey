<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>

    @stack('styles')
</head>
@if(auth()->check())
    <body>
        <div class="d-flex">
            <!-- Sidebar -->
            @include('layouts.admin.sidebar')

            <!-- Content -->
            <div class="content flex-grow-1">
                @yield('content')
            </div>
        </div>

        <!-- Tambahkan script di sini -->
        @stack('scripts')
    </body>
@else
    <script>window.location = "{{ route('login') }}";</script>
@endif
</html>
