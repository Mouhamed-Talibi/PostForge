@extends('layout.master')

    {{-- title --}}
    @section('title')
        Posts
    @endsection

    {{-- content --}}
    @section('content')
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <!-- Create Post Card (Facebook-style "What's on your mind") -->
                    @auth('creator')
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ auth('creator')->user()->image ? asset('storage/'.auth('creator')->user()->image) : asset('images/default-avatar.png') }}" 
                                    class="rounded-circle me-3" 
                                    width="50" 
                                    height="50">
                                <button class="btn btn-light flex-grow-1 text-start post-create-btn" 
                                        onclick="window.location.href='{{ route('posts.create') }}'">
                                    What's on your mind?
                                </button>
                            </div>
                            <div class="d-flex justify-content-between border-top pt-3">
                                <a href="{{ route('posts.create')}}" class="btn btn-sm btn-outline-secondary flex-grow-1 mx-1">
                                    <i class="fas fa-image text-primary me-2"></i> Photo
                                </a href="{{ route('posts.create')}}">
                                <a href="{{ route('posts.create')}}" class="btn btn-sm btn-outline-secondary flex-grow-1 mx-1">
                                    <i class="fas fa-video text-danger me-2"></i> Video
                                </a href="{{ route('posts.create')}}">
                                <a href="{{ route('posts.create')}}" class="btn btn-sm btn-outline-secondary flex-grow-1 mx-1">
                                    <i class="fas fa-smile text-warning me-2"></i> Feeling
                                </a href="{{ route('posts.create')}}">
                            </div>
                        </div>
                    </div>
                    @endauth

                    <!-- Posts Feed -->
                    @foreach($acceptedPosts as $post)
                    <div class="card mb-4 shadow-sm">
                        <!-- Post Header -->
                        <div class="card-header bg-white d-flex align-items-center">
                            <img src="{{ $post->creator->image ? asset('storage/'.$post->creator->image) : asset('assets/default-image.png') }}" 
                                class="rounded-circle me-3" 
                                width="40" 
                                height="40">
                            <div>
                                <h6 class="mb-0">{{ $post->creator->creator_name }}</h6>
                                <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                            </div>
                            <div class="ms-auto dropdown">
                                <button class="btn btn-sm btn-link text-muted dropdown-toggle" 
                                        type="button" 
                                        id="postDropdown{{ $post->id }}" 
                                        data-bs-toggle="dropdown" 
                                        aria-expanded="false">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="postDropdown{{ $post->id }}">
                                    @can('update', $post)
                                    <li>
                                        <a class="dropdown-item" href="{{ route('posts.edit', $post->id) }}">
                                            <i class="fas fa-edit me-2"></i> Edit
                                        </a>
                                    </li>
                                    @endcan
                                    
                                    @can('delete', $post)
                                    <li>
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger" 
                                                    onclick="return confirm('Are you sure you want to delete this post?')">
                                                <i class="fas fa-trash-alt me-2"></i> Delete
                                            </button>
                                        </form>
                                    </li>
                                    @endcan
                                    
                                    <!-- Additional options can be added here -->
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-bookmark me-2"></i> Save</a></li>
                                </ul>
</div>
                        </div>

                        <!-- Post Body -->
                        <div class="card-body">
                            <h3 class="text-dark mb-3 mt-2"><span class="text-primary">{{ Str::substr(Str::upper($post->title), 0, 10) }}</span>{{ Str::substr(Str::lower($post->title), 10) }}</h3>
                            <p class="card-text">{{ $post->description }}</p>
                            
                            @if($post->image)
                            <div class="post-image mb-3">
                                <img src="{{ asset('storage/'.$post->image) }}" 
                                    class="img-fluid rounded-4" 
                                    alt="{{ $post->title }}">
                            </div>
                            @endif
                            
                            <div class="d-flex justify-content-between text-muted mb-3">
                                <div>
                                    <span class="me-3"><i class="fas fa-thumbs-up text-primary"></i> {{ $post->likes_count ?? 0 }}</span>
                                    <span><i class="fas fa-comment"></i> {{ $post->comments_count ?? 0 }}</span>
                                </div>
                                <div>
                                    <span class="badge bg-primary">{{ $post->category->name }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Post Footer (Actions) -->
                        <div class="card-footer bg-white">
                            <div class="d-flex justify-content-between">
                                <button class="btn btn-sm btn-outline-secondary flex-grow-1 mx-1 like-btn">
                                    <i class="fas fa-thumbs-up me-2"></i> Like
                                </button>
                                <button class="btn btn-sm btn-outline-secondary flex-grow-1 mx-1 comment-btn">
                                    <i class="fas fa-comment me-2"></i> Comment
                                </button>
                                <button class="btn btn-sm btn-outline-secondary flex-grow-1 mx-1 share-btn">
                                    <i class="fas fa-share me-2"></i> Share
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $acceptedPosts->links() }}
                    </div>
                </div>
            </div>
        </div>
        @endsection