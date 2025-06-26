<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('assets/logo.png') }}" type="image/png">

    <title>PostForge | @yield('title')</title>

    {{-- CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/master.css') }}">
</head>
<body>
    {{-- loader --}}
    <div id="loader" class="loader-container">
        <div class="loader"></div>
        <p>Loading PostForge, Please Wait..</p>
    </div>

    {{-- content site --}}
    <div id="content">
        <x-flash-messages />
        @include('partials.navbar')

        <main class="container-fluid py-5 pb-5">
            @yield('content')
        </main>

        @include('partials.footer')
    </div>

    {{-- JavaScript --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    
    {{-- Custom scripts --}}
    <script src="{{ asset('js/loader.js') }}"></script>
    <script src="{{ asset('js/offcanvas_close.js') }}"></script>
    <script src="{{ asset('js/likes.js') }}"></script>
    
    {{-- No custom modal script needed - let Bootstrap handle it --}}

    @stack('scripts')
</body>
</html>