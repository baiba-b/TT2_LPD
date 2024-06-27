<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/tasksStylesheet.css') }}">
    <link rel="stylesheet" href="\css\navbarStylesheet.css">
    <link rel="stylesheet" href="\css\dropdownStylesheet.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Tasks</title>
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
        <h1>Tasks</h1>
        <a class="buttonC" href="{{ route('tasks.create') }}">
            <i class="material-icons">add_circle</i> New Tasks
        </a>

        <form action="#" method="post">
            @csrf
            <div class="tasks-container">
                @if ($tasks && count($tasks) > 0)
                    @foreach ($tasks as $task)
                   
                        <div class="task_box">
                            <div><label class="container"><input type="checkbox" ><span class="checkmark"></span></label></div>
                            <div class ="box-items">
                                <div class="dropdown" style="float:right;">
                                    <a class="dropbtn"><i class="material-icons" style="font-size: 1.5em;">more_vert</i></a>
                                    <div class="dropdown-content">
                                        <a  href="{{ route('tasks.edit', $task->id) }}">
                                            <i class="material-icons" style="font-size: 1.1em;">edit</i>  Edit
                                        </a>
                                        <a href="#">Link 2</a>
                                    </div>
                                </div>
                            
                                <label for="task-{{ $task->id }}">
                                    <h2>{{ $task->name }}</h2>
                                    <p>Estimated Workload: {{ intdiv($task->estimated_workload, 60) }} hours {{ $task->estimated_workload % 60 }} minutes</p>
                                    <p>Due Date: {{ $task->due_date }}</p>
                                    <p>Project: {{ $task->project->name ?? 'No project assigned'  }}</p>
                                    <a class="buttonView" href="{{ route('tasks.show', ['task' => $task->id]) }}">View Task</a>
                                </label>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>No tasks found.</p>
                @endif
            </div>
            <button type="submit" id="submit">Submit</button>
        </form>
    </main>
</body>
</html>
