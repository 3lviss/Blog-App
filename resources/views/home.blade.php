@extends('layouts.app')

@section('content')

@include('flash-messages/messages')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="posts p-3">
                <!-- If Posts exists -->
                @if (count($posts) > 0)
                    <h2 class="mb-4">My Posts</h2>

                    <div class="list-group">
                        <!-- Loop trough posts -->
                        @foreach ($posts as $post)
                            <a href="/posts/ {{ $post->id }}" class="list-group-item list-group-item-action mb-3 border">{{ $post->title }} - published: {{ $post->created_at->format('d/m/Y, H:i') }}</a>
                        @endforeach <!-- Loop trough posts END -->
                    </div>

                    <!-- Pagination -->
                    {{ $posts->links() }}

                @else
                    <h3>You do not have any posts yet!</h3>
                @endif <!-- If Posts exists END -->
            </div>
        </div>
        <div class="col-4">
            <div class="profile p-3">
                <h4>{{ $user->name }}</h4>
                <h5 class="text-mute">{{ $user->email }}</h5>
                <a href="{{ route('edit-user', $user->id) }}">Edit My Info</a>
            </div>
        </div>
    </div>
</div>
@endsection
