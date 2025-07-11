@extends('layout.admin')

    @section('title')
        New Creator
    @endsection

    @section('pageContent')
        <h1 class="text-center fw-bold">New Creator Account</h1>
        <p class="text-center text-dark-50">Add new creator manually in small steps</p>
        <hr class="w-50 mx-auto text-primary">

        <div class="row justify-content-center align-items-center mt-5">
            <div class="col-12 col-md-10 col-lg-9">
                <form action="{{ route('admin.new_creator.store') }}" method="POST" enctype="multipart/form-data" class="registrationForm p-4 rounded shadow">
                    @csrf

                    <div class="mb-3">
                        <label for="creator_name" class="form-label">Creator Full Name</label>
                        <input type="text" class="form-control" name="creator_name" id="creator_name" value="{{ old('creator_name') }}">
                        {{-- error --}}
                        @error('creator_name')
                            <p class="text-danger fw-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gender</label><br>
                        <label><input type="radio" name="gender" value="male" {{ old('gender') == 'male' ? 'checked' : '' }}> Male</label>
                        <label class="ms-3"><input type="radio" name="gender" value="female" {{ old('gender') == 'female' ? 'checked' : '' }}> Female</label>
                        {{-- error --}}
                        @error('gender')
                            <p class="text-danger fw-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="bio" class="form-label">Bio <small>(Optional)</small></label>
                        <textarea name="bio" id="" value="{{ old('bio')}}" class="form-control"></textarea>
                        {{-- error --}}
                        @error('bio')
                            <p class="text-danger fw-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="age" class="form-label">Age</label>
                        <input type="number" class="form-control" name="age" id="age" value="{{ old('age') }}">
                        {{-- error --}}
                        {{-- error --}}
                        @error('age')
                            <p class="text-danger fw-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
                        {{-- error --}}
                        @error('email')
                            <p class="text-danger fw-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                        {{-- error --}}
                        @error('password')
                            <p class="text-danger fw-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                        {{-- error --}}
                        @error('password_confirmation')
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

                    <button type="submit" class="btn btn-primary w-100">new Creator</button>
                </form>
            </div>
        </div>
    @endsection