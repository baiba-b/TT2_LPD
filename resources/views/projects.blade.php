<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="\css\projectStylesheet.css">
    <link rel="stylesheet" href="\css\navbarStylesheet.css">
    <link rel="stylesheet" href="\css\dropdownStylesheet.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <title>Projects</title>
</head>

<body>
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
    <main>
        @php
        function formatMinutes($minutes) {
        if (!is_numeric($minutes) || $minutes < 0) { return 'Invalid input: minutes cannot be negative or non-numeric' ; } $days=floor($minutes / 1440); $hours=floor(($minutes % 1440) / 60); $remainingMinutes=$minutes % 60; return sprintf('%d d %02d h %02d m', $days, $days==1 ? '' : 's' , $hours, $hours==1 ? '' : 's' , $remainingMinutes, $remainingMinutes==1 ? '' : 's' ); } @endphp @php $now=new \DateTime(); $upcomingProjectsCount=0; $missedDeadlinesCount=0; @endphp @foreach ($projects as $project) @php $deadline=$project->due_date ? new \DateTime($project->due_date) : null;
            if ($deadline) {
            $interval = $now->diff($deadline);
            $daysUntilDeadline = (int)$interval->format('%R%a');

            if ($daysUntilDeadline < 0) { $missedDeadlinesCount++; } elseif ($daysUntilDeadline <=7) { $upcomingProjectsCount++; } } @endphp @endforeach <h1>Projects</h1>
                <h2>Upcoming: {{ $upcomingProjectsCount }}</h2>
                <h2>Missed deadlines: {{ $missedDeadlinesCount }}</h2>
                <h2>Total: {{ $projectsCount }}</h2>
                <a class="button" href="{{ route('projects.create') }}">
                    <i class="material-icons" style="font-size: 1.5rem;">add_circle</i>New Project
                </a>

                <div class="projects-container">


                    @foreach ($projects as $project)
                    @php
                    $deadline = $project->due_date ? new \DateTime($project->due_date) : null;
                    $now = new \DateTime();
                    $class = 'no-deadline';
                    $daysUntilDeadline = 'N/A';

                    if ($deadline){
                    $interval = $now->diff($deadline);
                    $daysUntilDeadline = (int)$interval->format('%R%a');

                    if ($daysUntilDeadline < 0) { $class='deadline-past' ; } elseif ($daysUntilDeadline <=7) { $class='deadline-soon' ; } else { $class='deadline-far' ; } } @endphp <div class="project_box {{ $class }}">
                        <div class="dropdown" style="float:right;">
                            <a class="dropbtn"><i class="material-icons" style="font-size: 1.5em;">more_vert</i></a>
                            <div class="dropdown-content">
                                <a href="{{ route('projects.edit', $project->id) }}">
                                    <i class="material-icons" style="font-size: 1.1em;">edit</i> Edit
                                </a>
                                <form method="POST" action="{{ route('projects.destroy', $project->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropbtn" id="delete">
                                        <i class="material-icons" style="font-size: 1.1em;" id="deleteI">delete</i> Delete
                                    </button>
                                </form>
                                <a href="{{ route('projects.participants', $project->id) }}">
                                    <i class="material-icons" style="font-size: 1.1em;">group</i> Manage group
                                </a>

                            </div>
                        </div>
                        <p class="project_text">{{ $project->name }}</p>
                        <p class="project_due_date">{{ $project->due_date ?? 'No due date set' }}</p>
                        <p class="project_days_left">{{ $daysUntilDeadline }} days left</p>
                        <p class="project_estimated_workload">Estimated Workload:</p>
                        <p> {{ formatMinutes($project->estimated_workload) }}</p>
                        <a class="buttonView" href="{{ route('projects.show', ['project' => $project->id]) }}">View Project</a>

                </div>
                @endforeach

                </div>
    </main>
</body>

</html>