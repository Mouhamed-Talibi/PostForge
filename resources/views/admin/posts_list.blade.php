@extends('layout.admin')

@section('title')
    Posts List
@endsection

@section('pageContent')
    <div class="container-fluid mt-4">
        <div class="row align-items-center mb-4">
            <div class="col-md-6">
                <h2 class="mb-0"><i class="fas fa-newspaper me-2"></i>Posts Management</h2>
            </div>
            <div class="col-md-6 text-md-end">
                <div class="dropdown d-inline-block me-2">
                    <button class="btn btn-dark dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        @switch($currentFilter)
                            @case('accepted')<i class="fas fa-check-circle text-success me-1"></i>@break
                            @case('pending')<i class="fas fa-clock text-warning me-1"></i>@break
                            @case('rejected')<i class="fas fa-times-circle text-danger me-1"></i>@break
                            @default<i class="fas fa-filter me-1"></i>
                        @endswitch
                        {{ $currentFilter ? ucfirst($currentFilter) : 'Filter By' }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="filterDropdown">
                        <li><a class="dropdown-item {{ !$currentFilter ? 'active' : '' }}" href="{{ route('admin.posts_list') }}"><i class="fas fa-list me-2"></i>All Posts</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item {{ $currentFilter === 'accepted' ? 'active' : '' }}" href="{{ route('admin.posts_list') }}?status=accepted"><i class="fas fa-check-circle text-success me-2"></i>Accepted</a></li>
                        <li><a class="dropdown-item {{ $currentFilter === 'pending' ? 'active' : '' }}" href="{{ route('admin.posts_list') }}?status=pending"><i class="fas fa-clock text-warning me-2"></i>Pending</a></li>
                        <li><a class="dropdown-item {{ $currentFilter === 'rejected' ? 'active' : '' }}" href="{{ route('admin.posts_list') }}?status=rejected"><i class="fas fa-times-circle text-danger me-2"></i>Rejected</a></li>
                    </ul>
                </div>
                <a href="{{ route('admin.new_post') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i>Add New</a>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="40px">#</th>
                                <th>Title</th>
                                <th>Creator</th>
                                <th>Category</th>
                                <th>Created At</th>
                                <th width="120px" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-2">
                                            <img src="{{ asset('storage/' . $post->image)}}" class="bg-light rounded-circle" style="width: 40px; height: 40px;"/>
                                        </div>
                                        <div class="flex-grow-1">
                                            <strong>{{ Str::limit($post->title, 20) }}</strong>
                                            <div class="text-muted small">{{ Str::limit($post->slug, 30) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $post->creator->creator_name }}</td>
                                <td><span class="badge bg-secondary">{{ $post->category->name }}</span></td>
                                <td>
                                    <span class="small text-muted" title="{{ $post->created_at->format('M d, Y h:i A') }}">
                                        {{ $post->created_at->diffForHumans() }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-1" style="min-width: 140px;">
                                        {{-- View Button --}}
                                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-outline-primary btn-action" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        
                                        @if($post->status === 'pending')
                                            {{-- Accept Button --}}
                                            <button type="button" class="btn btn-outline-success btn-action" 
                                                    title="Accept Post"
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#acceptPostModal"
                                                    data-post-id="{{ $post->id }}"
                                                    data-post-title="{{ $post->title }}"
                                                    data-action-url="{{ route('admin.posts.accept', $post->id) }}">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            
                                            {{-- Reject Button --}}
                                            <button type="button" class="btn btn-outline-danger btn-action" 
                                                    title="Reject Post"
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#rejectPostModal"
                                                    data-post-id="{{ $post->id }}"
                                                    data-post-title="{{ $post->title }}"
                                                    data-action-url="{{ route('admin.posts.reject', $post->id) }}">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        @else
                                            {{-- Edit Button --}}
                                            <a href="{{ route('admin.edit_post', $post->id) }}" class="btn btn-outline-success btn-action" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            
                                            {{-- Delete Button --}}
                                            <form action="{{ route('admin.delete_post', $post->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-action" title="Delete" onclick="return confirm('Are you sure?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                        <h5 class="text-muted">No posts found</h5>
                                        <p class="text-muted small">Try adjusting your filter criteria</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Accept Post Modal --}}
    <div class="modal fade" id="acceptPostModal" tabindex="-1" aria-labelledby="acceptPostModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="acceptPostModalLabel">Accept Post</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to accept this post?</p>
                    <p class="fw-bold" id="postTitleAccept"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="acceptPostForm" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success">Confirm Accept</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Reject Post Modal --}}
    <div class="modal fade" id="rejectPostModal" tabindex="-1" aria-labelledby="rejectPostModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="rejectPostModalLabel">Reject Post</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to reject this post?</p>
                    <p class="fw-bold" id="postTitleReject"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="rejectPostForm" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-danger">Confirm Reject</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    // Accept Post Modal Handler
    document.addEventListener('DOMContentLoaded', function() {
        const acceptPostModal = document.getElementById('acceptPostModal');
        acceptPostModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const postTitle = button.getAttribute('data-post-title');
            const actionUrl = button.getAttribute('data-action-url');
            
            document.getElementById('postTitleAccept').textContent = postTitle;
            document.getElementById('acceptPostForm').action = actionUrl;
        });

        // Reject Post Modal Handler
        const rejectPostModal = document.getElementById('rejectPostModal');
        rejectPostModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const postTitle = button.getAttribute('data-post-title');
            const actionUrl = button.getAttribute('data-action-url');
            
            document.getElementById('postTitleReject').textContent = postTitle;
            document.getElementById('rejectPostForm').action = actionUrl;
        });
    });
</script>