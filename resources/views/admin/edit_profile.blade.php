@extends('layout.admin')

@section('title')
    Edit Profile
@endsection

@section('pageContent')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center mb-3">Edit profile</h1>
            <hr>
            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{ route('admin.update_profile', $admin->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label for="creator_name">Full Name</label>
                                    <input type="text" class="form-control" id="creator_name" name="creator_name" 
                                            value="{{ old('creator_name', $admin->creator_name) }}">
                                    @error('creator_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label for="age">Age</label>
                                    <input type="number" class="form-control" id="age" name="age" 
                                            value="{{ old('age', $admin->age) }}" min="18" max="100">
                                    @error('age')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label for="gender">Gender</label>
                                    <select class="form-control" id="gender" name="gender">
                                        <option value="male" {{ old('gender', $admin->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ old('gender', $admin->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                    </select>
                                    @error('gender')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-2">
                            <label for="bio">Bio</label>
                            <textarea class="form-control" id="bio" name="bio" rows="3">{{ old('bio', $admin->bio) }}</textarea>
                            @error('bio')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="image">Profile Image</label>
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <img src="{{ asset("storage/" . $admin->image) }}" alt="Current Profile Image" class="rounded-circle" width="80" height="80">
                                </div>
                                <div class="flex-grow-1">
                                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                    <small class="text-muted">Leave empty to keep current image</small>
                                    @error('image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                            <a href="{{ route('admin.profile') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection