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
            <li><a href="{{ route('dashboard') }}">Home</a></li>
            <li><a href="{{ route('connections.index') }}">Connections</a></li>
            <li><a href="{{ route('projects.index') }}">Projects</a></li>
            <li><a class="active" href="{{ route('tasks.index') }}">Tasks</a></li>
            <li>
                <a href="{{ url('/profile') }}" id="profile-info">
                    @if(Auth::user()->profile_picture)
                    <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile Picture" class="exception" style="width: 35px; height: 35px;">
                    @else
                    <img src="{{  asset('default_profile_picture.png')}}" alt="Default Profile Picture" class="exception" style="width: 35px; height: 35px;">
                    @endif
                    <span class="profile-name">{{ Auth::user()->name }}</span>
                </a>
            </li>
        </ul>
    </nav>
    <main>
        <h1>Tasks</h1>
        <a class="buttonC" href="{{ route('tasks.create') }}">
            <i class="material-icons" id="add">add_circle</i> New Tasks
        </a>

        <div class="tasks-container">
            @if ($tasks && count($tasks) > 0)
            @foreach ($tasks as $task)

            <div class="task_box">
                <div>
                    <label class="container">
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="box-items">
                    <div class="dropdown" style="float:right;">
                        <a class="dropbtn"><i class="material-icons" style="font-size: 1.5em;">more_vert</i></a>
                        <div class="dropdown-content">
                            @can('update-task', $task)
                            <a href="{{ route('tasks.edit', $task->id) }}">
                                <i class="material-icons" style="font-size: 1.1em;">edit</i> Edit
                            </a>
                            @endcan

                            @can('update-task', $task)
                            <form method="POST" action="{{ route('tasks.destroy', $task->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropbtn" id="delete">
                                    <i class="material-icons" style="font-size: 1.1em;" id="deleteI">delete</i> Delete
                                </button>
                            </form>
                            @endcan

                            <a href="{{ route('tasks.participants', $task->id) }}">
                                <i class="material-icons" style="font-size: 1.1em;">group</i> Manage group
                            </a>
                        </div>
                    </div>

                    <label for="task-{{ $task->id }}">
                        <h2>{{ $task->name }}</h2>
                        <p>Estimated Workload: {{ intdiv($task->estimated_workload, 60) }} hours {{ $task->estimated_workload % 60 }} minutes</p>
                        <p>Due Date: {{ $task->due_date }}</p>
                        <p>Project: {{ $task->project->name ?? 'No project assigned' }}</p>
                        <a class="buttonView" href="{{ route('tasks.show', ['task' => $task->id]) }}">View Task</a>
                    </label>

                    <form method="POST" action="{{ route('tasks.addInvestedTime', $task->id) }}" class="invested-time-form">
                        @csrf
                        <div class="form-group">
                            <label for="invested_time_{{ $task->id }}">Add Invested Time:</label>
                            <input type="number" name="invested_time" id="invested_time_{{ $task->id }}" min="0" placeholder="Minutes">
                            <button type="submit" class="add-invested-time-btn">Add Time</button>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach
            @else
            <p>No tasks found.</p>
            @endif
        </div>
    </main>
</body>

</html>
