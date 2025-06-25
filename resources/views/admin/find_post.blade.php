@extends('layout.admin')

@section('title')
    Find Post 
@endsection

@section('pageContent')
    <div class="container">
        <h1 class="text-center">Find Any Post easily</h1>
        <hr class="w-25 mx-auto">

        <form action="{{ route('admin.query_post')}}" method="POST" class="text-center w-50 mx-auto mt-5">
            @method('POST')
            @csrf

            <input type="text" name="query" id="" class="form-control" placeholder="Post title or description here">
            @error('query')
                <p class="text-danger mt-1">{{ $message }}</p>
            @enderror
            <button type="submit" class="btn btn-primary mt-2">
                Find Post 
            </button>
        </form>

        <div class="mt-5">
            @if (!empty($post))
                <div class="post">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="card shadow-sm border-0">
                                <!-- Post Image -->
                                @if($post->image)
                                    <div class="post-image-container">
                                        <img src="{{ asset('storage/' . $post->image) }}" 
                                                alt="{{ $post->title }}" 
                                                class="card-img-top img-fluid rounded-top">
                                    </div>
                                @endif

                                <div class="card-body p-4 p-md-5">
                                    <!-- Title -->
                                    <h1 class="card-title display-5 fw-bold mb-3">
                                        {{ $post->title }}
                                    </h1>

                                    <!-- Meta Information -->
                                    <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center mb-4 text-muted">
                                        <div class="mb-2 mb-md-0">
                                            <span class="me-3">
                                                <i class="fas fa-folder me-1 text-primary"></i>
                                                <span class="fw-medium">{{ $post->category->name ?? 'Uncategorized' }}</span>
                                            </span>
                                            <span>
                                                <i class="fas fa-calendar-alt me-1 text-success"></i>
                                                {{ $post->created_at->format('M d, Y') }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Description -->
                                    <div class="post-content mb-4">
                                        {!! nl2br(e($post->description)) !!}
                                    </div>

                                    <!-- Back Button -->
                                    <div class="mt-5">
                                        <a href="{{ route('admin.posts_list') }}" class="btn btn-outline-secondary">
                                            <i class="fas fa-arrow-left me-2"></i> Back to Posts
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else 
                <div class="alert alert-info" role="alert">
                    <p class="text-center">There is no post found with the keywords you write !</p>
                </div>
            @endif
        </div>
    </div>
@endsection