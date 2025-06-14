@extends('layout.master')

    @section('title')
        Creators
    @endsection

    @section('content')
        <div class="container py-3 pb-5">
            <div class="row justify-content-center align-items-center">
                {{-- looping creators --}}
                @foreach($creators as $creator)
                    {{-- creator card --}}
                    <div class="col-md-6 col-lg-4">
                        <div class="creator-card rounded-3 shadow p-3 mt-4">
                            <div class="d-flex justify-content-center">
                                <div class="creator-image text-center mt-2" style="width: 100px; height: 100px;">
                                    <img src="{{ asset('storage/' . $creator->image )}}" alt="" class="img-fluid rounded">
                                </div>
                            </div>

                            <hr class="text-dark w-50 mx-auto mb-3">

                            <h4 class="fw-bold text-center">{{ $creator->creator_name }}</h4>
                            <p class="mt-2 text-dark-50">
                                {{ Str::limit($creator->bio, '50') }}
                            </p>
                            <div class="links text-center mt-3">
                                <a href="{{ route('creators.show', $creator->id )}}" class="btn btn-secondary"><i class="fa-solid fa-right-to-bracket"></i></a>
                                <a href="" class="btn btn-info"><i class="fas fa-user-plus"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- creators links --}}
            {{ $creators->links() }}
        </div>
    @endsection