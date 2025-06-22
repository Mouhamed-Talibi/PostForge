@extends('layout.admin')

@section('title')
    Edit {{ $creator->creator_name }}
@endsection

@section('pageContent')
    <div class="row justify-content-center align-items-center mt-5">
            <div class="col-12 col-md-10 col-lg-9">
                <form action="{{ route('admin.new_creator.store') }}" method="POST" enctype="multipart/form-data" class="registrationForm p-4 rounded shadow">
                    @csrf

                    <div class="mb-3">
                        <label for="creator_name" class="form-label">Creator Full Name</label>
                        <input type="text" class="form-control" name="creator_name" id="creator_name" value="{{ $creator->creator_name }}">
                        {{-- error --}}
                        @error('creator_name')
                            <p class="text-danger fw-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gender</label><br>
                        <label><input type="radio" name="gender" value="male" {{ old('gender') == 'male' ? 'checked' : '' }}> Male</label>
                        <label class="ms-3"><input type="radio" name="gender" value="female" {{ $creator->gender == 'female' ? 'checked' : '' }}> Female</label>
                        {{-- error --}}
                        @error('gender')
                            <p class="text-danger fw-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="bio" class="form-label">Bio <small>(Optional)</small></label>
                        <textarea name="bio" id="" value="{{ old('bio') }}" class="form-control">{{ $creator->creator_name }}</textarea>
                        {{-- error --}}
                        @error('bio')
                            <p class="text-danger fw-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="age" class="form-label">Age</label>
                        <input type="number" class="form-control" name="age" id="age" value="{{ $creator->age }}">
                        {{-- error --}}
                        {{-- error --}}
                        @error('age')
                            <p class="text-danger fw-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Profile Image (optional)</label>
                        <input type="file" class="form-control" name="image" id="image" accept="image/*">
                        {{-- error --}}
                        @error('image')
                            <p class="text-danger fw-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Update Creator</button>
                </form>
            </div>
        </div>
@endsection