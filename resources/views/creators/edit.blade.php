@extends('layout.master')

@section('title')
    My Personal Data
@endsection

@section('content')
    <div class="container py-3 pb-5">
        <div class="row justify-content-center align-items-center p-3">
            <div class="col-md-8 col-lg-10">
                <!-- Header Section -->
                <div class="text-center mb-5">
                    <h1 class="fw-bold">
                        Your personal<span class="text-primary"> data</span>
                    </h1>
                    <p class="text-dark-50">
                        <span class="text-primary">Change & modify</span> your personal data anytime
                    </p>
                </div>

                <!-- Data Display Card -->
                <div class="card shadow-sm border-2">
                    <div class="card-body p-4">
                        <!-- Email -->
                        <div class="data-item mb-4 p-3 bg-light rounded">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong class="d-block text-primary small">EMAIL</strong>
                                    <p class="mb-0">{{ $creator->email }}</p>
                                </div>
                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#changeEmailModal">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Bio -->
                        <div class="data-item mb-4 p-3 bg-light rounded">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong class="d-block text-primary small">Biio</strong>
                                    <p class="mb-0">{{ $creator->bio }}</p>
                                </div>
                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#changeBioModal">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Creator Name -->
                        <div class="data-item mb-4 p-3 bg-light rounded">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong class="d-block text-primary small">NAME</strong>
                                    <p class="mb-0">{{ $creator->creator_name }}</p>
                                </div>
                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#changeNameModal">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Age -->
                        <div class="data-item mb-4 p-3 bg-light rounded">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong class="d-block text-primary small">AGE</strong>
                                    <p class="mb-0">{{ $creator->age }} years</p>
                                </div>
                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#changeAgeModal">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Total Posts -->
                        <div class="data-item mb-4 p-3 bg-light rounded">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong class="d-block text-primary small">TOTAL POSTS</strong>
                                    <p class="mb-0">{{ $totalPosts }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Account Created -->
                        <div class="data-item p-3 bg-light rounded">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong class="d-block text-primary small">MEMBER SINCE</strong>
                                    <p class="mb-0">{{ $creator->created_at->format('F j, Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Email Modal -->
    <div class="modal fade" id="changeEmailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Change Email Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('creator.update_email', $creator)}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Current Email</label>
                            <input type="email" class="form-control" value="{{ $creator->email }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="new_email" class="form-label fw-bold badge bg-info">New Email Address</label>
                            <input type="email" class="form-control" id="new_email" name="email" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Email</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- edit Bio Modal --}}
    <div class="modal fade" id="changeBioModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Change Bio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Current Bio</label>
                            <textarea name="bio" id="" class="form-control" readonly>{{ $creator->bio }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="new_email" class="form-label fw-bold badge bg-info">New Bio</label>
                            <textarea name="new_bio" id="" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Bio</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Name Modal -->
    <div class="modal fade" id="changeNameModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Change Display Name</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="creator_name" class="form-label fw-bold badge bg-info">New Display Name</label>
                            <input type="text" class="form-control" id="creator_name" name="creator_name" value="{{ $creator->creator_name }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Name</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Age Modal -->
    <div class="modal fade" id="changeAgeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Age</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="age" class="form-label fw-bold badge bg-info">Your Age</label>
                            <input type="number" class="form-control" id="age" name="age" value="{{ $creator->age }}" min="13" max="120" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Age</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection