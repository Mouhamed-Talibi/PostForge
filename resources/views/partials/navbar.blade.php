<nav class="navbar navbar-expand-lg custom-navbar px-4 py-2">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand text-white fw-bold" href="">
            <img src="{{ asset('assets/logo.png') }}" alt="" class="img-fluid">
        </a>

        <!-- Toggler -->
        <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
        <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collapsible content -->
        <div class="collapse navbar-collapse justify-content-between" id="navbarContent">

            <!-- Centered Search -->
            <form class="d-flex mx-auto search-form" role="search">
                <input class="form-control me-2" type="search" placeholder="Search posts..." aria-label="Search">
                <button class="btn btn-primary" type="submit">Search</button>
            </form>

            <!-- Right-side links -->
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                {{-- shared links --}}
                <li class="nav-item"><a class="nav-link" href="#">Posts</a></li>

                {{-- guest links --}}
                @guest
                    <li class="nav-item"><a class="nav-link login" href="#">Login</a></li>
                    <li class="nav-item"><a class="nav-link register" href="#">Register</a></li>
                @endguest

                {{-- auth links --}}
                @auth
                    <li class="nav-item"><a class="nav-link" href="#">My Posts</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Create Post</a></li>
                    <li class="nav-item">
                        <form action="" method="POST" class="d-inline">
                            <button type="submit" class="btn logout">Logout <i class="fa-solid fa-right-from-bracket"></i> </button>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>