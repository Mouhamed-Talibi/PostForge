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
                                    <div class="comment d-flex align-items-start gap-2 p-3 mb-2 bg-light rounded shadow-sm">
                                        <img src="{{ asset('storage/' . $comment->creator->image) }}" 
                                            alt="creator photo" 
                                            style="height: 40px; width: 40px; object-fit: cover;" 
                                            class="rounded-circle">

                                        <div>
                                            <h6 class="mb-1 text-dark">{{ $comment->creator->creator_name }}</h6>
                                            <p class="mb-1 text-muted">{{ $comment->content }}</p>
                                            <small class="text-secondary">{{ $comment->created_at->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endsection