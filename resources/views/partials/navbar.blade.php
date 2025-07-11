<nav class="navbar navbar-expand-lg custom-navbar px-4 py-2">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand text-white fw-bold" href="{{ route('home') }}">
            <img src="{{ asset('assets/logo.png') }}" alt="" class="img-fluid">
        </a>

        <!-- Toggler -->
        <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
        <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collapsible content -->
        <div class="collapse navbar-collapse justify-content-between" id="navbarContent">

            <!-- Centered Search -->
            @can('search', auth('creator')->user())
                <form class="d-flex mx-auto search-form" role="search" method="POST" action="{{ route('posts.search')}}">
                    @method('POST')
                    @csrf 

                    <input class="form-control me-2" type="search" placeholder="Search posts..." aria-label="Search" name="title">
                    <button class="btn btn-primary" type="submit">Search</button>
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </form>
            @endcan

            <!-- Right-side links -->
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">                
                {{-- guest links --}}
                @guest
                    <li class="nav-item"><a class="nav-link login" href="{{ route('auth.loginForm') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link register" href="{{ route('auth.regsitrationForm') }}">Register</a></li>
                @endguest

                {{-- auth links --}}
                @auth
                    <li class="nav-item"><a class="nav-link" href="{{ route('posts.index') }}">Posts</a></li>
                    <li class="nav-item"><a class="nav-link me-2" href="{{ route('creators.index')}}">Creators</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('posts.myposts') }}">My Posts</a></li>
                    <li class="nav-item"><a class="nav-link me-3" href="{{ route('posts.create')}}">Create Post</a></li>
                    <li class="nav-item dropdown">
                        <!-- Profile Image Dropdown -->
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('storage/' . auth('creator')->user()->image) }}" 
                                class="rounded-circle" 
                                width="40" 
                                height="40" 
                                style="object-fit: cover;"
                                alt="Profile Image">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('creators.show', auth('creator')->id()) }}"><i class="fas fa-user me-2"></i> Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                                </button>
                            </li>
                        </ul>
                    </li>

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
                @endauth
            </ul>
        </div>
    </div>
</nav>