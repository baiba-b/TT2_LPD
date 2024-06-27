<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/tasksStylesheet.css') }}">
    <link rel="stylesheet" href="\css\navbarStylesheet.css">
    <link rel="stylesheet" href="\css\dropdownStylesheet.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Edit Task</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="{{ url('/profile') }}" class="circle-button">
                <i class="material-icons">account_circle</i>
            </a></li>
            <li><a href="{{ route('dashboard') }}">Home</a></li>
            <li><a href="{{ route('connections.index') }}">Connections</a></li>
            <li><a href="{{ route('projects.index') }}">Projects</a></li>
            <li><a class="active" href="{{ route('tasks.index') }}">Tasks</a></li>
            <li><a href="{{ url('/Timeline') }}">Timeline</a></li>
        </ul>
    </nav>
    <main>
        <h1>Edit Task</h1>
        <form action="{{ route('tasks.update', $task->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Task Name</label>
                <input type="text" name="name" id="name" value="{{ $task->name }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" required>{{ $task->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="due_date">Due Date</label>
                <input type="date" name="due_date" id="due_date" value="{{ $task->due_date }}" required>
            </div>
            <div class="form-group">
                <label for="estimated_workload">Estimated Workload (minutes)</label>
                <input type="number" name="estimated_workload" id="estimated_workload" value="{{ $task->estimated_workload }}" required>
            </div>
            <button type="submit">Update Task</button>
        </form>
    </main>
</body>
</html>