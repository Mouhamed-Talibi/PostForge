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
                    <!-- Check founded results -->
                    <h1 class="text-center display-5 fw-bold mb-3">Search <span class="text-primary">Results</span></h1>
                    <p class="text-muted text-center mb-5">Here are the posts matching your search</p>

                    <!-- Posts Feed -->
                    @foreach($relatedPosts as $post)
                    <div class="card mb-4 shadow-sm">
                        <!-- Post Header -->
                        <div class="card-header bg-white d-flex align-items-center">
                            <img src="{{ $post->creator->image ? asset('storage/'.$post->creator->image) : asset('assets/default-image.png') }}" 
                                class="rounded-circle me-3" 
                                width="50" 
                                style="object-fit:cover;"
                                height="50">
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
                            <h3 class="text-dark text-center mb-3 mt-2">{{ $post->title }}</h3>
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
                                    <span class="me-3"><i class="fas fa-thumbs-up text-primary"></i> {{ $post->likers->count() ?? 0 }}</span>
                                    <span><i class="fas fa-comment"></i> {{ $post->comments->count() ?? 0 }}</span>
                                </div>
                                <div>
                                    <span class="badge bg-primary">{{ $post->category->name }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Post Footer (Actions) -->
                        <div class="card-footer bg-white">
                            <div class="d-flex justify-content-between">
                                {{-- like button --}}
                                <button class="btn btn-sm flex-grow-1 mx-1 like-btn 
                                    {{ auth('creator')->check() && $post->likers->contains(auth('creator')->id()) ? 'btn-primary' : 'btn-outline-secondary' }}" 
                                    data-post-id="{{ $post->id }}">
                                    
                                    <i class="fas fa-thumbs-up me-2"></i>
                                    <span class="like-text">
                                        {{ auth('creator')->check() && $post->likers->contains(auth('creator')->id()) ? 'Liked' : 'Like' }}
                                    </span>
                                </button>
                                {{-- comment button --}}
                                <a href="{{ route('comments.view', $post) }}" class="btn btn-sm btn-outline-secondary flex-grow-1 mx-1 comment-btn">
                                    <i class="fas fa-comment me-2"></i> Comment
                                </a>
                                <button class="btn btn-sm btn-outline-secondary flex-grow-1 mx-1 share-btn">
                                    <i class="fas fa-share me-2"></i> Share
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $relatedPosts->links() }}
                    </div>
                </div>
            </div>
        </div>
        @endsection