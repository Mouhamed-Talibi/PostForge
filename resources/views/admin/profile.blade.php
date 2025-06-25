@extends('layout.admin')

@section('title')
    Profile
@endsection

@section('pageContent')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <img src="{{ asset('storage/' .$admin->image) }}" alt="Profile Image" class="rounded-circle img-fluid" style="width: 150px; height: 150px; object-fit: cover;">
                    <h5 class="my-3">{{ $admin->admin_name }}</h5>
                    <p class="text-muted mb-1">{{ strtoupper($admin->role) }}</p>
                    <p class="text-muted mb-4">{{ Str::limit($admin->bio, 60) }}</p>
                    <div class="d-flex justify-content-center mb-2">
                        <a href="{{ route('admin.edit_profile', $admin->id)}}" class="btn btn-outline-success">
                            <i class="fa-solid fa-user-pen"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Status</p>
                        </div>
                        <div class="col-sm-9">
                            <span class="badge bg-{{ $admin->status === 'active' ? 'success' : 'danger' }}">
                                {{ ucfirst($admin->status) }}
                            </span>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Gender</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ ucfirst($admin->gender) }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Age</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ $admin->age }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Full Name</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ $admin->creator_name }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Email</p>
                            <a href="{{ route('admin.edit_email', $admin->id)}}" class="badge bg-primary"><i class="fa-solid fa-user-pen"></i></a>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ $admin->email }}</p>
                            @if($admin->email_verified_at)
                                <span class="badge bg-success">Verified</span>
                            @else
                                <span class="badge bg-warning">Not Verified</span>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Member Since</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ \Carbon\Carbon::parse($admin->created_at)->format('F j, Y') }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Last Updated</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ \Carbon\Carbon::parse($admin->updated_at)->format('F j, Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="mb-3">About</h5>
                    <p class="text-muted mb-0">{{ $admin->bio }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection