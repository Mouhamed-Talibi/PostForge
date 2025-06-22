@extends('layout.admin')

@section('title')
    Edit {{ $creator->creator_name }}
@endsection

@section('pageContent')
    {{-- title --}}
    <h1 class="text-center">Edit <span class="text-primary">{{  $creator->creator_name }}</span> Infos</h1>
    <hr class="w-50 mx-auto">

    <div class="row justify-content-center align-items-center mt-5 mb-4">
            <div class="col-12 col-md-10 col-lg-9">
                <form action="{{ route('admin.update_creator', $creator->id) }}" method="POST" enctype="multipart/form-data" class="registrationForm p-4 rounded shadow">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="creator_name" class="form-label"><p class="fw-bold">Creator Full Name</p></label>
                        <input type="text" class="form-control" name="creator_name" id="creator_name" value="{{ $creator->creator_name }}">
                        {{-- error --}}
                        @error('creator_name')
                            <p class="text-danger fw-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><p class="fw-bold">Gender</p></label><br>
                        <label>
                            <input type="radio" name="gender" value="male" 
                                {{ old('gender', $creator->gender ?? '') == 'male' ? 'checked' : '' }}> 
                            Male
                        </label>
                        <label class="ms-3">
                            <input type="radio" name="gender" value="female" 
                                {{ old('gender', $creator->gender ?? '') == 'female' ? 'checked' : '' }}> 
                            Female
                        </label>
                        {{-- error --}}
                        @error('gender')
                            <p class="text-danger fw-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="bio" class="form-label"><p class="fw-bold d-inline">Bio</p> <small>(Optional)</small></label>
                        <textarea name="bio" id="" value="{{ old('bio') }}" class="form-control">{{ $creator->creator_name }}</textarea>
                        {{-- error --}}
                        @error('bio')
                            <p class="text-danger fw-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="age" class="form-label"><p class="fw-bold">Age</p></label>
                        <input type="number" class="form-control" name="age" id="age" value="{{ $creator->age }}">
                        {{-- error --}}
                        {{-- error --}}
                        @error('age')
                            <p class="text-danger fw-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                            <label for="image" class="form-label"><p class="fw-bold">Creator Image (Optional)</p></label>
                            <div class="mb-3" style="width: 300px; height: 180px; overflow: hidden;">
                                <img src="{{ asset('storage/' . $creator->image)}}" alt="{{ $creator->creator_name }}" class="img-fluid rounded">
                            </div>
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