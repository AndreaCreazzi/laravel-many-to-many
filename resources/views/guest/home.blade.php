@extends('layouts.app')
@section('content')
    <div class="jumbotron p-5 mb-4 bg-light rounded-3">
        <div class="container py-5">
            <h1 class="display-5 fw-bold">
                Andrea Creazzi | Web Developer
            </h1>
            <p class="col-md-8 fs-4 mb-0">Entra in un mondo di possibiltà con un Junior Full-Stack-developer.</p>
        </div>
    </div>

    <div class="content">
        <div class="container">
            <h2 class="fs-4 text-secondary my-4">
                Progetti
            </h2>
            <div class="row justify-content-center">
                @forelse ($projects as $project)
                    <div class="col-12 py-3">
                        <div class="card">
                            <div class="card-header">
                                <a class="text-decoration-none text-dark"
                                    href="{{ $project->link }}">{{ $project->link }}</a>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @if ($project->image)
                                        <div class="col-6 text-center">
                                            <img class="img-fluid" style="height: 100px"
                                                src="{{ asset('storage/' . $project->image) }}" alt="">
                                        </div>
                                    @endif
                                    <div class="col-6">
                                        <h5 class="card-title">{{ $project->title }}</h5>
                                        <p class="card-text">{{ $project->description }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <h3>Non ci sono Progetti</h3>
                @endforelse
            </div>
        </div>
    </div>
@endsection
