<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="\css\homepageStylesheet.css">
    <title>Document</title>
</head>

<body>
    <div class="split" id="main">
        <h1>Welcome to <span style="color:#1a2185;">Oplan!</span></h1>
        <form>
        <a class="button" href="{{ route('login') }}">Login</a>
        <a class="button" href="{{ route('register') }}">Register</a>
        </form>
        <div class="dropdown">
        <button class="dropbtn">Dropdown</button>
        <div class="dropdown-content">
            <a href="#link1">Link 1</a>
            <a href="#link2">Link 2</a>
            <a href="#link3">Link 3</a>
        </div>
    </div>
    </div>
    <br>
    <div class="split">
        <div id="column" class ="txtDiv">
            <h2>What is Oplan?</h2>
            <p id="intro">Oplan is an online platform designed to coordinate and simplify team collaboration and project management. Our mission is to empower teams of all sizes to work together more efficiently, creating a productive and engaging environment.<br>
                <br>
                <em>Created and designed by Baiba Bērziņa and Ēriks Krallišs.</em>
            </p>
        </div>
        <div id="column" class ="imgDiv">
        <a href="https://www.pexels.com/photo/people-near-table-3184639/" target="_blank" title="People near table by fauxels"><img src="\images\people-near-table.jpg" alt="Picture of people collaborating"></a>
        </div>
    </div>
</body>

</html>