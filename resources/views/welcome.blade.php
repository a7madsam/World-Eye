<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="/image/icon.png" type="image/png" sizes="16x16">

        <title>WorldEye</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- font-awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>

        <!-- Styles -->
        <style>
            .hexagon {
                position: relative;
                width: 150px; 
                height: 86.60px;
                margin: 43.30px 0;
                background-size: auto 173.2051px;
                background-position: center;
                box-shadow: 0 0 20px rgba(0, 0, 0 ,0.8);
            }

            .hexTop,
            .hexBottom {
                position: absolute;
                z-index: 1;
                width: 106.07px;
                height: 106.07px;
                overflow: hidden;
                -webkit-transform: scaleY(0.5774) rotate(-45deg);
                -ms-transform: scaleY(0.5774) rotate(-45deg);
                transform: scaleY(0.5774) rotate(-45deg);
                background: inherit;
                left: 21.97px;
                box-shadow: 0 0 20px rgba(0, 0, 0 ,0.8);
            }

            .hexTop:after,
            .hexBottom:after {
                content: "";
                position: absolute;
                width: 150.0000px;
                height: 86.60254037844388px;
                -webkit-transform:  rotate(45deg) scaleY(1.7321) translateY(-43.3013px);
                -ms-transform:      rotate(45deg) scaleY(1.7321) translateY(-43.3013px);
                transform:          rotate(45deg) scaleY(1.7321) translateY(-43.3013px);
                -webkit-transform-origin: 0 0;
                -ms-transform-origin: 0 0;
                transform-origin: 0 0;
                background: inherit;
            }

            .hexTop {
                top: -53.0330px;
            }

            .hexTop:after {
                background-position: center top;
            }

            .hexBottom {
                bottom: -53.0330px;
            }

            .hexBottom:after {
                background-position: center bottom;
            }

            .hexagon:after {
                content: "";
                position: absolute;
                top: 0.0000px;
                left: 0;
                width: 150.0000px;
                height: 86.6025px;
                z-index: 2;
                background: inherit;
            }
            .pictures{
                margin-left:600px;
                margin-top:10%;
            }
            .div-1{
                width:500px;
                margin-top:-400px;
                margin-left:50px;
            }
            input{
                width:200px;
                height:30px;
                border:none;
                border-radius:5px;
                cursor:pointer;
                background-color:#ECF0F1;
            }
            input:hover{
                background-color:#922B21;
                color:white;
            }
            .footer{
                margin-top:230px;
                margin-left:800px;
            }
            h1{
                color:#922B21;
                font-family: sans-serif;
            }

            html{
                background-image:url('/image/welcome.jpg');
                background-size: cover;
                background-repeat: no-repeat;
            }
            a{
                color:black;
            }
        </style>
        <script>
            $(document).ready(function() {
                $('.div-1').on('click' ,'#enter' ,function(e){
                    e.preventDefault();
                    document.location.href = "/login";
                });
            });
        </script>
    </head>
    <body>
        <div class="pictures" > 
            <div class="row">
                <div class="hexagon" style="display:inline-block; background-image: url('/image/1.jpg');">
                    <div class="hexTop"></div>
                    <div class="hexBottom"></div>
                </div>
                <div class="hexagon" style="display:inline-block; background-image: url('/image/2.jpg');">
                    <div class="hexTop"></div>
                    <div class="hexBottom"></div>
                </div>
                <div class="hexagon" style="display:inline-block; background-image: url('/image/3.jpg');">
                    <div class="hexTop"></div>
                    <div class="hexBottom"></div>
                </div>
                <div class="hexagon" style="display:inline-block; background-image: url('/image/4.jpg');">
                    <div class="hexTop"></div>
                    <div class="hexBottom"></div>
                </div>
            </div>
            <div class="row" style="margin-left:77px; margin-top:-43px">
                <div class="hexagon" style="display:inline-block; background-image: url('/image/5.jpg');">
                    <div class="hexTop"></div>
                    <div class="hexBottom"></div>
                </div>
                <div class="hexagon" style="display:inline-block; background-image: url('/image/6.jpg');">
                    <div class="hexTop"></div>
                    <div class="hexBottom"></div>
                </div>
                <div class="hexagon" style="display:inline-block; background-image: url('/image/7.jpg');">
                    <div class="hexTop"></div>
                    <div class="hexBottom"></div>
                </div>
            </div>
        </div>

        <div class="div-1">
            <div class="div-2">
                <h1>WorldEye</h1> <br />
                <h2>Welcome</h2>
                <p>Do you want a place to save photos or share photos with a large network?</p>
                <p>We are the <span>WorldEye</span> family, offer you a place to save images with the feature of sharing them over a wide network from different parts of the world, in addition to displaying high-quality images and many features that distinguish our site from any other site.</p>
            </div>
            <br />
            <input id="enter" value="Enter" type="submit"/>
        </div>

        <div class="footer">
            <span>Design by <span style="font-weight:bold;">WorldEye</span> Team</span>
            <span style="margin-left:50px;">
                <a target="_blank" href="https://www.facebook.com/worldeye547"><i class="fa fa-facebook-square fa-lg"></i></a>
                <a target="_blank" href="https://mail.google.com/mail/u/0/?fs=1&tf=cm&to=worldeye547@gmail.com"><i class="fa fa-envelope-square fa-lg"></i></a>
            </span>
        </div>
    </body>
</html>
