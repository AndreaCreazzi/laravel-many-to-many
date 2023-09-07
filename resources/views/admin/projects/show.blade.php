@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <h2 class="fs-4 text-secondary my-4">
                Progetto
            </h2>
            <a href="{{ route('admin.projects.index') }}" class="btn btn-primary">Torna indietro</a>
        </div>
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a class="text-decoration-none text-dark" href="{{ $projects->link }}">{{ $projects->link }}</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @if ($projects->image)
                                <div class="col-6 text-center">
                                    <img class="img-fluid" style="height: 100px" src="{{ $projects->getImagePath() }}"
                                        alt="">
                                </div>
                            @endif
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <h5 class="card-title me-3">{{ $projects->title }}</h5>
                                    @forelse ($projects->technologies as $technology)
                                        <span
                                            class="badge rounded-pill bg-{{ $technology->color }} me-2 text-dark">{{ $technology->label }}</span>
                                    @empty
                                        -
                                    @endforelse
                                </div>
                                @if ($projects->type)
                                    <span class="badge p-2"
                                        style="background-color: {{ $projects->type->color }}">{{ $projects->type?->label }}</span>
                                @else
                                    -
                                @endif
                                <p class="card-text mt-2">{{ $projects->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
