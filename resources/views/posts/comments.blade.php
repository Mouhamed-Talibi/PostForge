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
                        <div class="comments mt-3">
                            <h3>Comments</h3>
                            <hr class="w-25 text-primary">

                            {{-- Comment form --}}
                            <form action="{{ route('comments.store', $post) }}" method="POST">
                                @csrf

                                <div class="mt-3 w-50">
                                    <div class="form-group mb-2">
                                        <input type="text" name="content" id="" value="{{ old('content')}}" class="form-control" placeholder="Write your comment here..." required>
                                        @error('content')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-outline-primary">Comment</button>
                                </div>
                            </form>

                            {{-- available comments --}}
                            <div class="creators-comments w-50">
                                @if ($post->comments->count() == 0)
                                    <p class="text-secondary mt-3">There No available comments yet. be the first one who share his thoughts..</p>
                                @endif

                                {{-- displaying comments --}}
                                @foreach ($post->comments as $comment)
                                    <div class="comment p-2 mt-2">
                                        <img src="{{ asset('storage/' . $comment->creator->image )}}" style="height: 40px; width:40px" alt="" class="img-fluid rounded-circle">
                                            <h5 class="text-dark-50 d-inline mx-2">{{ $comment->creator->creator_name }}</h5>
                                        <small class="text-seconary d-block mx-5">{{  $comment->content }}</small>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection