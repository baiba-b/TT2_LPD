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
            <div class="breadcrumb">Home > Permissions & Accounts > User Management</div>
            <div class="toolbar">
                <input type="text" placeholder="Search User">
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

                    <tr>
                        <td><input type="checkbox"></td>
                        <td>
                            <div class="user-info">
                                <img src="user-pic.jpg" alt="User Picture">
                                <div>
                                    <p>Yeray Rosales</p>
                                    <p class="email">name@email.com</p>
                                    <p class="status not-logged-in">Not Logged in</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="role manager">Manager</span>
                            <span class="role admin">Admin</span>
                        </td>
                        <td>
                            <button class="action-btn modify">Modify Roles</button>
                            <button class="action-btn remove">Remove User</button>
                        </td>
                    </tr>

                </tbody>
            </table>
            <div class="pagination">
                <span>Displaying page</span>
                <button class="page-btn">First</button>
                <button class="page-btn">10</button>
                <button class="page-btn">11</button>
                <button class="page-btn">Last</button>
            </div>
        </div>
    </div>
</body>

</html>