<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/projectStylesheet.css') }}">
    <link rel="stylesheet" href="{{ asset('css/showStylesheet.css') }}">
    <title>{{ $project->name }}</title>
</head>
<body>
@php
    function formatMinutes($minutes) {
    if ($minutes < 0) {
        return 'Invalid input: minutes cannot be negative';
    }

    $days = floor($minutes / 1440);
    $hours = floor(($minutes % 1440) / 60);
    $remainingMinutes = $minutes % 60;

    return sprintf('%d d %02d h %02d m', 
                   $days, $days == 1 ? '' : 's', 
                   $hours, $hours == 1 ? '' : 's', 
                   $remainingMinutes, $remainingMinutes == 1 ? '' : 's');
}
    @endphp
    <nav>
        <ul>
            <li><a href="{{ route('dashboard') }}">Home</a></li>
            <li><a href="{{ route('connections.index') }}">Connections</a></li>
            <li><a class="active"  href="{{ route('projects.index') }}">Projects</a></li>
            <li><a href="{{ route('tasks.index') }}">Tasks</a></li>
            <li><a href="{{ url('/Timeline') }}">Timeline</a></li>
        </ul>
    </nav>
    <main>
        <h1>{{ $project->name }}</h1>
        <p>{{ $project->description }}</p>
        <p>Due Date: {{ $project->due_date }}</p>
        <p>Estimated Workload: {{ formatMinutes($project->estimated_workload) }}</p>



    </main>
</body>
</html>