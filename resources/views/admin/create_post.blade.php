@extends('layout.admin')

    {{-- title --}}
    @section('title')
        Create Post
    @endsection

    {{-- content --}}
    @section('pageContent')
        <div class="container">
            @can('create', auth('creator')->user())
                <h1 class="text-center mb-4 fw-bold registrationHeading">PostForge - <span>Create post</span></h1>

                <div class="row justify-content-center">
                    <div class="col-12 col-md-10 col-lg-9">
                        <form action="{{ route('admin.store_post') }}" method="POST" enctype="multipart/form-data" class="registrationForm p-4 rounded shadow">
                            @csrf

                            <div class="mb-3">
                                <label for="post_title" class="form-label"><p class="fw-bold">Post Title</p></label>
                                <input type="text" class="form-control" name="post_title" id="post_title" value="{{ old('post_title') }}">
                                {{-- error --}}
                                @error('post_title')
                                    <p class="text-danger fw-bold">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label"><p class="fw-bold">Post Description</p></label>
                                <textarea name="description" id="" class="form-control" value="Your Post Descripton Here">{{ old('description') }}</textarea>
                                {{-- error --}}
                                @error('description')
                                    <p class="text-danger fw-bold">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="category" class="form-label"><p class="fw-bold">Post Category</p></label>
                                <select name="category" id="" class="form-control">
                                    <option value="">Select your post category</option>
                                    {{-- loop categories --}}
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                {{-- error --}}
                                @error('category')
                                    <p class="text-danger fw-bold">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label"><p class="fw-bold">Post Image (Optional)</p></label>
                                <input type="file" class="form-control" name="image" id="image" accept="image/*">
                                {{-- error --}}
                                @error('image')
                                    <p class="text-danger fw-bold">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mt-3">Create Post</button>
                        </form>
                    </div>
                </div>
            @endcan
        </div>
    @endsection
