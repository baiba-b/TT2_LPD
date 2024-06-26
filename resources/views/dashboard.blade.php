<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="\css\dashboardStylesheet.css">
    <title>Dashboard</title>
</head>
<body>
<!-- add routes in href, see welcome blade -->
<ul>
    <li><a class="active" href="{{route('dashboard')}}">Home</a></li>
    <li><a href="{{url('/Teams')}}">Teams</a></li> 
    <li><a href="{{url('/Connections')}}">Connections</a></li>
    <li><a href="{{route('projects.index')}}">Projects</a></li>
    <li><a href="{{url('/Tasks')}}">Tasks</a></li>
    <li><a href="{{url('/Timeline')}}">Timeline</a></li>

</ul> 
</body>
</html>