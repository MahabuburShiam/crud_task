@extends('layout')

@section('content')
<div class="container">
    <h2 class="mb-4">Project Details</h2>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ $project->title }}</h4>

            @if ($project->image)
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $project->image) }}" alt="Project Image" class="img-fluid" style="max-width: 400px;">
                </div>
            @endif

            @if ($project->description)
                <p class="card-text"><strong>Description:</strong> {{ $project->description }}</p>
            @endif

            @if ($project->project_url)
                <p class="card-text">
                    <strong>URL:</strong>
                    <a href="{{ $project->project_url }}" target="_blank">{{ $project->project_url }}</a>
                </p>
            @endif

            <p class="card-text"><strong>Status:</strong> {{ ucfirst($project->status) }}</p>
            <p class="card-text"><strong>Created:</strong> {{ $project->created_at->format('F j, Y') }}</p>

            <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this project?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            <a href="{{ route('projects.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
</div>
@endsection
