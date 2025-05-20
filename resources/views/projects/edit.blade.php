@extends('layout')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Project</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $project->title) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control">{{ old('description', $project->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="project_url" class="form-label">Project URL</label>
            <input type="url" name="project_url" id="project_url" class="form-control" value="{{ old('project_url', $project->project_url) }}">
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Project Image</label>
            @if ($project->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $project->image) }}" alt="Current Image" width="150">
                </div>
            @endif
            <input type="file" name="image" id="image" class="form-control">
            <small class="text-muted">Leave empty to keep the current image</small>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
            <select name="status" id="status" class="form-control" required>
                <option value="draft" {{ old('status', $project->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="published" {{ old('status', $project->status) == 'published' ? 'selected' : '' }}>Published</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Project</button>
        <a href="{{ route('projects.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
