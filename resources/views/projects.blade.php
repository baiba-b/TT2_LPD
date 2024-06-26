<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="\css\projectStylesheet.css">
    <title>Projects</title>
</head>
<body>
<nav>
    <ul>
        <li><a href="{{url('/dashboard')}}">Home</a></li>
        <li><a href="{{url('/Teams')}}">Teams</a></li> 
        <li><a href="{{url('/Connections')}}">Connections</a></li>
        <li><a class="active" href="{{route('projects.index')}}">Projects</a></li>
        <li><a href="{{url('/Tasks')}}">Tasks</a></li>
        <li><a href="{{url('/Timeline')}}">Timeline</a></li>
    </ul>
</nav>
<!-- add user name variable -->
<main>
    <h1>Projects</h1>
    <h2>Completed: </h2>
    <h2>In progress: </h2>
    <h2>Not started: </h2>
    <h2>Upcoming: </h2>
    <h2>Total: </h2>

    <div class="projects-container">
        <!-- sets color of box depending on deadline, code needs fixing! -->
@foreach ($projects as $project) 
            @php
            $deadline = new \DateTime($project->due_date);
                $now = new \DateTime();
                $interval = $now->diff($deadline);
                $daysUntilDeadline = (int)$interval->format('%R%a');

                if ($daysUntilDeadline < 0) {
                    $class = 'deadline-past';
                } elseif ($daysUntilDeadline <= 7) {
                    $class = 'deadline-soon';
                } else {
                    $class = 'deadline-far';
                }
            @endphp

        <div class="project_box {{ $class }}">
            <p class="project_text">{{ $project->name }}</p>
            <p class="project_due_date">{{ $project->due_date }}</p>
            <p class="project_days_left">{{ $daysUntilDeadline }} days left</p>
        </div>
@endforeach
    </div>

</main>
</body>
</html>