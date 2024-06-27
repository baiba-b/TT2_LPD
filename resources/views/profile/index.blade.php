<!-- resources/views/profile.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Profile</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="profile_picture">Profile Picture</label>
            <input type="file" name="profile_picture" id="profile_picture" class="form-control">
            @error('profile_picture')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>

    <div class="mt-4">
        <h3>Current Profile Picture</h3>
        @if(Auth::user()->profile_picture)
            <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile Picture" style="width: 150px; height: 150px; border-radius: 50%;">
        @else
            <img src="{{ asset('default_profile_picture.png') }}" alt="Default Profile Picture" style="width: 150px; height: 150px; border-radius: 50%;">
        @endif
    </div>
</div>
@endsection
