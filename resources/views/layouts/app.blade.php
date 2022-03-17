<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link rel="icon" href="/image/icon.png" type="image-vi/png" sizes="16x16">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'WorldEye') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Add icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" >
    <style>
        ::-webkit-scrollbar {
            display: none; 
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body, html {
            height: 100%;
        }
        .image-vi-bg{
            background-position: center;
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-attachment: fixed;
            border-radius:0;
        }
        
        .full-page {
            top: 0;
            padding:30px;
            height: 100%;
            width: 100%;
        }
        .navbar {
            display: flex;
            align-items: center;
            padding: 20px;
            padding-left: 50px;
            padding-right: 30px;
            position:fixed;
            z-index:1;
        }
        nav {
            margin-left:15px;
            flex: 1;
            text-align: right;
        }
        nav ul{
            display: inline-block;
            list-style: none;
            margin-left:650px;
        }
        nav ul li{  
            display: inline-block;
            margin-left: 30px;
        }
        nav ul li a{
            text-decoration: none;
            font-size: 15px;
            color: #C0392B;
            font-family: sans-serif;
        }
        nav ul li button{
            font-size: 15px;
            color: black;
            outline: none;
            border: none;
            background: transparent;
            cursor: pointer;
            font-family: sans-serif;
        }
        nav ul li button:hover {
            color: black;
        }
        nav ul li a:hover {
            color: #922B21;
        }
        #app{
            overflow-y: scroll;
            background-image-vi:#ECF0F1;
            background-size:cover;
            background-position: center;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-attachment: fixed;
            border-radius:0;
        }
        #profile:hover{
            background-color:white;
            color:black;
        }
        #logout:hover{
            background-color:white;
            color:black;
        }
        #profile{
            background-color:black;
            color:white;
        }
        #logout{
            background-color:black;
            color:white;
        }

        .card-header{
            background-color:white;
            border:none;
            font-size:18px;
            font-weight:bold;
        }

        .notefication {
            display:none;
            position:fixed;
            top:100px;
            left:800px;
            overflow-y: scroll;
            width:400px;
            max-height:500px;
            color:black;
            background-color:white;
            border-radius:5px;
            border:1px solid #A6ACAF;
            padding:10px;
            font-size:15px;
            z-index: 3;
        }
        a{
            cursor: pointer;
        }

        .VC{
            margin-top:-550px;
            display:none;
        }

        div img{
            text-align:right;
        }

        .image-vi {
            width:600px;
            height:450px;
            background-color:white;  
            border-bottom-right-radius:5px !important;
            border-top-right-radius:5px !important;
        }

        .divComment{
            width:400px;
            height:450px;
            margin-left:50px;
            border-bottom-left-radius:5px !important;
            border-top-left-radius:5px !important; 
            color:white;
            overflow-x: hidden;
            overflow-y: auto;
            text-align:justify;
            padding:30px;
            background-color:transparent;
        }
        #save{
            color: transparent;            
            transition: all .3s ease;
            text-decoration: none;
        }

        .fa-plus{
            margin-left:1150px; 
            margin-top:60px;
            color:red;
            cursor: pointer;
            margin-right:50px;
        }

        .divView{
            margin-top:20px;
            margin-left:80px; 
        }

        p:focus{
            outline:none;
        }
        
    </style>
    @yield('style')
</head>
<body>

    <div id="app">
        <nav class="navbar navbar-expand-md ">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}" style="text-decoration: none; color: black; font-size: 50px; cursor: pointer; font-size:30px; color:#922B21; font-weight:bold;">
                    {{ config('app.name', 'WorldEye') }}
                </a>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <!-- Important -->
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" style="font-weight:bold;" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" style="font-weight:bold;" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li>
                                <div style="margin-top:17px; color:#C0392B;">
                                    <a href="{{ route('home') }}" style="color:#C0392B; font-weight:bold; text-decoration:none;">Home</a>
                                </div>
                            </li>
                            <li>
                                <div style="margin-top:17px; color:#C0392B;">
                                    <a class="fa fa-bell" style="color:#C0392B; font-weight:bold; text-decoration:none;"></a>
                                    <p id="noteNumber" style="margin-top:-8px;color:green; font-size:10px; font-weight:bold;"></p>
                                </div>
                            </li>
                            <li class="nav-item dropdown" >
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" style="margin-top:10px; font-weight:bold;" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="background-color:black;">
                                    <a id="profile"  class="dropdown-item" href="{{ route('profile', auth()->user()->id) }}" onclick="event.preventDefault(); document.getElementById('profile-form').submit();">
                                        Profile
                                    </a>
                                    <a id="logout" class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                    <form id="profile-form" action="{{ route('profile', auth()->user()->id) }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <!-- notefication -->
    <div class="notefication">
        
    </div>
    
    <div class="VC">
        <div class="divView" style="display:flex">
            <img class="image-vi" src="">
            <div class="divComment">
                
            </div>
        </div>
    </div>
</body>
</html>
@yield('scripts')
