@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card mb-4 w-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="card-subtitle mb-2 text-muted">
                    <span>By</span>
                    <a href="{{ route('show-user', $post->user->id) }}">{{ $post->user->name }}</a>
                    <span> | {{ $post->created_at->format('d/m/Y, H:i') }}</span>
                </h6>
                <div>
                    <a href="{{ url()->previous() }}">Go Back</a>
                </div>  
            </div>
            <div class="card-body">
                <form method="POST" action="/posts/{{ $post->id }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="new_image">Image</label>
                        <input type="file" class="form-control-file @error('new_image') is-invalid @enderror" name="new_image" id="new_image">

                        @error('new_image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{ $post->title }}">

                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="body">Post</label>
                        <textarea class="form-control @error('body') is-invalid @enderror" name="body" id="body" rows="10">{{ $post->body }}</textarea>

                        @error('body')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection