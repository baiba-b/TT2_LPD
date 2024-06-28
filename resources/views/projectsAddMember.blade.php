<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="\css\addMemberStylesheet.css">
    <link rel="stylesheet" href="\css\navbarStylesheet.css">
    <title>Add Member to Project</title>
</head>

<body>
    <div class="container">
        <nav>
            <ul>
                <li><a href="{{ route('dashboard') }}">Home</a></li>
                <li><a href="{{ route('connections.index') }}">Connections</a></li>
                <li><a class="active" href="{{ route('projects.index') }}">Projects</a></li>
                <li><a href="{{ route('tasks.index') }}">Tasks</a></li>
                <li><a href="{{url('/Timeline')}}">Timeline</a></li>
                <li>
                    <a href="{{ url('/profile') }}" id="profile-info">
                        @if(Auth::user()->profile_picture)
                        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile Picture" class="exception" style="width: 35px; height: 35px;">
                        @else
                        <img src="{{ asset('default_profile_picture.png') }}" alt="Default Profile Picture" class="exception" style="width: 35px; height: 35px;">
                        @endif
                        <span class="profile-name">{{ Auth::user()->name }}</span>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="form-container">
            <h1>Add Member to Project: {{ $project->name }}</h1>

            <form action="{{ route('projects.storeMember', $project) }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="user_id">Select User:</label>
                    <select name="user_id" id="user_id" class="form-control" required>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="role_id">Select Role:</label>
                    <select name="role_id" id="role_id" class="form-control" required>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Add Member</button>
            </form>
        </div>
    </div>
</body>

</html>
