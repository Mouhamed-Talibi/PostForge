<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- csrf-token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
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
        <!-- Flash messages component -->
        <x-flash-messages />

        {{-- main content --}}
        <div class="wrapper d-flex">
            <!-- Sidebar -->
            <aside class="sidebar col-md-3 col-lg-2 d-md-block">
                <div class="sidebar-header">
                    <h4>PostForge</h4>
                    <hr class="text-primary">
                </div>
                <ul class="nav flex-column px-3">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('admin.dashboard')}}">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="creatorsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-people"></i> Creators
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="creatorsDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.new_creator') }}">
                                    <i class="bi bi-person-plus me-2"></i> New Creator
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.creators_list') }}">
                                    <i class="bi bi-list-ul me-2"></i> Creators List
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="categoriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-people"></i> Categories
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="categoriesDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.new_category') }}">
                                    <i class="bi bi-person-plus me-2"></i> New Category
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.categories_list') }}">
                                    <i class="bi bi-list-ul me-2"></i> Catgeories List
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-cart"></i> Posts
                        </a>
                    </li>
                </ul>
            </aside>

            <!-- Main Content -->
            <div class="main-content w-100">
                <!-- Top Navbar -->
                <nav class="navbar navbar-expand-lg top-navbar mb-4 shadow-none">
                    <div class="container-fluid">
                        <button class="btn btn-link d-md-none" id="sidebarToggle">
                            <i class="fa-solid fa-list text-dark fs-4"></i>
                        </button>

                        <div class="d-flex ms-auto align-items-center">
                            <div class="dropdown">
                                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span>
                                        <img src="{{ asset('storage/' . auth('creator')->user()->image) }}" alt="" class="img-fluid rounded-circle"
                                            style="width: 50px; height: 50px; object-fit: cover;">
                                    </span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                                    <li><a class="dropdown-item" href="#">Profile</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                                        </button>
                                    </li>
                                </ul>
                            </div>
                            <!-- Logout Modal -->
                            <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-dark text-light px-5">
                                            <h5 class="modal-title" id="logoutModalLabel">Confirm Logout</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body py-5 px-4">
                                            <p class="fw-bold">Are you sure you want to log out?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                                            <!-- Actual Logout Form -->
                                            <form action="{{ route('auth.logout') }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                                    Logout <i class="fa-solid fa-right-from-bracket"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>

                {{-- page content --}}
                @yield('pageContent')

            </div>
            <!-- Overlay for mobile sidebar -->
            <div class="overlay"></div>
        </div>
    </div>


    @stack('scripts')


    {{-- bootstrap js --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    {{-- loader js --}}
    <script src="{{ asset('js/loader.js') }}"></script>
    {{-- offcanvas close js --}}
    <script src="{{ asset('js/offcanvas_close.js') }}"></script>
    {{-- likes js --}}
    <script src="{{ asset('js/likes.js') }}"></script>
    {{-- sidebar js --}}
    <script src="{{ asset('js/sidebar.js')}}"></script>
</body>
</html>