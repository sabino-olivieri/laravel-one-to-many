@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 my-3 d-flex justify-content-between">
                <h2 class="m-0">{{ $project->title }}</h2> 
                <div>
                    <a class="btn btn-success" href="{{route('admin.project.edit', ['project' => $project->slug])}}"><i class="fa-solid fa-pen-to-square"></i></a>
                    <form action="{{route('admin.project.destroy', ['project' => $project->slug])}}" method="post" class="d-inline-block ">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </div>

            </div>
            <div class="col-12 col-md-6">
                <img class="img-fluid" src="{{ asset('storage/'.$project->image) }}" alt="">
            </div>

            <div class="col-12 col-md-6">
                <ul class="list-unstyled">
                    <li class="mb-3">
                        <strong>Tipo: </strong> {{ $project->type_id }}
                    </li>
                    <li class="mb-3">
                        <strong>Data inizio progetto:</strong> {{ $project->start_date }}
                    </li>
                    <li class="mb-3">
                        <strong>Data fine progetto:</strong> {{ $project->finish_date }}
                    </li>
                    <li class="text-truncate mb-3">
                        <strong>Link progetto:</strong> <a href="{{ $project->site_url }}" target="blank" class="text-white">{{ $project->site_url }}</a>
                    </li>
                    <li class="mb-3">
                        <strong>Descrizione: </strong> {{ $project->description }}
                    </li>
                </ul>
            </div>
        </div>
    </div>

    @session('message')
        <div class="ms_toast ms_hidden bg-success rounded-2 shadow">
            {{ session('message') }} <i class="fa-regular fa-circle-check"></i>
            <div class="ms_line ms_hidden" > </div>
        </div>
    @endsession

@endsection
