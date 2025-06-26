@extends('layout.admin')

@section('title', 'Creators List')

@section('pageContent')
    <div class="container py-3 pb-5">
        <div class="row justify-content-center align-items-center">
            {{-- looping creators --}}
            @foreach($creators as $creator)
                {{-- creator card --}}
                <div class="col-md-6 col-lg-4">
                    <div class="creator-card rounded-3 shadow p-3 mt-4">
                        <div class="d-flex justify-content-center">
                            <div class="creator-image text-center mt-2">
                                <img src="{{ asset('storage/' . $creator->image) }}" alt="" class="img-fluid rounded-circle" style="width:100px; height:100px; object-fit:cover;">
                            </div>
                        </div>

                        <hr class="text-dark w-50 mx-auto mb-3">

                        <h4 class="fw-bold text-center">{{ $creator->creator_name }}</h4>
                        <p class="mt-2 text-dark-50">
                            {{ Str::limit($creator->bio, 50) }}
                        </p>
                        <div class="links text-center mt-3">
                            <a href="{{ route('creators.show', $creator->id) }}" class="btn btn-outline-secondary">
                                <i class="fa-solid fa-right-to-bracket"></i>
                            </a>
                            <button type="button" class="btn btn-danger" 
                                data-bs-toggle="modal" 
                                data-bs-target="#deleteCreatorModal{{ $creator->id }}">
                                <i class="fas fa-trash"></i>
                            </button>
                            <button type="submit" class="btn btn-outline-danger"
                                data-bs-toggle="modal" 
                                data-bs-target="#banCreatorModal{{ $creator->id }}">
                                <i class="fa-solid fa-ban"></i>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Modal for each creator --}}
                <div class="modal fade" id="deleteCreatorModal{{ $creator->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-secondary text-light">
                                <h5 class="modal-title fs-4">Confirm Delete Creator</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p class="fw-bold">Are you sure you want to delete <span class="text-danger">{{ $creator->creator_name }} </span> This action cannot be undone.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                <form action="{{ route('admin.delete_creator', $creator->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Confirm Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Modal for each creator | ban --}}
                <div class="modal fade" id="banCreatorModal{{ $creator->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-secondary text-light">
                                <h5 class="modal-title fs-4">Confirm Banning Creator</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p class="fw-bold">Are you sure you want to Ban <span class="text-danger">{{ $creator->creator_name }} </span> This action cannot be undone.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                <form action="{{ route('admin.ban_creator', $creator->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-danger">Ban Creator</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- pagination links --}}
        <div class="mt-4">
            {{ $creators->links() }}
        </div>
    </div>
@endsection