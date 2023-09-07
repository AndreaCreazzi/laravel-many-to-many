@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="fs-4 text-secondary my-4">
            Progetto
        </h2>
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
                                <h5 class="card-title">{{ $projects->title }}</h5>
                                <p class="card-text">{{ $projects->description }}</p>
                                <a href="{{ route('admin.projects.index') }}" class="btn btn-primary">Torna indietro</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
