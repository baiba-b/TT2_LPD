<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="\css\dashboardStylesheet.css">
    <link rel="stylesheet" href="\css\navbarStylesheet.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Dashboard</title>
</head>

<body>
    <!-- add routes in href, see welcome blade -->
    <nav>
        <ul>
            <li><a class="active" href="{{ route('dashboard') }}">Home</a></li>
            <li><a href="{{ route('connections.index') }}">Connections</a></li>
            <li><a href="{{ route('projects.index') }}">Projects</a></li>
            <li><a href="{{ route('tasks.index') }}">Tasks</a></li>
            <li><a href="{{url('/Timeline')}}">Timeline</a></li>
            <li>
                <a href="{{ url('/profile') }}" id="profile-info">
                    @if(Auth::user()->profile_picture)
                    <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt=@lang('messages.pp') class="exception" style="width: 35px; height: 35px;">
                    @else
                    <img src="{{ asset('images/default_profile_picture.png') }}" alt=@lang('messages.pp') class="exception" style="width: 35px; height: 35px;">
                    @endif
                    <span class="profile-name">{{ Auth::user()->name }}</span>
                </a>
            </li>

        </ul>
    </nav>
    <main class="dashboard">
        <section class="left-panel">
            <div class="profile">
                <img src="default_profile_picture.png" alt="Profile Picture" class="profile-picture">
                <div class="profile-info">
                        @if(Auth::user()->name) <h2>{{Auth::user()->name}}</h2>
                        @else 
                        <h2>@lang('messages.name')</h2>
                        @endif
                    <p>15 @lang('messages.act') @lang('messages.tasks')</p>
                    <a href="#">@lang('messages.profile')</a>
                </div>
            </div>
            <div class="section most-urgent-tasks">
                <h3>@lang('messages.mstUrg') @lang('messages.tasks')</h3>
                @foreach($topProjects as $topProject)
                <div class="task-card">
                    <div class="task-color" style="background-color: {{ $topProject->random_color;}}"></div>
                    <div class="task-info">
                        <h4>{{$topProject->name }}</h4>
                        <p>@lang('messages.workload'): {{ $topProject->estimated_workload}}@lang('messages.hrs')</p>
                        @php
                        $deadline = $topProject->due_date ? new \DateTime($topProject->due_date) : null;
                    $now = new \DateTime();
                    $class = 'no-deadline';
                    $daysUntilDeadline = 'N/A';

                    if ($deadline){
                    $interval = $now->diff($deadline);
                    $daysUntilDeadline = (int)$interval->format('%R%a');}

                        @endphp

                        <p>@lang('messages.due'){{$daysUntilDeadline}} days</p>
                        <p>{{floor($topProject->invested_time/$topProject->estimated_workload)}}% done</p>
                    </div>
                </div>
                @endforeach

                <div class="section updates">
                    <h3>Updates</h3>
                    <div class="update-card">
                        <div class="task-color" style="background-color: #008b8b;"></div>
                        <div class="task-info">
                            <h4>Project1</h4>
                            <p>Workload: 16 days</p>
                            <p>54% done</p>
                            <p>Completed task: ProjectTask1</p>
                            <p>Cc</p>
                        </div>
                    </div>
                    <div class="update-card">
                        <div class="task-color" style="background-color: #b8860b;"></div>
                        <div class="task-info">
                            <h4>Project2</h4>
                            <p>Workload: 130 days</p>
                            <p>12% done</p>
                            <p>Updated description of ProjectTask2</p>
                            <p>Dd</p>
                        </div>
                    </div>
                </div>
        </section>
        <section class="center-panel">
            <h3>Main project</h3>
            <div class="main-project">
                <h4>Project3</h4>
                <p>Workload: 13 days</p>
                <p>90% done</p>
            </div>
            <div class="section active-tasks">
                <h3>Active project tasks</h3>
                <div class="task-card">
                    <div class="task-color" style="background-color: #ff6347;"></div>
                    <div class="task-info">
                        <h4>Task1</h4>
                        <p>Workload: 1h</p>
                        <p>4% done</p>
                        <p>Due in 2 days</p>
                        <p>Assigned to: Aa</p>
                    </div>
                </div>
                <div class="task-card">
                    <div class="task-color" style="background-color: #9acd32;"></div>
                    <div class="task-info">
                        <h4>Task2</h4>
                        <p>Workload: 12h</p>
                        <p>78% done</p>
                        <p>Due in 5h</p>
                        <p>Assigned to: Cc</p>
                    </div>
                </div>
                <div class="task-card">
                    <div class="task-color" style="background-color: #ff4500;"></div>
                    <div class="task-info">
                        <h4>Task3</h4>
                        <p>Workload: 30min</p>
                        <p>50% done</p>
                        <p>Due in 12 days</p>
                        <p>Assigned to: You</p>
                    </div>
                </div>
            </div>
            <div class="section completed-tasks">
                <h3>Completed</h3>
                <div class="task-card">
                    <div class="task-color" style="background-color: #20b2aa;"></div>
                    <div class="task-info">
                        <h4>Task4</h4>
                        <p>Assigned to: Cc</p>
                    </div>
                </div>
                <div class="task-card">
                    <div class="task-color" style="background-color: #32cd32;"></div>
                    <div class="task-info">
                        <h4>Task5</h4>
                        <p>Assigned to: You</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="right-panel">
            <div class="actions">
                <h3>Create task</h3>
                <h3>Create project</h3>
                <h3>Settings</h3>
            </div>
            <div class="section friend-activity">
                <h3>Friend activity</h3>
                <div class="friend-card">
                    <img src="default_profile_picture.png" alt="Friend Profile Picture" class="friend-picture">
                    <div class="friend-info">
                        <p>Bb</p>
                        <p>Completed task: HisTask1</p>
                    </div>
                </div>
                <div class="friend-card">
                    <img src="default_profile_picture.png" alt="Friend Profile Picture" class="friend-picture">
                    <div class="friend-info">
                        <p>Aa</p>
                        <p>Created new task: HerTask1</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

</html>

</html>