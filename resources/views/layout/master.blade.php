<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- fav icon --}}
    <link rel="icon" href="{{ asset('assets/logo.png') }}" type="image/png">

    {{-- title --}}
    <title>
        PostForge | @yield('title')
    </title>

    {{-- bootstrap link --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    {{-- font awesom --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    {{-- css link --}}
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
        {{-- including navbar --}}
        @include('partials.navbar')

        {{-- main content --}}
        <main class="container-fluid py-5 pb-5">
            @yield('content')
        </main>

        {{-- including footer --}}
        @include('partials.footer')
    </div>


    {{-- bootstrap js --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    {{-- loader js --}}
    <script src="{{ asset('js/loader.js') }}"></script>
    {{-- offcanvas close js --}}
    <script src="{{ asset('js/offcanvas_close.js') }}"></script>
</body>
</html>