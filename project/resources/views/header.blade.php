<!DOCTYPE html>
    <html lang="en">
        <head>
            <title>MONSTA</title>
            <link rel="icon" href="{!!asset('images/icon.png')!!}"/>
            <meta charset="utf-8"> 
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
            <style>
            .navbar-default .navbar-nav > li > a:hover, 
            .navbar-default .navbar-nav > li > a:focus 
            {
                background-color: red;
                color: white;
            }

            .navbar .nav > li > a 
            {
                color: black;
            }

            .navbar-btn 
            {
                border-color: transparent;
                text-transform: uppercase;
            }

            .navbar-btn:hover 
            {
                color: white;
                background-color: red;
                border-color: transparent;
            }

            /* Dropdown Button */
            .dropbtn 
            {
                background-color: white;
                color: white;
                padding: 16px;
                border: none;
                cursor: pointer;
            }

            /* The container <div> - needed to position the dropdown content */
            .dropdown 
            {
                position: relative;
                display: inline-block;
            }

            /* Dropdown Content (Hidden by Default) */
            .dropdown-menu 
            {
                display: none;
                position: absolute;
                background-color: white;
                min-width: 160px;
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                z-index: 1;
            }

            /* Links inside the dropdown */
            .dropdown-menu a 
            {
                color: black;
                padding: 12px 16px;
                text-decoration: none;
                display: block;
            }

            /* Change color of dropdown links on hover */
            .dropdown-menu a:hover 
            {
                background-color: red !important;
                color: white !important;
            }

            /* Show the dropdown menu on hover */
            .dropdown:hover .dropdown-menu 
            {
                display: block;
            }

            /* Change the background color of the dropdown button when the dropdown content is shown */
            .dropdown:hover .dropbtn 
            {
                background-color: red;
                color: white;
            }
        </style>
        </head>

        <body>
            <nav class = "navbar navbar-default navbar-fixed-top" style = "background-color: white">
                <div class = "container-fluid">
                    <div class = "navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                   
                        </button>
                        <a class = "navbar-brand" href = "{{ url('home') }}">
                            <img src = "{{ asset('images/slogo.png') }}" class = "img-rounded" alt = "slogo" width = "110" height = "30"/>
                        </a>
                    </div>

                    <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class = "nav navbar-nav">
                            <li>
                                <a href = "{{ url('home') }}">Home</a>
                            </li>
                            <li>
                                <a href = "{{ url('aboutus') }}">About Us</a>
                            </li>

                            <li class = "dropdown">
                                <a href = "#" data-toggle = "dropdown" class = "dropbtn">Activities<b class = "caret"></b></a>
                                <ul class = "dropdown-menu">
                                    <li><a href = "{{ url('events') }}">Upcoming Activities</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href = "{{ url('gallery') }}">Gallery</a>
                            </li>

                            <li>
                                <a href = "{{ url('forum') }}">Forum</a>
                            </li>

                            <li>
                                <a href = "{{ url('dashboard') }}">Dashboard</a>
                            </li>
                        </ul>

                        <ul class = "nav navbar-nav navbar-right">
                            <li>
                                <button type = "submit" class = "btn btn-default navbar-btn login-btn" onclick="window.location ='{{ url("/signup")}}'"><span class="glyphicon glyphicon-user"></span>Sign Up</button>
                            </li>
                            <li>
                                <button type = "submit" class = "btn btn-default navbar-btn login-btn" onclick="window.location ='{{ url("/signin")}}'"><span class="glyphicon glyphicon-log-in"></span> Sign In</button>
                            </li>
                            <li>
                                <button type = "submit" class = "btn btn-default navbar-btn login-btn" onclick="window.location ='{{ url("/logout")}}'"><span class="glyphicon glyphicon-off"></span>Log Out</button>
                            </li>
                        </ul>  
                    </div>
                </div>
            </nav>
            @yield('content')
    </body>
</html>