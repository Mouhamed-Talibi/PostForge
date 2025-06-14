@extends('layout.master')

@section('title')
    {{ $creator->creator_name }}
@endsection

@section('content')
    <div class="container py-4">
        <!-- Creator Profile Header -->
        <div class="row align-items-center mb-5">
            <div class="col-md-3 text-center mb-4 mb-md-0">
                <div class="creator-avatar mx-auto">
                    <img src="{{ asset('storage/' . $creator->image) }}" 
                            alt="{{ $creator->creator_name }}" 
                            class="img-fluid"
                            style="width: 180px; height: 180px; object-fit: cover;">
                </div>
            </div>
            <div class="col-md-9 mt-5">
                <div class="d-flex flex-column">
                    <h1 class="display-5 fw-bold mb-2">{{ $creator->creator_name }}</h1>
                    
                    <div class="d-flex gap-3 mb-3">
                        <span class="badge bg-primary">
                            <i class="fas fa-user me-1"></i> {{ ucfirst($creator->gender) }}
                        </span>
                        <span class="badge bg-secondary">
                            <i class="fas fa-birthday-cake me-1"></i> {{ $creator->age }} years
                        </span>
                        <span class="badge bg-success">
                            <i class="fas fa-pen-fancy me-1"></i> {{ $creatorPosts->count() }} posts
                        </span>
                    </div>
                    
                    <div class="creator-bio mb-4">
                        <p class="text-dark-50">{{ $creator->bio }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <hr class="my-5">
        
        <!-- Creator Posts Section -->
        <h2 class="mb-4 fw-bold">Latest Posts</h2>
        
        @if($creatorPosts->isEmpty())
            <div class="alert alert-info text-center py-4">
                <i class="fas fa-info-circle fa-2x mb-3"></i>
                <h4>No posts yet</h4>
                <p class="mb-0 text-dark">This creator hasn't published any posts.</p>
            </div>
        @else
            <div class="row g-4">
                @foreach($creatorPosts as $post)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm border-0 overflow-hidden">
                            @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" 
                                    class="card-img-top" 
                                    alt="{{ $post->title }}"
                                    style="height: 200px; object-fit: cover;">
                            @endif
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <span class="badge bg-light text-dark">{{ $post->created_at->diffForHumans() }}</span>
                                </div>
                                <h5 class="card-title">{{ Str::limit($post->title, 60) }}</h5>
                                <p class="card-text flex-grow-1">{{ Str::limit($post->content, 120) }}</p>
                                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-outline-dark align-self-start">
                                    Read More
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection