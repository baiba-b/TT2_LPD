<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/tasksStylesheet.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Tasks</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="{{ url('/profile') }}" class="circle-button">
                <i class="material-icons">account_circle</i>
            </a></li>
            <li><a class="active" href="{{ route('dashboard') }}">Home</a></li>
            <li><a href="{{ route('connections.index') }}">Connections</a></li>
            <li><a href="{{ route('projects.index') }}">Projects</a></li>
            <li><a href="{{ route('tasks.index') }}">Tasks</a></li>
            <li><a href="{{ url('/Timeline') }}">Timeline</a></li>
        </ul>
    </nav>
    <main>
        <h1>Tasks</h1>
        <form action="#" method="post">
            @csrf
            <div class="tasks-container">
                @if ($tasks && count($tasks) > 0)
                    @foreach ($tasks as $task)
                        <div class="task_box">
                            <input type="checkbox" id="task-{{ $task->id }}" name="tasks[]" value="{{ $task->id }}">
                            <label for="task-{{ $task->id }}">
                                <h2>{{ $task->name }}</h2>
                                <p>{{ $task->description }}</p>
                                <p>Estimated Workload: {{ intdiv($task->estimated_workload, 60) }} hours {{ $task->estimated_workload % 60 }} minutes</p>
                                <p>Invested Time: {{ intdiv($task->invested_time, 60) }} hours {{ $task->invested_time % 60 }} minutes</p>
                                <p>Due Date: {{ $task->due_date }}</p>
                                <p>Project: {{ $task->project->name ?? 'No project assigned'  }}</p>
                            </label>
                        </div>
                    @endforeach
                @else
                    <p>No tasks found.</p>
                @endif
            </div>
            <button type="submit">Submit</button>
        </form>
    </main>
</body>
</html>
