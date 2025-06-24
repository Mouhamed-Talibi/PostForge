@extends('layout.admin')

@section('title')
    Edit {{ $post->title }}
@endsection

@section('pageContent')
    <div class="container">
            <h1 class="text-center mb-4 fw-bold registrationHeading">PostForge - <span>Edit post</span></h1>

            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-9">
                    <form action="{{ route('admin.update_post', $post->id) }}" method="POST" enctype="multipart/form-data" class="registrationForm p-4 rounded shadow">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="post_title" class="form-label"><p class="fw-bold">Post Title</p></label>
                            <input type="text" class="form-control" name="post_title" id="post_title" value="{{ $post->title }}">
                            {{-- error --}}
                            @error('post_title')
                                <p class="text-danger fw-bold">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label"><p class="fw-bold">Post Description</p></label>
                            <textarea name="description" id="" class="form-control" value="Your Post Descripton Here">{{ $post->description }}</textarea>
                            {{-- error --}}
                            @error('description')
                                <p class="text-danger fw-bold">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label"><p class="fw-bold">Post Category</p></label>
                            <select name="category" id="" class="form-control">
                                <option value="{{ $post->category_id}}"selected>{{ $post->category->name}}</option>
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
                            <div class="mb-3" style="width: 300px; height: 180px; overflow: hidden;">
                                <img src="{{ asset('storage/' . $post->image)}}" alt="{{ $post->title }}" class="img-fluid rounded">
                            </div>
                            <input type="file" class="form-control" name="image" id="image" accept="image/*">
                            {{-- error --}}
                            @error('image')
                                <p class="text-danger fw-bold">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mt-3">Update Post</button>
                    </form>
                </div>
            </div>
        </div>
@endsection