@extends('layout.admin')

@section('title')
    Admin Dashbaord
@endsection

@section('pageContent')
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
            {{-- quick actions --}}
            <div class="col-lg-6">
                <div class="card border border-1 shadow">
                    <div class="card-header">
                        <h5>Quick Actions</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item border-0 px-0">
                                <div class="d-flex">
                                    <div class="me-3">
                                        <span class="bg-success bg-opacity-50 text-dark px-2 py-2 rounded-circle">
                                            <i class="fa-solid fa-user-plus"></i>
                                        </span>
                                        <a href="{{ route('admin.new_creator')}}" class="btn ms-3">New Creator</a>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item border-0 px-0">
                                <div class="d-flex">
                                    <div class="me-3">
                                        <span class="bg-secondary bg-opacity-75 text-white p-2 rounded-circle">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <a href="{{ route('admin.categories_list')}}" class="btn ms-3">Manage Categories</a>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item border-0 px-0">
                                <div class="d-flex">
                                    <div class="me-3">
                                        <span class="bg-info bg-opacity-75 text-white p-2 rounded-circle">
                                            <i class="fa-solid fa-file text-dark"></i>
                                        </span>
                                        <a href="{{ route('admin.posts_list')}}" class="btn ms-3">Manage Posts</a>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item border-0 px-0">
                                <div class="d-flex">
                                    <div class="me-3">
                                        <span class="bg-success bg-opacity-25 text-white p-2 rounded-circle">
                                            <i class="fa-solid fa-circle-user text-dark"></i>
                                        </span>
                                        <a href="{{ route('admin.creators_list')}}" class="btn ms-3">Manage Creators</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            {{-- recent activity --}}
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Recent Activities</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item border-0 px-0">
                                <div class="d-flex">
                                    <div class="me-3">
                                        <span class="bg-primary bg-opacity-10 text-primary p-2 rounded-circle">
                                            <i class="fa-solid fa-plus"></i>
                                        </span>
                                    </div>
                                    @if (!empty($newPost))
                                        <div>
                                            <h6 class="mb-1">New Post | <span class="fw-bold text-primary">{{ Str::limit($newPost->title ?? '', 30) }}</span></h6>
                                            <p class="mb-0 text-muted small">{{ $newPost->created_at->diffForHumans() }}</p>
                                        </div>
                                    @endif
                                </div>
                            </li>
                            <li class="list-group-item border-0 px-0">
                                <div class="d-flex">
                                    <div class="me-3">
                                        <span class="bg-primary bg-opacity-10 text-primary p-2 rounded-circle">
                                            <i class="fa-solid fa-address-card"></i>
                                        </span>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">New creator registered | <span class="text-primary fw-bold">{{ $newCreator->creator_name }}</span></h6>
                                        <p class="mb-0 text-muted small">{{ $newCreator->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item border-0 px-0">
                                <div class="d-flex">
                                    <div class="me-3">
                                        <span class="bg-primary bg-opacity-10 text-primary p-2 rounded-circle">
                                            <i class="fa-solid fa-file-pen"></i>
                                        </span>
                                    </div>
                                    @if (!empty($lastUpdatedPost))
                                        <div>
                                            <h6 class="mb-1">Last Post updated <span class="text-primary fw-bold">#{{ $lastUpdatedPost->id }}</span></h6>
                                            <p class="mb-0 text-muted small">{{ $lastUpdatedPost->updated_at->diffForHumans() }}</p>
                                        </div>
                                    @endif
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection