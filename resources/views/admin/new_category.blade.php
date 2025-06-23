@extends('layout.admin')

    @section('title')
        New Category
    @endsection

    @section('pageContent')
        <h1 class="text-center fw-bold">New Category</h1>
        <p class="text-center text-dark-50">Add new category manually in small steps</p>
        <hr class="w-50 mx-auto text-primary">

        <div class="row justify-content-center align-items-center mt-5">
            <div class="col-12 col-md-10 col-lg-9">
                <form action="{{ route('admin.new_category.store') }}" method="POST" enctype="multipart/form-data" class="registrationForm p-4 rounded shadow">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">Category Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ old('creator_name') }}" placeholder="Category name here">
                        {{-- error --}}
                        @error('name')
                            <p class="text-danger fw-bold">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <label for="image" class="form-label fw-bold">Category Image (optional)</label>
                        <input type="file" class="form-control" name="image" id="image" accept="image/*">
                        {{-- error --}}
                        @error('image')
                            <p class="text-danger fw-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Create Category</button>
                </form>
            </div>
        </div>
    @endsection