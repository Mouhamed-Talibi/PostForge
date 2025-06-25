@extends('layout.admin')

@section('title')
    Update Email Address
@endsection

@section('pageContent')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg">                
                <div class="card-body">
                    <form action="{{ route('admin.update_email', $admin->id) }}" method="POST" class="p-4">
                        @csrf
                        @method('PUT')

                        <div class="mb-4 text-center">
                            <div class="avatar avatar-xxl mb-3">
                                <img src="{{ asset("storage/" . $admin->image) }}" alt="Profile Image" class="rounded-circle border border-3 border-primary" style="width: 80px; height: 80px; object-fit: cover;">
                            </div>
                            <h5>{{ $admin->creator_name }}</h5>
                        </div>

                        <div class="form-group mb-4">
                            <label for="current_email" class="form-label">Current Email</label>
                            <input type="email" class="form-control" id="current_email" value="{{ $admin->email }}" disabled>
                        </div>

                        <div class="form-group mb-4">
                            <label for="email" class="form-label">New Email Address <span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                    id="email" name="email" value="{{ old('email') }}"  autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="email_confirmation" class="form-label">Confirm New Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email_confirmation') is-invalid @enderror" 
                                    id="email_confirmation" name="email_confirmation" >
                            @error('email_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="password" class="form-label">Current Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                    id="password" name="password" >
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Enter your password to confirm changes</small>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="{{ route('admin.profile') }}" class="btn">
                                <i class="fas fa-arrow-left me-1"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> save changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection