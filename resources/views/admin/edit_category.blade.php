@extends('layout.admin')

@section('title')
    Edit {{ $category->name }}
@endsection

@section('pageContent')
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-10">
                <form action="{{ route('admin.update_category', $category->id )}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="border p-2 rounded-3">
                        <div class="text-center">
                            <img src="{{ asset('storage/' . $category->image )}}" alt="" class="img-fluid rounded-circle"
                                style="height:150px; width:150px; object-fit:cover;">
                            <label for="image" class="d-block btn btn-outline-secondary mt-2 w-25 mx-auto">Upload New Image</label>
                            <input type="file" name="image" id="image" hidden>
                            @error('image')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="card-body mt-3 p-5 w-75 mx-auto">
                            <label for="name" class="form-label fw-bold">Category Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $category->name ?? old('name')}}">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="submit mt-2 text-center">
                            <button type="submit" class="btn text-white bg-primary bg-opacity-40">Update Category</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection