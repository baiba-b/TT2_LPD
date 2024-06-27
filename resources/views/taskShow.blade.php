<!DOCTYPE html>
<html lang="en">
<head>
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/projectStylesheet.css') }}">
    <link rel="stylesheet" href="{{ asset('css/showStylesheet.css') }}">
    <link rel="stylesheet" href="\css\navbarStylesheet.css">

    <title>{{ $task->name }}</title>
</head>
<body>

    <nav>
        <ul>
            <li><a href="{{ route('dashboard') }}">Home</a></li>
            <li><a href="{{ route('connections.index') }}">Connections</a></li>
            <li><a href="{{ route('projects.index') }}">Projects</a></li>
            <li><a class="active" href="{{ route('tasks.index') }}">Tasks</a></li>
            <li><a href="{{ url('/Timeline') }}">Timeline</a></li>
        </ul>
    </nav>
    <main>
        <div class="info">
            <h1>{{ $task->name }}</h1>
            <p>{{ $task->description }}</p>
            <p>Estimated Workload: {{ formatMinutes($task->estimated_workload) }}</p>        
            <p>Invested Time: {{ intdiv($task->invested_time, 60) }} hours {{ $task->invested_time % 60 }} minutes</p>
            <p>Due Date: {{ $task->due_date }}</p>
            <p>Project: {{ $task->project->name ?? 'No project assigned'  }}</p>
            <p>Creator: {{ $task->creator->name ?? 'Unknown' }}</p>
            <p>Last updated: {{ $task->updated_at}}</p>
        </div>

    </main>
</body>
</html>
