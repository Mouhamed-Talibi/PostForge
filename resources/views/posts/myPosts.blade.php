@extends('layout.master')

@section('title', 'My Posts')

@section('content')
    <div class="container py-5">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">My Posts</h5>
            </div>

            <!-- Table View (shown on medium+ screens) -->
            <div class="card-body p-0 d-none d-md-block">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th width="5%">ID</th>
                                <th width="25%">Title</th>
                                <th width="45%">Description</th>
                                <th width="10%">Status</th>
                                <th width="25%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($creatorPosts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ Str::limit($post->title, 30) }}</td>
                                <td>{{ Str::limit($post->description, 50) }}</td>
                                <td>
                                    @if($post->status == 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif($post->status == 'accepted')
                                        <span class="badge bg-success">Accepted</span>
                                    @elseif($post->status == 'rejected')
                                        <span class="badge bg-danger">Rejected</span>
                                    @else
                                        <span class="badge bg-secondary">{{ $post->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('posts.show', $post->id) }}" 
                                            class="btn btn-sm btn-outline-primary">
                                            View
                                        </a>
                                        <a href="{{ route('posts.edit', $post->id) }}" 
                                            class="btn btn-sm btn-outline-success">
                                            Edit
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deletePostModal{{ $post->id }}">
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Card View (shown on small screens) -->
            <div class="card-body d-md-none">
                @foreach ($creatorPosts as $post)
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="card-title mb-0">{{ Str::limit($post->title, 30) }}</h5>
                            <span>
                                @if($post->status == 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($post->status == 'accepted')
                                    <span class="badge bg-success">Accepted</span>
                                @elseif($post->status == 'rejected')
                                    <span class="badge bg-danger">Rejected</span>
                                @else
                                    <span class="badge bg-secondary">{{ $post->status }}</span>
                                @endif
                            </span>
                        </div>
                        <p class="card-text text-muted small">{{ Str::limit($post->description, 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted small">ID: {{ $post->id }}</span>
                            <div class="btn-group">
                                <a href="{{ route('posts.show', $post->id) }}" 
                                    class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('posts.edit', $post->id) }}" 
                                    class="btn btn-sm btn-outline-success">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-danger" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deletePostModal{{ $post->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modals - One for each post -->
    @foreach ($creatorPosts as $post)
    <div class="modal fade" id="deletePostModal{{ $post->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-light">
                    <h5 class="modal-title fs-4">Confirm Delete Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="fw-bold">Are you sure you want to delete this post? This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Confirm Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endsection