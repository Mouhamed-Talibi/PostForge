@extends('layout.master')

@section('title')
    {{ Str::limit($cachedPost->title, 20)}}
@endsection

@section('content')
<div class="container py-3">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <!-- Post Image -->
                @if($cachedPost->image)
                    <div class="post-image-container">
                        <img src="{{ asset('storage/' . $cachedPost->image) }}" 
                                alt="{{ $cachedPost->title }}" 
                                class="card-img-top img-fluid rounded-top">
                    </div>
                @endif

                <div class="card-body p-4 p-md-5">
                    <!-- Status Badge -->
                    <div class="mb-4">
                        @if($cachedPost->status == 'published')
                            <span class="badge bg-success">Published</span>
                        @else
                            <span class="badge bg-warning text-dark">Pending</span>
                        @endif
                    </div>

                    <!-- Title -->
                    <h1 class="card-title display-5 fw-bold mb-3">
                        {{ $cachedPost->title }}
                    </h1>

                    <!-- Meta Information -->
                    <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center mb-4 text-muted">
                        <div class="mb-2 mb-md-0">
                            <span class="me-3">
                                <i class="fas fa-folder me-1 text-primary"></i>
                                <span class="fw-medium">{{ $cachedPost->category->name ?? 'Uncategorized' }}</span>
                            </span>
                            <span>
                                <i class="fas fa-calendar-alt me-1 text-success"></i>
                                {{ $cachedPost->created_at->format('M d, Y') }}
                            </span>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="post-content mb-4">
                        {!! nl2br(e($cachedPost->description)) !!}
                    </div>

                    <!-- Back Button -->
                    <div class="mt-5">
                        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i> Back to Posts
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection