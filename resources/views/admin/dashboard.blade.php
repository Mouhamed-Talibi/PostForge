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
                <nav class="navbar navbar-expand-lg top-navbar mb-4">
                    <div class="container-fluid">
                        <button class="btn btn-link d-md-none" id="sidebarToggle">
                            <i class="bi bi-list"></i>
                        </button>
                        
                        <div class="d-flex ms-auto align-items-center">
                            <div class="dropdown">
                                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="https://via.placeholder.com/40" alt="Profile" class="rounded-circle me-2">
                                    <span>Admin User</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                                    <li><a class="dropdown-item" href="#">Profile</a></li>
                                    <li><a class="dropdown-item" href="#">Settings</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#">Sign out</a></li>
                                </ul>
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
                                        <div>
                                            <h6 class="text-muted">Total Users</h6>
                                            <h3>1,254</h3>
                                            <span class="badge bg-success">+12%</span>
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
                                        <div>
                                            <h6 class="text-muted">Total Revenue</h6>
                                            <h3>$24,780</h3>
                                            <span class="badge bg-success">+8%</span>
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
                                        <div>
                                            <h6 class="text-muted">Pending Orders</h6>
                                            <h3>56</h3>
                                            <span class="badge bg-warning">-2%</span>
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
                                        <div>
                                            <h6 class="text-muted">Active Products</h6>
                                            <h3>342</h3>
                                            <span class="badge bg-success">+5%</span>
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