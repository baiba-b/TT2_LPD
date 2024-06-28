<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="\css\participentsStylesheet.css">
    <link rel="stylesheet" href="\css\navbarStylesheet.css">
    <title>User Management</title>
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
        <div class="user-management">
            <h2>User Management</h2>
            <div class="toolbar">
                <button class="add-user-btn">Add User</button>
            </div>
            <table>
                <thead>
                    <tr>
                        <th><input type="checkbox"></th>
                        <th>Name</th>
                        <th>User Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>
                            <div class="user-info">
                            @if(Auth::user()->profile_picture)
                        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile Picture" class="exception" style="width: 50px; height: 50px;">
                        @else
                        <img src="{{ asset('/images/default_profile_picture.png') }}" alt="Default Profile Picture" class="exception" style="width: 50px; height: 50px;">
                        @endif
                                <div>
                                    <p>{{Auth::user()->name}}</p>
                                    <p class="email">{{Auth::user()->email}}</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="role">{{$user->projectRoles->where('pivot.project_id', $project->id)->first()->name}}</span>
                        </td>
                        <td>
                            <button class="action-btn modify">Modify Roles</button>
                            <button class="action-btn remove">Remove User</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>