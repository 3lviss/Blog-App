@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card w-75">
            <div class="card-header">
                @if ($user->id !== Auth::id())
                   <h4>Post Author</h4> 
                @else
                    <h4>My Profile</h4> 
                @endif
                
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $user->name }}</h5>
                <h6 class="card-subtitle mb-2 text-muted">{{ $user->email }}</h6>
                <p class="card-text">Total published posts: {{ $total_posts }}</p>
                <a href="{{ url()->previous() }}" class="card-link">Back</a>

                @if ($user->id === Auth::id())
                    <a href="{{ route('edit-user', $user->id) }}" class="card-link">Edit My Info</a>
                @endif
                
            </div>
        </div>
    </div>
</div>
@endsection