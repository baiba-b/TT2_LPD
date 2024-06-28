<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="\css\homepageStylesheet.css">
    <link rel="stylesheet" href="\css\dropdownStylesheet.css">
    <title>Document</title>
</head>

<body>
    <div class="split" id="main">
        <h1>@lang('messages.greet')<span style="color:#1a2185;">Oplan!</span></h1>
        <div style="display:flex;flex-direction:row; min-width:20%">
            <form>
                <a class="button" href="{{ route('login') }}">@lang('messages.login')</a>
                <a class="button" href="{{ route('register') }}">@lang('messages.register')</a>
            </form>
            <div class="dropdown">
                <button class="dropbtn">@lang('messages.lang')</button>
                <div class="dropdown-content">
                    <a href="locale/en">English</a>
                    <a href="locale/lv">Latviski</a>
                    <a href="locale/aa">AAA</a>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="split">
        <div id="column" class="txtDiv">
            <h2>@lang('messages.question')Oplan?</h2>
            <p id="intro">@lang('messages.intro')<br>
                <br>
                <em>@lang('messages.devs')</em>
            </p>
        </div>
        <div id="column" class="imgDiv">
            <a href="https://www.pexels.com/photo/people-near-table-3184639/" target="_blank" title="People near table by fauxels"><img src="\images\people-near-table.jpg" alt="Picture of people collaborating"></a>
        </div>
    </div>
</body>

</html>