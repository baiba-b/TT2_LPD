<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="\css\dashboardStylesheet.css">
    <link rel="stylesheet" href="\css\navbarStylesheet.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Dashboard</title>
</head>
<body>
<!-- add routes in href, see welcome blade -->
<nav>
        <ul>
            <li><a href="{{ url('/profile') }}" class="circle-button">
                <i class="material-icons">account_circle</i>
            </a></li>
            <li><a class="active" href="{{ route('dashboard') }}">Home</a></li>
            <li><a href="{{ route('connections.index') }}">Connections</a></li>
            <li><a  href="{{ route('projects.index') }}">Projects</a></li>
            <li><a href="{{ route('tasks.index') }}">Tasks</a></li>
            <li><a href="{{url('/Timeline')}}">Timeline</a></li>
        </ul>
    </nav>
</body>
</html>