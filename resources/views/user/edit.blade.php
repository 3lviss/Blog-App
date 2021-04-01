@extends('layouts.app')

@section('content')

@include('flash-messages.messages')
<div class="container">
    <div class="row justify-content-center">
        <div class="card mb-4 w-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="card-subtitle mb-2 text-muted">Edit My Profile</h6> 
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('update-user', $user->id) }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ $user->name }}">

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}" disabled>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="card mb-4 w-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="card-subtitle mb-2 text-muted">New Password</h6> 
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('update-password', $user->id) }}">
                    @csrf
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Type New Password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">

                        @error('password_confirmation')
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

    <div class="row justify-content-center">
        <div class="card mb-4 w-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="card-subtitle mb-2 text-muted">Delete My Account</h6> 
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('delete-acc', $user->id) }}">
                    @csrf
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control @error('del_password') is-invalid @enderror" name="del_password" id="password" placeholder="Enter Your Password">

                        @error('del_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-danger">DELETE ACCOUNT</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection