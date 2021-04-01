@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card mb-4 w-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="card-subtitle mb-2 text-muted">Create a New Post</h6>
                <div>
                    <a href="{{ url()->previous() }}">Go Back</a>
                </div>  
            </div>
            <div class="card-body">
                <form method="POST" action="/posts" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control-file @error('image') is-invalid @enderror" name="image" id="image">

                        @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" placeholder="Enter Title">

                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="body">Post</label>
                        <textarea class="form-control @error('body') is-invalid @enderror" name="body" id="body" rows="3" placeholder="Write a post..."></textarea>

                        @error('body')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection