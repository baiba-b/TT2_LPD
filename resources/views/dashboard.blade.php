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
            <li><a class="active" href="{{ route('dashboard') }}">@lang('messages.home')</a></li>
            <li><a href="{{ route('connections.index') }}">@lang('messages.connect')</a></li>
            <li><a href="{{ route('projects.index') }}">@lang('messages.Projs')</a></li>
            <li><a href="{{ route('tasks.index') }}">@lang('messages.Tasks')</a></li>
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
                        <p>@lang('messages.workload'): {{ $topProject->estimated_workload}}  @lang('messages.h')</p>
                        @php
                        $deadline = $topProject->due_date ? new \DateTime($topProject->due_date) : null;
                    $now = new \DateTime();
                    $class = 'no-deadline';
                    $daysUntilDeadline = 'N/A';

                    if ($deadline){
                    $interval = $now->diff($deadline);
                    $daysUntilDeadline = (int)$interval->format('%R%a');}

                        @endphp

                        <p>@lang('messages.due') {{$daysUntilDeadline}} @lang('messages.d')</p>
                        <p>{{floor($topProject->invested_time/$topProject->estimated_workload)}}% @lang('messages.done')</p>
                    </div>
                </div>
                @endforeach

                <div class="section updates">
                    <h3>@lang('messages.upd')</h3>
                    <div class="update-card">
                        <div class="task-color" style="background-color: #008b8b;"></div>
                        <div class="task-info">
                            <h4>Project1</h4>
                            <p>@lang('messages.workload'): 16 @lang('messages.d')</p>
                            <p>54% @lang('messages.done')</p>
                            <p>@lang('messages.completed') @lang('messages.task'): ProjectTask1</p>
                            <p>Cc</p>
                        </div>
                    </div>
                    <div class="update-card">
                        <div class="task-color" style="background-color: #b8860b;"></div>
                        <div class="task-info">
                            <h4>Project2</h4>
                            <p>@lang('messages.workload'): 130 @lang('messages.d')</p>
                            <p>12% @lang('messages.done')</p>
                            <p>@lang('messages.updDesc') ProjectTask2</p>
                            <p>Dd</p>
                        </div>
                    </div>
                </div>
        </section>
        <section class="center-panel">
            <h3>@lang('messages.main') @lang('messages.proj')</h3>
            <div class="main-project">
                <h4>Project3</h4>
                <p>@lang('messages.workload'): 13 @lang('messages.d')</p>
                <p>90% @lang('messages.done')</p>
            </div>
            <div class="section active-tasks">
                <h3>@lang('messages.act') @lang('messages.proj') @lang('messages.tasks')</h3>
                <div class="task-card">
                    <div class="task-color" style="background-color: #ff6347;"></div>
                    <div class="task-info">
                        <h4>Task1</h4>
                        <p>@lang('messages.workload'): 1 @lang('messages.h')</p>
                        <p>4% @lang('messages.done')</p>
                        <p>@lang('messages.due') 2 @lang('messages.d')</p>
                        <p>@lang('messages.asgnTo'): Aa</p>
                    </div>
                </div>
                <div class="task-card">
                    <div class="task-color" style="background-color: #9acd32;"></div>
                    <div class="task-info">
                        <h4>Task2</h4>
                        <p>@lang('messages.workload'): 12 @lang('messages.h')</p>
                        <p>78% @lang('messages.done')</p>
                        <p>@lang('messages.due') 5 @lang('messages.h')</p>
                        <p>@lang('messages.asgnTo'): Cc</p>
                    </div>
                </div>
                <div class="task-card">
                    <div class="task-color" style="background-color: #ff4500;"></div>
                    <div class="task-info">
                        <h4>Task3</h4>
                        <p>@lang('messages.workload'): 30 @lang('messages.min')</p>
                        <p>50% @lang('messages.done')</p>
                        <p>@lang('messages.due') 12 @lang('messages.d')</p>
                        <p>@lang('messages.asgnTo'): @lang('messages.you')</p>
                    </div>
                </div>
            </div>
            <div class="section completed-tasks">
                <h3>@lang('messages.completed')</h3>
                <div class="task-card">
                    <div class="task-color" style="background-color: #20b2aa;"></div>
                    <div class="task-info">
                        <h4>Task4</h4>
                        <p>@lang('messages.asgnTo'): Cc</p>
                    </div>
                </div>
                <div class="task-card">
                    <div class="task-color" style="background-color: #32cd32;"></div>
                    <div class="task-info">
                        <h4>Task5</h4>
                        <p>@lang('messages.asgnTo'): @lang('messages.you')</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="right-panel">
            <div class="actions">
                <a href="{{ route('tasks.create') }}"><h3>@lang('messages.create') @lang('messages.task')</h3></a>
                <a href="{{ route('projects.create') }}"><h3>@lang('messages.create') @lang('messages.proj')</h3></a>
                <a href="{{ route('profile.edit') }}"><h3>@lang('messages.settings')</h3></a>
            </div>
            <div class="section friend-activity">
                <h3>@lang('messages.friend') @lang('messages.acty')</h3>
                <div class="friend-card">
                    <img src="default_profile_picture.png" alt=@lang('messages.pp') class="friend-picture">
                    <div class="friend-info">
                        <p>Bb</p>
                        <p>@lang('messages.completed') @lang('messages.task'): HisTask1</p>
                    </div>
                </div>
                <div class="friend-card">
                    <img src="default_profile_picture.png" alt=@lang('messages.pp') class="friend-picture">
                    <div class="friend-info">
                        <p>Aa</p>
                        <p>@lang('messages.crtNew') @lang('messages.task'): HerTask1</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

</html>

</html>