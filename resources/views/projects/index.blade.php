@extends('layout')
@section('content')
<a href="{{ route('projects.create') }}" class="btn btn-primary mb-3">Add Project</a>
<table class="table">
    <thead>
        <tr>
            <th>Title</th><th>Status</th><th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($projects as $project)
        <tr>
            <td>{{ $project->title }}</td>
            <td>{{ $project->status }}</td>
            <td>
                <a href="{{ route('projects.show', $project) }}" class="btn btn-sm btn-info">View</a>
                <a href="{{ route('projects.edit', $project) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('projects.destroy', $project) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Delete this project?')" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
