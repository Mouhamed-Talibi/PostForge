@extends('layout.admin')

@section('title', 'Categories List')

@section('pageContent')
    <div class="container-fluid py-4">
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="h2 mb-0">Categories Management</h1>
                    <a href="{{ route('admin.new_category') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Add New Category
                    </a>
                </div>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                @if($categories->isEmpty())
                    <div class="alert alert-info text-center">
                        No categories found. Create your first category!
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th width="50px">#</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Posts</th>
                                    <th width="120px">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($category->image)
                                                    <img src="{{ asset('storage/' . $category->image) }}" 
                                                            alt="{{ $category->name }}" 
                                                            class="rounded-circle me-3" 
                                                            width="40" height="40">
                                                @endif
                                                <strong>{{ $category->name }}</strong>
                                            </div>
                                        </td>
                                        <td>{{ $category->slug }}</td>
                                        <td>{{ $category->posts->count() }}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('admin.edit_category', $category->id )}}" 
                                                    class="btn btn-sm btn-outline-primary"
                                                    title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" 
                                                        class="btn btn-sm btn-outline-danger"
                                                        title="Delete"
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#deleteCategoryModal-{{ $category->id }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        <!-- Modals should be placed outside the table -->
        @foreach($categories as $category)
        <div class="modal fade" id="deleteCategoryModal-{{ $category->id }}" tabindex="-1" aria-labelledby="deleteCategoryModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="deleteCategoryModalLabel">Confirm Deletion</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete the category <strong>"{{ $category->name }}"</strong>?</p>
                        <p class="text-danger"><small>This action cannot be undone. All posts in this category will be uncategorized.</small></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form action="{{ route('admin.delete_category', $category->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete Category</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        @if($categories->hasPages())
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body d-flex justify-content-center">
                            {{ $categories->links() }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection