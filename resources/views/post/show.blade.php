@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card mb-4 index-post">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="card-subtitle mb-2 text-muted">
                    <span>By</span>
                    <a href="{{ route('show-user', $post->user->id) }}">{{ $post->user->name }}</a>
                    <span> | {{ $post->created_at->format('d/m/Y, H:i') }}</span>
                </h6>
                <div class="d-flex">
                    @guest
                    <!-- Show buttons to post Author -->
                    @elseif(Auth::id() === $post->user->id)
                        <a href="/posts/{{ $post->id }}/edit"><i class="far fa-edit mr-3"></i></a>    
                        <form action="/posts/{{ $post->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="del-btn mr-3"><i class="far fa-trash-alt"></i></button>  
                        </form>  
                    @endguest 
                    <a href="{{ url()->previous() }}">Go Back</a>
                </div>  
            </div>
            <img class="card-img-top" src="{{ asset('storage/posts/' . $post->image) }}" alt="{{ asset('storage/posts/' . $post->image) }}">
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text">{{ $post->body }}</p>
            </div>
        </div>
    </div>
</div>
@endsection