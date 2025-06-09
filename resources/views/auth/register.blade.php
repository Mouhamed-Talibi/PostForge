@extends('layout.master')

{{-- title --}}
@section('title')
    Register
@endsection

{{-- content --}}
@section('content')
    <div class="container">
        <h1 class="text-center mb-4 fw-bold registrationHeading">PostForge - <span>Register</span></h1>

        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-9">
                <form action="{{ route('auth.register') }}" method="POST" enctype="multipart/form-data" class="registrationForm p-4 rounded shadow">
                    @csrf

                    <div class="mb-3">
                        <label for="creator_name" class="form-label">Full Name</label>
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

                    <button type="submit" class="btn btn-primary w-100">Register</button>
                </form>
            </div>
        </div>
    </div>
@endsection
