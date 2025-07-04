@extends('layout.master')

    {{-- title --}}
    @section('title')
        Login
    @endsection

    {{-- content --}}
    @section('content')
        <div class="container">
            <h1 class="text-center mb-4 fw-bold registrationHeading">PostForge - <span>Login</span></h1>

            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-9">
                    <form action="{{ route('auth.login')}}" method="POST" enctype="multipart/form-data" class="registrationForm p-5 rounded shadow">
                        @csrf

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

                        <button type="submit" class="btn btn-primary w-100">Login</button>

                        <div class="register mt-3 text-center">
                            <p class="text-dark-50">
                                Don't Have Account ?
                                <a href="{{ route('auth.register')}}" class="text-primary"><span class="fw-bold">Register</span></a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
