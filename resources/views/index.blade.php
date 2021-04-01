@extends('layouts.app')

@section('content')

@include('flash-messages/messages')

<div class="container">
    <div class="row justify-content-center">

        <!-- If Posts exists -->
        @if (count($posts) > 0)
            <!-- Loop trough posts -->
            @foreach ($posts as $post)
                <div class="card mb-4 index-post">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="card-subtitle mb-2 text-muted">
                            <span>By</span>
                            <a href="{{ route('show-user', $post->user->id) }}">{{ $post->user->name }}</a>
                            <span> | {{ $post->created_at->format('d/m/Y, H:i') }}</span>
                        </h6>

                        @guest
                        @elseif(Auth::id() === $post->user->id)
                            <div class="d-flex">
                                <a href="/posts/{{ $post->id }}/edit"><i class="far fa-edit mr-3"></i></a>  
                                <form action="/posts/{{ $post->id }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="del-btn"><i class="far fa-trash-alt"></i></button>  
                                </form> 
                            </div>  
                        @endguest
                    </div>
                    <img class="card-img-top index-img" src="{{ asset('storage/posts/' . $post->image) }}" alt="{{ asset('storage/posts/' . $post->image) }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ $post->body }}</p>
                        <a href="/posts/ {{ $post->id }}">Full Post</a>
                    </div>
                </div>
                    
            @endforeach <!-- Loop trough posts END -->

            <!-- Pagination -->
            {{ $posts->links() }}

        @else
            <h3>No posts to show!</h3>
        @endif <!-- If Posts exists END -->
    </div>
</div>
@endsection
