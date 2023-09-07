@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="fs-4 text-secondary my-4">
                Progetti
            </h2>
            <a class="btn btn-success" href="{{ route('admin.projects.create') }}">Nuovo Progetto</a>
        </div>
        <div class="row justify-content-center">
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">titolo</th>
                        <th scope="col">tipo</th>
                        <th scope="col">tecnologia</th>
                        <th scope="col">link</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($projects as $project)
                        <tr>
                            <th scope="row">{{ $project->id }}</th>
                            <td>{{ $project->title }}</td>
                            <td>
                                @if ($project->type)
                                    <span class="badge"
                                        style="background-color: {{ $project->type->color }}">{{ $project->type?->label }}</span>
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @forelse ($project->technologies as $technology)
                                    <span
                                        class="badge rounded-pill bg-{{ $technology->color }} me-2 text-dark">{{ $technology->label }}</span>
                                @empty
                                    -
                                @endforelse
                            </td>
                            <td><a class="text-decoration-none text-white"
                                    href="{{ $project->link }}">{{ $project->link }}</a></td>
                            <td>
                                <div class="d-flex">
                                    <a class="btn btn-primary btn-sm" href="{{ route('admin.projects.show', $project) }}"><i
                                            class="fas fa-eye"></i></a>

                                    <a class="btn btn-warning text-white btn-sm mx-2"
                                        href="{{ route('admin.projects.edit', $project) }}">
                                        <i class="fas fa-pencil"></i></a>
                                    <form action="{{ route('admin.projects.destroy', $project) }}" method="POST"
                                        class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <th>Non ci sono progetti</th>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    @vite('resources\js\delete-confirmation.js');
@endsection
