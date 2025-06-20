@extends('layout.admin')

    @section('title','Dashboard')

    @section('content')
        <div class="wrapper d-flex">
            <!-- Sidebar -->
            <aside class="sidebar col-md-3 col-lg-2 d-md-block">
                <div class="sidebar-header">
                    <h4>Admin Dashboard</h4>
                </div>
                <ul class="nav flex-column px-3">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-people"></i> Users
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-box-seam"></i> Categories
                        </a>
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
                <nav class="navbar navbar-expand-lg top-navbar mb-4 rounded shadow-none">
                    <div class="container-fluid">
                        <button class="btn btn-link d-md-none" id="sidebarToggle">
                            <i class="bi bi-list"></i>
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
                
                <!-- Page Content -->
                <div class="container-fluid">
                    <h4 class="mb-4">Dashboard Overview</h4>
                    
                    <!-- Stats Cards -->
                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="metric-card">
                                            <i class="fa-solid fa-users fs-4 text-info"></i>
                                            <h6 class="text-muted d-inline ms-3">Total Creators</h6>
                                            <h3 class="mt-3">{{ number_format($totalCreators) }}</h3>
                                            <span class="badge bg-{{ $creatorsGrowth >= 0 ? 'success' : 'danger' }}">
                                                {{ $creatorsGrowth >= 0 ? '+' : '' }}{{ number_format($creatorsGrowth, 1) }}%
                                                <i class="bi bi-arrow-{{ $creatorsGrowth >= 0 ? 'up' : 'down' }}"></i>
                                            </span>
                                        </div>
                                        <div class="bg-primary-blue bg-opacity-10 p-3 rounded">
                                            <i class="bi bi-people fs-4 text-primary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="metric-card">
                                            <i class="fa-solid fa-newspaper fs-4 text-info"></i>
                                            <h6 class="text-muted d-inline ms-3">Total Posts</h6>
                                            <h3 class="mt-3">{{ number_format($totalPosts) }}</h3>
                                            <span class="badge bg-{{ $postsGrowth >= 0 ? 'success' : 'danger' }}">
                                                {{ $postsGrowth >= 0 ? '+' : '' }}{{ number_format($postsGrowth, 1) }}%
                                                <i class="bi bi-arrow-{{ $postsGrowth >= 0 ? 'up' : 'down' }}"></i>
                                            </span>
                                        </div>
                                        <div class="bg-primary-blue bg-opacity-10 p-3 rounded">
                                            <i class="bi bi-currency-dollar fs-4 text-primary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="metric-card">
                                            <i class="fa-solid fa-clock fs-4 text-warning"></i>
                                            <h6 class="text-muted d-inline ms-3">Pending Posts</h6>
                                            <h3 class="mt-4">{{ number_format($pendingPosts) }}</h3>
                                        </div>
                                        <div class="bg-primary-blue bg-opacity-10 p-3 rounded">
                                            <i class="bi bi-cart fs-4 text-primary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="metric-card">
                                            <i class="fa-solid fa-circle-check fs-4 text-success"></i>
                                            <h6 class="text-muted d-inline ms-3">Accepted Posts</h6>
                                            <h3 class="mt-4">{{ number_format($acceptedPosts) }}</h3>
                                        </div>
                                        <div class="bg-primary-blue bg-opacity-10 p-3 rounded">
                                            <i class="bi bi-box-seam fs-4 text-primary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Charts and Tables -->
                    <div class="row mt-4">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Sales Overview</h5>
                                </div>
                                <div class="card-body">
                                    <div style="height: 300px;">
                                        <!-- Chart would go here -->
                                        <div class="d-flex justify-content-center align-items-center h-100 text-muted">
                                            [Sales Chart Placeholder]
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Recent Activity</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item border-0 px-0">
                                            <div class="d-flex">
                                                <div class="me-3">
                                                    <span class="bg-primary bg-opacity-10 text-primary p-2 rounded-circle">
                                                        <i class="bi bi-cart"></i>
                                                    </span>
                                                </div>
                                                <div>
                                                    <h6 class="mb-1">New order #1234</h6>
                                                    <p class="mb-0 text-muted small">2 min ago</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item border-0 px-0">
                                            <div class="d-flex">
                                                <div class="me-3">
                                                    <span class="bg-primary bg-opacity-10 text-primary p-2 rounded-circle">
                                                        <i class="bi bi-person-plus"></i>
                                                    </span>
                                                </div>
                                                <div>
                                                    <h6 class="mb-1">New user registered</h6>
                                                    <p class="mb-0 text-muted small">1 hour ago</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item border-0 px-0">
                                            <div class="d-flex">
                                                <div class="me-3">
                                                    <span class="bg-primary bg-opacity-10 text-primary p-2 rounded-circle">
                                                        <i class="bi bi-box-seam"></i>
                                                    </span>
                                                </div>
                                                <div>
                                                    <h6 class="mb-1">Product #456 updated</h6>
                                                    <p class="mb-0 text-muted small">3 hours ago</p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Overlay for mobile sidebar -->
            <div class="overlay"></div>
        </div>
    @endsection

    <script>
        // Toggle sidebar on mobile
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
            document.querySelector('.overlay').classList.toggle('active');
        });
        
        // Close sidebar when clicking overlay
        document.querySelector('.overlay').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.remove('active');
            this.classList.remove('active');
        });
    </script>