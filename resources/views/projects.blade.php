<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="\css\projectStylesheet.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Projects</title>
</head>

<body>
    <nav>
        <ul>
            <li><a href="{{ route('dashboard') }}">Home</a></li>
            <li><a href="{{ route('teams.index') }}">Teams</a></li> 
            <li><a href="{{ route('connections.index') }}">Connections</a></li>
            <li><a class="active" href="{{ route('projects.index') }}">Projects</a></li>
            <li><a href="{{ route('tasks.index') }}">Tasks</a></li>
            <li><a href="{{ route('timeline.index') }}">Timeline</a></li>
        </ul>
    </nav>
    <!-- add user name variable -->
    <main>
        @php
        $now = new \DateTime();
        $upcomingProjectsCount = 0;
        $missedDeadlinesCount = 0;
        @endphp
        @foreach ($projects as $project)
        @php
        $deadline = new \DateTime($project->due_date);
        $interval = $now->diff($deadline);
        $daysUntilDeadline = (int)$interval->format('%R%a');

        if ($daysUntilDeadline < 0) {; $missedDeadlinesCount++; } else if ($daysUntilDeadline <=7) {; $upcomingProjectsCount++; } @endphp @endforeach <h1>Projects </h1>
            <h2>Upcoming: {{ $upcomingProjectsCount}}</h2>
            <h2>Missed deadlines: {{ $missedDeadlinesCount }}</h2>
            <h2>Total: {{$projectsCount}}</h2>
            <a class="button" href="{{ route('projects.create') }}">
            <i class="material-icons">add_circle</i>New Project
             </a>

            <div class="projects-container">
                <!-- sets color of box depending on deadline, code needs fixing! -->
                @foreach ($projects as $project)
                @php
                $deadline = new \DateTime($project->due_date);
                $now = new \DateTime();
                $interval = $now->diff($deadline);
                $daysUntilDeadline = (int)$interval->format('%R%a');

                if($deadline==NULL) $class = 'no-deadline';
                else if ($daysUntilDeadline < 0) { $class='deadline-past' ; } elseif ($daysUntilDeadline <=7) { $class='deadline-soon' ; } else { $class='deadline-far' ; } @endphp <div class="project_box {{ $class }}">
                    <p class="project_text">{{ $project->name }}</p>
                    <p class="project_due_date">{{ $project->due_date }}</p>
                    <p class="project_days_left">{{ $daysUntilDeadline }} days left</p>
                    <a class="buttonView" href="{{ route('projects.show', ['project' => $project->id]) }}">
                    View Project</a>
            </div>
            @endforeach
            </div>

    </main>
</body>

</html>