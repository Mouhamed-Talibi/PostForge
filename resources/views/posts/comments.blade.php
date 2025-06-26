@extends('layout.master')

    @section('title')
        Comments
    @endsection

    @section('content')
        {{-- {{ dd($post )}} --}}


        <div class="container py-3 pb-5">
            <div class="row jutsify-content-center align-items-center">
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

                        {{-- comments --}}
                        <div class="comments mt-4">
                            <h3 class="mb-3">Comments</h3>
                            <hr class="w-25 text-primary">

                            {{-- Comment form --}}
                            <form action="{{ route('comments.store', $post) }}" method="POST" class="mb-4">
                                @csrf
                                <div class="w-100 w-lg-50">
                                    <div class="form-group mb-2">
                                        <input type="text" name="content" value="{{ old('content') }}" class="form-control" placeholder="Write your comment here..." required>
                                        @error('content')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-outline-primary">Comment</button>
                                </div>
                            </form>

                            {{-- Available comments --}}
                            <div class="creators-comments w-100 w-lg-50">
                                @if ($post->comments->count() == 0)
                                    <p class="text-secondary">There are no comments yet. Be the first to share your thoughts.</p>
                                @endif

                                {{-- Displaying comments --}}
                                @foreach ($post->comments as $comment)
                                    <div class="comment d-flex align-items-start gap-2 p-3 mb-2 bg-light rounded shadow-sm position-relative">
                                        <!-- User Image -->
                                        @if($comment->creator && $comment->creator->image)
                                            <img src="{{ asset('storage/' . $comment->creator->image) }}" 
                                                alt="creator photo" 
                                                style="height: 40px; width: 40px; object-fit: cover;" 
                                                class="rounded-circle">
                                        @else
                                            <div class="rounded-circle bg-secondary" style="height: 40px; width: 40px;"></div>
                                        @endif

                                        <!-- Content -->
                                        <div style="flex: 1;">
                                            <h6 class="mb-1 text-dark">{{ $comment->creator->creator_name ?? 'Anonymous' }}</h6>

                                            {{-- Inline Edit Section --}}
                                            @if(request('edit') == $comment->id)
                                                <!-- Edit Form -->
                                                <form action="{{ route('comments.update', $comment->id) }}" method="POST" class="mb-2">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="text" name="content" class="form-control mb-2" value="{{ old('comment', $comment->content) }}" required>
                                                    <div>
                                                        <button type="submit" class="btn btn-sm btn-success">Save</button>
                                                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-sm btn-secondary">Cancel</a>
                                                    </div>
                                                    @error('comment')
                                                        <p class="text-danger fw-bold">{{ $message }}</p>
                                                    @enderror
                                                </form>
                                            @else
                                                <!-- Static Content -->
                                                <p class="mb-1 text-muted">{{ $comment->content }}</p>
                                                <small class="text-secondary">{{ $comment->created_at->diffForHumans() }}</small>
                                            @endif
                                        </div>

                                        <!-- Actions -->
                                        @can('update', $comment)
                                            <div class="dropdown position-absolute top-0 end-0 m-2">
                                                <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown">
                                                    <i class="fas fa-ellipsis-h"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="{{ url()->current() }}?edit={{ $comment->id }}">Edit</a>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure you want to delete this comment?')">Delete</button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        @endcan
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endsection