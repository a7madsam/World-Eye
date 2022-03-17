@extends('layouts.app')

@section('style')
    <style>
        .results{
            max-width: 1100px;
            margin: 0 auto;
            margin-top: 40px;
            display: grid;
            grid-gap: 30px;
            grid-template-columns: repeat(auto-fill, 180px);
            grid-auto-rows: minmax(20px, auto);
            justify-content: center;
        }
        #div-img{
            text-align: center; height: 300px; margin-bottom: 20px; margin-top: 40px
        }
        #link{ 
            margin-right: 40px; font-size: 1rem; font-weight: bold; color: white; text-decoration: none;margin-top: 40px;
        }
        #link:hover{
            color:gray;
        }
        .profile-pic {
            border-radius:5px;
            height: 300px;
            width: 300px;
            background-size: cover;
            background-position: center;
            background-blend-mode: multiply;
            text-align: center;
            color: transparent;
            transition: all .3s ease;
            li {
                display: inline-flex;
                padding: .2em;
            }
        }
        .profile-pic:hover {
            background-color: rgba(0,0,0,.5);
            z-index: 10000;
            color: rgba(250,250,250,1);
            transition: all .3s ease;
        }
        .picture:hover > #saveImage{
            background-color: rgba(0,0,0,.5);
            z-index: 10000;
            color: rgba(250,250,250,1);
            transition: all .3s ease;
        }
        .picture:hover {
            background-color: rgba(0,0,0,.5);
            z-index: 10000;
            color: rgba(250,250,250,1);
            transition: all .3s ease;
        }
        .picture{
            width: 100%;
            height: 200px;
            background-size: cover;
            background-position: center;
            background-blend-mode: multiply;
            text-align: center;
            color: transparent;
            border-radius:5px;
            transition: all .3s ease;
            li {
                display: inline-flex;
                padding: .2em;
            }
        }
        #saveButton{
            display:none;
            background-color:#922B21; width:70px; height:31.5px; color:white;
            border-radius:5px;
            border:none;
            margin-left:570px;
        }
        .file-upload{
            display:none;
        }
        .image-upload{
            display:none;

        }
        img {
            max-width: 100%;
            height: auto;
        }
    
        .p-image {
            position: absolute;
            top:110px;
            left:410px;
            color: #666666;
            transition: all .3s cubic-bezier(.175, .885, .32, 1.275);
        }
        .p-image:hover {
            transition: all .3s cubic-bezier(.175, .885, .32, 1.275);
        }
        #saveImage{
            color: transparent;            
            transition: all .3s ease;
            text-decoration: none;
        }
        .card{
            margin:50px;
            margin-top:70px;
            margin-bottom:5px;
            background-color: white;
            outline:none;
        }
        #image-div{
            z-index: 0;
        }
        *:focus {
            outline: none;
        }
        
        li:hover{
            color:red;
        }
        .design{
            -webkit-transform: scale(1, -1);
        }
        
        #image-view {
           width:400px;
           height:auto;
           max-height:400px; 
        }

        #comments{
            width:400px;
        }

        input:focus{
            outline:none;
            padding:3px;
        }

        li:hover{
            color:red;
        }
        
        .picture:hover > #save {
            background-color: rgba(0,0,0,.5);
            z-index: 10000;
            color: rgba(250,250,250,1);
            transition: all .3s ease;
            text-decoration: none;
        }
        .viewCard{
            display:none;
            
        }

        div img{
            text-align:right;
        }

        .image {
            width:600px;
            height:450px;
            background-color:white;  
            border-bottom-right-radius:5px !important;
            border-top-right-radius:5px !important;
        }

        .div-comment{
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
        #save {
            color: transparent;            
            transition: all .3s ease;
            text-decoration: none;
        }
        i{
            margin-left:1150px; 
            margin-top:60px;
            color:red;
            cursor: pointer;
            margin-right:50px;
        }

        .div-view{
            margin-top:20px;
            margin-left:80px; 
        }

        p:focus{
            outline:none;
        }
        
    </style>
@endsection

@section('content')
    <div id='base'>
        <form method="POST" id="upload-image-form" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div style="margin-left:50px;  display:flex;">
                        <div id="image-div">
                            <img id="image" class="profile-pic upload-button"  src="/image/{{$picture}}">
                            <input id="input" name="file" class="file-upload" type="file" accept="image/*" disabled="true"/>
                        </div>
                        <div style="margin-left:100px; width:500px; height:250px; border-top-right-radius:20px;  border-bottom-left-radius:20px; padding:2px;">
                            <h2 id="name" style="">{{$name}}</h2>
                            <h5 id="email" style=""> {{$email}} </h5>
                            <br />
                            <br />
                            <span style="font-weight:bold;">About : </span><br />
                            <textarea disabled id="description" style="margin-top:10px;background-color:white; width:300px; height:100px; padding-top:5px; color:black;" autofocus> {{$description}} </textarea>
                        </div>
                        <div class='edit-header' style="margin-left:50px; height:250px; border-top-right-radius:20px;  border-bottom-left-radius:20px;">
                            <li id="edit" class="fa fa-edit fa-lg" style="cursor:pointer;" ></li>
                            <input id="saveButton" type="submit" value="save" style="margin-left:0px;display:none;width:70px; border:none; background-color:red;"/>
                        </div>
                    </div>  
                </div>
            </div>
        </form>
        <div id='profile-photos'>
            <div style="height:50px; width:1px; margin-left:100px; margin-top:-5px; border-left:5px solid #F9EBEA;"></div>
            <div style="margin-left:80px;">
                <a  style="color:#C0392B;" onclick="my(); return false;" id="link" >My Images</a>
                <a  style="color:#C0392B;" onclick="save(); return false;" id="link" >Saved</a>
            </div>
            <div id="my-photos" class="results"> </div>
            <div id="save-photos" class="results"> </div>
        </div>
        <div class="results" id="photos" style="display:none;"> 

        </div> 
        <div class="viewCard">
            <div id='header' style="margin-top:100px; margin-left:100px; height:20px; width:580px; background-color:none;"></div>
            <div class="div-view" style="display:flex">
                <img class="image" src="">
                <div class="div-comment">
                    
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js" integrity="sha512-HWlJyU4ut5HkEj0QsK/IxBCY55n5ZpskyjVlAoV9Z7XQwwkqXoYdCIC93/htL3Gu5H3R4an/S0h2NXfbZk3g7w==" crossorigin="anonymous"></script>
    <script>
         $(document).on("click", ".divComment li", function(event) {
            event.preventDefault();

            var image = $(this).closest('div').find('#image').text();
            var user = $(this).closest('div').find('#user').text();
            var content = $(this).closest('div').find('#content').text();
            var picuser = $(this).closest('div').find('#picuser').text();

            $(this).parent().hide();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:'POST',
                url:'/deleteComment',
                data: {
                    name:image,
                    content:content
                },
                success:function(data) {
                    
                }
            });
        });

        var counter = 0;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'POST',
            url:'/notefication',
            data: {
            },
            success:function(data) {
                $('.notefication').empty();
                for(i = data.message.length - 1 ; i >= 0 ; i--){
                    if(data.message[i][3] == 0){
                        if(data.message[i][2] == 0){
                            $('.notefication').append(
                                '<div>' +
                                    '<p id="image" style="display:none;">'+data.message[i][0]+'</p>'+
                                    '<p id="user" style="display:none;">'+data.message[i][1]+'</p>'+
                                    '<p id="content" style="display:none;">'+data.message[i][4]+'</p>'+
                                    '<p id="picuser" style="display:none;">'+data.message[i][7]+'</p>'+
                                    '<p id="noteID" style="display:none;">'+data.message[i][6]+'</p>'+
                                    '<a id="note" style="color:red" style="display:none;">'+data.message[i][1]+' comment on your picture.</a><br>'+
                                '</div>'
                            );
                            counter++;
                        }
                        else{
                            $('.notefication').append(
                                '<div>' +
                                    '<p id="image" style="display:none;">'+data.message[i][0]+'</p>'+
                                    '<p id="user" style="display:none;">'+data.message[i][1]+'</p>'+
                                    '<p id="content" style="display:none;">'+data.message[i][4]+'</p>'+
                                    '<p id="picuser" style="display:none;">'+data.message[i][7]+'</p>'+
                                    '<p id="noteID" style="display:none;">'+data.message[i][6]+'</p>'+
                                    '<a id="note" style="color:black">'+data.message[i][1]+' comment on your picture.</a><br>'+
                                '</div>'
                            );
                        }
                    }
                    else if(data.message[i][3] == 1 && data.message[i][5] == 1){
                        if(data.message[i][2] == 0){
                            $('.notefication').append(
                                '<div>' +
                                    '<p id="image" style="display:none;">'+data.message[i][0]+'</p>'+
                                    '<p id="user" style="display:none;">'+data.message[i][1]+'</p>'+
                                    '<p id="content" style="display:none;">'+data.message[i][4]+'</p>'+
                                    '<p id="picuser" style="display:none;">'+data.message[i][7]+'</p>'+
                                    '<p id="noteID" style="display:none;">'+data.message[i][6]+'</p>'+
                                    '<a id="note" style="color:red">'+data.message[i][1]+' share your picture on his profile.</a><br>'+
                                '</div>'
                            );
                            counter++;
                        }
                        else{
                            $('.notefication').append(
                                '<div>' +
                                    '<p id="image" style="display:none;">'+data.message[i][0]+'</p>'+
                                    '<p id="user" style="display:none;">'+data.message[i][1]+'</p>'+
                                    '<p id="content" style="display:none;">'+data.message[i][4]+'</p>'+
                                    '<p id="picuser" style="display:none;">'+data.message[i][7]+'</p>'+
                                    '<p id="noteID" style="display:none;">'+data.message[i][6]+'</p>'+
                                    '<a id="note" style="color:black">'+data.message[i][1]+' share share your picture on his profile.</a><br>'+
                                '</div>'
                            );
                        }
                    }
                    else if(data.message[i][3] == 1 && data.message[i][5] == -1){
                        if(data.message[i][2] == 0){
                            $('.notefication').append(
                                '<div>'+
                                    '<p id="image" style="display:none;">'+data.message[i][0]+'</p>'+
                                    '<p id="user" style="display:none;">'+data.message[i][1]+'</p>'+
                                    '<p id="content" style="display:none;">'+data.message[i][4]+'</p>'+
                                    '<p id="picuser" style="display:none;">'+data.message[i][7]+'</p>'+
                                    '<p id="noteID" style="display:none;">'+data.message[i][6]+'</p>'+
                                    '<a id="note" style="color:red">'+data.message[i][1]+' cancel share your picture on his profile.</a><br>'+
                                '</div>'
                            );
                            counter++;
                        }
                        else{
                            $('.notefication').append(
                                '<div>'+
                                    '<p id="image" style="display:none;">'+data.message[i][0]+'</p>'+
                                    '<p id="user" style="display:none;">'+data.message[i][1]+'</p>'+
                                    '<p id="content" style="display:none;">'+data.message[i][4]+'</p>'+
                                    '<p id="picuser" style="display:none;">'+data.message[i][7]+'</p>'+
                                    '<p id="noteID" style="display:none;">'+data.message[i][6]+'</p>'+
                                    '<a id="note" style="color:black">'+data.message[i][1]+' cancel share your picture on his profile.</a><br>'+
                                '</div>'
                            );
                        }
                    }
                    else if(data.message[i][3] == 2 && data.message[i][5] == -1){
                        if(data.message[i][2] == 0){
                            $('.notefication').append(
                                '<div>'+
                                    '<p id="image" style="display:none;">'+data.message[i][0]+'</p>'+
                                    '<p id="user" style="display:none;">'+data.message[i][1]+'</p>'+
                                    '<p id="content" style="display:none;">'+data.message[i][4]+'</p>'+
                                    '<p id="picuser" style="display:none;">'+data.message[i][7]+'</p>'+
                                    '<p id="noteID" style="display:none;">'+data.message[i][6]+'</p>'+
                                    '<a id="note" style="color:red">'+data.message[i][1]+' unlike your picture.</a><br>'+
                                '</div>'
                            );
                            counter++;
                        }
                        else{
                            $('.notefication').append(
                                '<div>'+
                                    '<p id="image" style="display:none;">'+data.message[i][0]+'</p>'+
                                    '<p id="user" style="display:none;">'+data.message[i][1]+'</p>'+
                                    '<p id="content" style="display:none;">'+data.message[i][4]+'</p>'+
                                    '<p id="picuser" style="display:none;">'+data.message[i][7]+'</p>'+
                                    '<p id="noteID" style="display:none;">'+data.message[i][6]+'</p>'+
                                    '<a id="note" style="color:black">'+data.message[i][1]+' unlike your picture.</a><br>'+
                                '</div>'
                            );
                        }
                    }
                    else if(data.message[i][3] == 2 && data.message[i][5] == 1){
                        if(data.message[i][2] == 0){
                            $('.notefication').append(
                                '<div>'+
                                    '<p id="image" style="display:none;">'+data.message[i][0]+'</p>'+
                                    '<p id="user" style="display:none;">'+data.message[i][1]+'</p>'+
                                    '<p id="content" style="display:none;">'+data.message[i][4]+'</p>'+
                                    '<p id="picuser" style="display:none;">'+data.message[i][7]+'</p>'+
                                    '<p id="noteID" style="display:none;">'+data.message[i][6]+'</p>'+
                                    '<a id="note" style="color:red">'+data.message[i][1]+' like your picture.</a><br>'+
                                '</div>'
                            );
                            counter++;
                        }
                        else{
                            $('.notefication').append(
                                '<div>'+
                                    '<p id="image" style="display:none;">'+data.message[i][0]+'</p>'+
                                    '<p id="user" style="display:none;">'+data.message[i][1]+'</p>'+
                                    '<p id="content" style="display:none;">'+data.message[i][4]+'</p>'+
                                    '<p id="picuser" style="display:none;">'+data.message[i][7]+'</p>'+
                                    '<p id="noteID" style="display:none;">'+data.message[i][6]+'</p>'+
                                    '<a id="note" style="color:black">'+data.message[i][1]+' like your picture.</a><br>'+
                                '</div>'
                            );
                        }
                    }
                }
                $('#noteNumber').text(counter);
            }
        });

        $('.divComment').on('click','i',function(e){
            e.preventDefault();
            var content = $(this).closest('div').find('p').text();
            var name =  $(this).closest('div').find('h1').text();
            console.log(name, content);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:'POST',
                url:'/add',
                data: {
                    content: content ,
                    name: name,
                },
                success:function(data) {
                    $('.divComment').append(
                        '<div style="background-color:white; border-radius:10px; padding:2px;">' + 
                            '<div style="margin-top:-40px;display: inline-block; width:260px; color:white;  border-radius:10px; font-weight:bold; background-color:rgb(0, 0, 0 ,0.8); padding:10px;">{{Auth::user()->name}}'+ 
                                "<img src='/image/{{Auth::user()->picture}}' style='float:right; width:30px; height:30px; border-radius:2px; '/>" +
                            "</div>" +
                            "<li id='"+ name +"' style='cursor:pointer; margin-left:20px; color:red; display: inline-block;' class='fa fa-trash fa-2x'></li>" +
                            "<p disabled id='content' contenteditable='true' style='margin-left:20px; padding-top:5px; color:black;' autofocus>"+ content +"</p>" + 
                        '</div><br />'
                    );
                    $('#content').text('Write your comment');
                }
            });
        });

        $('.notefication').on('click', '#note', function(e){
            e.preventDefault();
            $(this).css('color','black');
            $('.notefication').hide();
    
            var image = $(this).closest('div').find('#image').text();
            var user = $(this).closest('div').find('#user').text();
            var content = $(this).closest('div').find('#content').text();
            var picuser = $(this).closest('div').find('#picuser').text();

            $('.py-4').hide();
            $('.VC').show();
            $('.image-vi').attr('src','/image/'+ image);
            
            $('.divComment').empty();
            $('.divComment').append(
                '<div style="background-color:white; border-radius:10px; padding:3px;">' + 
                    "<div style='margin-top:-40px; display: inline-block; width:260px; color:white;  border-radius:10px; width:; font-weight:bold; background-color:rgb(0, 0, 0 ,0.8); padding:10px;'>{{Auth::user()->name}} " + 
                        "<img src='/image/{{Auth::user()->picture}}' style='float:right;width:30px; height:30px; border-radius:2px; '/>" +
                    "</div>" +
                    "<p id='content' contenteditable='true' style='margin-left:20px; padding-top:5px; color:black;' autofocus>Write your comment</p>" + 
                    "<i class='fa fa-plus fa-2x' style='border:none; color:#A93226; margin-left:330px;'></i>" + 
                    "<h1 style='display:none;'>"+image+"</h1>" + 
                '</div><br />'
            );

            if(content != '-2'){
                $('.divComment').append(
                    '<div style="background-color:white; border-radius:10px; padding:2px;">' + 
                        '<div style="margin-top:-40px;display: inline-block; width:260px; padding:10px; border-radius:10px; font-weight:bold; background-color:rgb(0, 0, 0 ,0.8); color:white;">' + user + 
                            "<img src='/image/"+ picuser +"' style='float:right;width:30px; height:30px; border-radius:2px; '/>" +
                        "</div>" +
                        '<p disabled style="margin-left:20px; padding-top:2px; color:black;" autofocus>' + content + '</p>' + 
                    '</div><br />'
                );
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:'POST',
                url:'/closeNotefication',
                data: {
                    id:parseInt($(this).closest('div').find('#noteID').text()),
                },
                success:function(data) {
                    
                }
            });

        });

        $('.fa-bell').click(function(){
            $('.notefication').show();
        });
        
        $(document).mouseup(function(e){
            var container = $(".notefication");
            if (!container.is(e.target) && container.has(e.target).length === 0){
                container.hide();
            }
        });
        $(document).on("click", "#pic li", function(event) {
            event.preventDefault();
            if($(this).attr('class') == 'fa fa-heart'){
                if($(this).css('color') == 'rgb(255, 0, 0)'){
                    $(this).css('color','inherit');
                    $(this).parent().find('p').text(parseInt($(this).parent().find('p').text()) - 1);
                }
                else{
                    $(this).css('color','red');
                    $(this).parent().find('p').text(parseInt($(this).parent().find('p').text()) + 1);
                }    
                var name = $(this).attr('id');

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type:'POST',
                    url:'/like',
                    data: {
                        name:name,
                    },
                    success:function(data) {
                        
                    }
                });
            }
            else if($(this).attr('class') == 'fa fa-plus-square'){
                if($(this).css('color') == 'rgb(255, 0, 0)'){
                    $(this).css('color','inherit');
                }
                else{
                    $(this).css('color','red');
                }    
                var name = $(this).attr('id');

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type:'POST',
                    url:'/save',
                    data: {
                        name:name,
                    },
                    success:function(data) {
                        
                    }
                });
            }
        });

        function view(name){
            $('.results').hide();
            $('.viewCard').show();
            $('.image').attr('src','/image/'+name);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:'POST',
                url:'/picture',
                data: {
                    name:name,
                },
                success:function(data) {
                    $('.div-comment').empty();
                    $('#header').empty();
                    $('#header').append(
                        "<span style='font-size:20px;' >By </span>  <a id='specificProfile' style='font-size:20px; color:black; font-weight:bold;'>"+ data.userPicture.name +"</a>" +
                        "<p style='display:none;'>"+ data.userPicture.id +"</p>"
                    );  
                    $('.div-comment').append(
                        '<div style="background-color:white; border-radius:10px; padding:3px;">' + 
                            "<div style='margin-top:-40px; display: inline-block; width:260px; color:white;  border-radius:10px; width:; font-weight:bold; background-color:rgb(0, 0, 0 ,0.8); padding:10px;'>{{ Auth::user()->name }} " + 
                                "<img src='/image/{{Auth::user()->picture}}' style='float:right;width:30px; height:30px; border-radius:2px; '/>" +
                            "</div>" +
                            "<p id='content' contenteditable='true' style='margin-left:20px; padding-top:5px; color:black;' autofocus>Write your comment</p>" + 
                            "<i id='"+ name +"' onclick='add(this.id)' class='fa fa-plus fa-2x' style='border:none; color:#A93226; margin-left:330px;'></i>" + 
                        '</div><br />'
                    );

                    for(i = data.comment.length - 1 ; i >= 0 ; i--){
                        if(data.comment[i][3]){
                            $('.div-comment').append(
                                '<div style="background-color:white; border-radius:10px; padding:2px;">' + 
                                    '<div style="margin-top:-40px;display: inline-block; width:260px; padding:10px; border-radius:10px; font-weight:bold; background-color:rgb(0, 0, 0 ,0.8); color:white;">' + data.comment[i][0] + 
                                        "<img src='/image/"+ data.comment[i][2] +"' style='float:right;width:30px; height:30px; border-radius:2px; '/>" +
                                    "</div>" +
                                    "<li id='"+ name +"' style='cursor:pointer; margin-left:20px; color:red; display: inline-block;' class='fa fa-trash fa-2x'></li>" +
                                    '<p disabled style="margin-left:20px; padding-top:2px; color:black;" autofocus>' + data.comment[i][1] + '</p>' + 
                                '</div><br />'
                            );
                        }
                        else{
                            $('.div-comment').append(
                                '<div style="background-color:white;border-radius:10px; padding:2px;">' + 
                                    '<div style="margin-top:-40px;display: inline-block; width:260px; padding:10px; border-radius:10px; font-weight:bold; background-color:rgb(0, 0, 0 ,0.8); color:white;">' + data.comment[i][0] + 
                                        "<img src='/image/"+ data.comment[i][2] +"' style='float:right;width:30px; height:30px; border-radius:2px; '/>" +
                                    "</div>" +
                                    '<p disabled style="margin-left:20px; padding-top:5px; color:black;" autofocus>' + data.comment[i][1] + '</p>' + 
                                '</div><br />'
                            );
                        }
                    }
                }
            });
        }

        $(document).ready(function() {
            if( {{$id}} != {{Auth::user()->id}}){
                $('.edit-header').hide();
                $('#photos').show();
                $('#profile-photos').hide();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type:'POST',
                    url:'/getMyPictureUser',
                    data: {
                        id:{{$id}}
                    },
                    success:function(data) {
                        $('#photos').empty();
                        for(i = data.message.length - 1 ; i >= 0 ; i--){
                            var temp = data.message[i][0];

                            var likeP = 'inherit', saveP = 'inherit';
                            if(data.message[i][3]){
                                likeP = 'red';
                            }
                            if(data.message[i][4]){
                                saveP = 'red';
                            }
                                    
                            $('#photos').append(
                                "<div id='pic' class='picture ht4' style="+"background-image:url("+"/image/"+ temp +"); background-size:cover;" +">"+
                                    "<li id='"+temp+"' class='fa fa-heart' title='like' style='color:"+ likeP +"; cursor:pointer; font-size:20px;margin-top:10px; margin-left: 130px; '></li>"+
                                    "<li id='"+temp+"' class='fa fa-plus-square' title='add' style='color:"+ saveP +"; cursor:pointer; font-size:20px;margin-top:5px; margin-left: 130px;'></li>"+
                                    "<li id='"+temp+"' onclick='view(this.id)' class='fa fa-eye' title='view' style='cursor:pointer; font-size:20px;margin-top:5px; margin-left: 130px;'></li>"+
                                    // "<a id='save' href='"+"/image/"+ temp +".jpg' class='fa fa-save' title='save' style='cursor:pointer; font-size:20px;margin-top:5px; margin-left: 130px;' download></a>"+
                                    "<p id='numberLike' style='padding-top:30px;text-align:center'>"+ data.message[i][1] +"</p>"+
                                "</div>"
                            );
                        }
                    }
                });
            }
            else {
                my();
            }

            var readURL = function(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) { 
                        $('#image').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $(".file-upload").on('change', function(){
                readURL(this);
            });

            $(".upload-button").on('click', function() {
                $(".file-upload").click();
            });

        });

        $('#header').on('click','#specificProfile', function(e){
            e.preventDefault();
            var id = $(this).parent().find('p').text();
            document.location.href = '/profile/' + id;
        });

        $(document).on("click", ".picture li", function(event) {
            event.preventDefault();
            if($(this).attr('class') == 'fa fa-trash'){
                var name = $(this).attr('id');
                $(this).parent().hide();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type:'POST',
                    url:'/trash',
                    data: {
                        name:name,
                    },
                    success:function(data) {

                    }
                });
            }
            else if($(this).attr('class') == 'fa fa-key'){
                var name = $(this).attr('id');

                if($(this).css('color') == 'rgb(0, 128, 0)'){
                    $(this).css('color','inherit');
                }
                else{
                    $(this).css('color','green');
                }    

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type:'POST',
                    url:'/privacy',
                    data: {
                        name:name,
                    },
                    success:function(data) {
                        
                    }
                });
            }
        });
        
        function save(){
            $('#save-photos').show();
            $('#my-photos').hide();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:'POST',
                url:'/savePictures',
                data: {
                },
                success:function(data) {
                    $('#save-photos').empty();
                    for(i = data.message.length - 1 ; i >= 0 ; i--){
                        var temp = data.message[i][0];
                        $('#save-photos').append(
                            "<div class='picture ht4' style="+"background-image:url("+"/image/"+ data.message[i][0] +"); background-size:cover;" +">"+
                                "<li id='"+temp+"' class='fa fa-trash' title='like' style='cursor:pointer; font-size:20px;margin-top:20px; margin-left: 130px;'></li>"+
                                "<li id='"+temp+"' onclick='view(this.id)'  class='fa fa-eye' style='cursor:pointer; font-size:20px;margin-top:5px; margin-left: 130px;'></li>"+
                                // "<a id='saveImage' href='"+"/image/"+ data.message[i][0]+".jpg' class='fa fa-save' title='save' style='cursor:pointer; font-size:20px;margin-top:5px; margin-left: 130px;' download></a>"+
                            "</div>"
                        );
                    }
                }
            });
        }

        function my(){
            $('#my-photos').show();
            $('#save-photos').hide();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:'POST',
                url:'/getMyPictureUser',
                data: {
                    id:{{$id}}
                },
                success:function(data) {
                    $('#my-photos').empty();
                    $('#my-photos').append(
                        '<div class="picture" style="display:flex;">'+
                            '<img id="image-add" class="upload-image " src="/image/download.jpg" style="margin-left: auto; margin-right: auto; background-color:gray;cursor: pointer;">'+
                            '<input id="add-image" name="file" class="image-upload" type="file" accept="image/*"/>'+
                            "<button id='divAdd' class='fa fa-plus fa-lg' style='color:red; background-color:transparent; border:none; height:20px; margin-left:-5px; margin-top:193px;'></button>"+
                        '</div>');
                    for(i = data.message.length - 1 ; i >= 0 ; i--){
                        var temp = data.message[i][0];
                        $('#my-photos').append(
                            "<div class='picture ht4' style="+"background-image:url("+"/image/"+ data.message[i][0] +"); background-size:cover;" +">"+
                                "<li id='"+temp+"' class='fa fa-trash'  style='cursor:pointer; font-size:20px;margin-top:20px; margin-left: 130px;'></li>"+
                                "<li id='"+temp+"' onclick='view(this.id)' class='fa fa-eye' style='cursor:pointer; font-size:20px;margin-top:5px; margin-left: 130px;'></li>"+
                                // "<a id='saveImage' href='"+"/image/"+ data.message[i][0]+"' class='fa fa-save' title='save' style='cursor:pointer; font-size:20px;margin-top:5px; margin-left: 130px;' download></a>"+
                                "<li id='"+temp+"' class='fa fa-key' style=' color: " + data.message[i][5] + "; cursor:pointer; font-size:20px;margin-top:5px; margin-left: 130px;'></li>"+
                            "</div>"
                        );
                    }
                }
            });
        }
        
        function privacy(name){
            event.preventDefault();
            $(this).parent().hide();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:'POST',
                url:'/deleteComment',
                data: {
                    name:name,
                    content:content
                },
                success:function(data) {
                    
                }
            });
        }

        $('#my-photos').on('click', '#divAdd' ,function(e) {
            e.preventDefault();
            var formData = new FormData();
            var file = document.getElementById("add-image").files[0];
            formData.append('file', file);
            formData.append('_token', '{{ csrf_token() }}');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajaxSetup ({
                processData: false,
                contentType: false
            });
            $.post('/addImage', 
                formData,
                function (data) {
                    console.log(data);
                    // my();
                    location.reload();
                }
            );
        });

        $('#my-photos').on('click', '.upload-image',function(e){
            e.preventDefault();
            $(".image-upload").click();
            var readURL_add = function(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) { 
                        $('#image-add').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $(".image-upload").on('change', function(){
                readURL_add(this);
            });

        });

        $(document).on("click", ".div-comment li", function(event) {
            event.preventDefault();
            var content = $(this).parent().find('p').text();
            var name = $(this).attr('id');
            $(this).parent().hide();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:'POST',
                url:'/deleteComment',
                data: {
                    name:name,
                    content:content
                },
                success:function(data) {
                    
                }
            });
        });

        function add(name){
            var content = $('#content').text();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:'POST',
                url:'/add',
                data: {
                    content: content,
                    name: name,
                },
                success:function(data) {
                    $('.div-comment').append(
                        '<div style="background-color:white; border-radius:10px; padding:2px;">' + 
                            '<div style="margin-top:-40px;display: inline-block; width:260px; color:white;  border-radius:10px; font-weight:bold; background-color:rgb(0, 0, 0 ,0.8); padding:10px;">{{Auth::user()->name}}'+ 
                                "<img src='/image/{{Auth::user()->picture}}' style='float:right; width:30px; height:30px; border-radius:2px; '/>" +
                            "</div>" +
                            "<li id='"+ name +"' style='cursor:pointer; margin-left:20px; color:red; display: inline-block;' class='fa fa-trash fa-2x'></li>" +
                            "<p disabled id='content' contenteditable='true' style='margin-left:20px; padding-top:5px; color:black;' autofocus>"+ content +"</p>" + 
                        '</div><br />'
                    );
                    $('#content').text('Write your comment');
                }
            });
        }

        $(document).mouseup(function(e){
            var container = $(".viewCard");
            if (!container.is(e.target) && container.has(e.target).length === 0){
                container.hide();
                $('#my-photos').show();
                $('#save-photos').hide();

            }
        });
        
        $('#edit').click(function(){
            $('#description').attr("disabled",false);
            $('#name').attr("contenteditable","true");
            $('#saveButton').show();
            document.getElementById("input").disabled = false;
            $('.upload-button').css('cursor' ,'pointer');
            $('#edit').hide();
            $('#name').css('background-color','rgb(236, 240, 241, 0.05)');
            $('#description').css('background-color','rgb(236, 240, 241, 0.05)');
        });

        $('#upload-image-form').submit(function(e) {
            e.preventDefault();
            var formData = new FormData();
            var file = document.getElementById("input").files[0];
            var name = document.getElementById("name").innerHTML;
            var description = document.getElementById("description").value;
            formData.append('file', file);
            formData.append('name', name);
            formData.append('description', description);
            formData.append('_token', '{{ csrf_token() }}');
            $.ajaxSetup ({
                processData: false,
                contentType: false
            });
            $.post('/updateImage', 
                formData,
                function (data) {
                }
            ).fail(function (xhr, textStatus, errorThrown) {
                    console.log(xhr.responseText);
            });
            $('#description').attr("disabled",true);
            $('#name').attr("contenteditable","false");
            $('#saveButton').hide();
            document.getElementById("input").disabled = true;
            $('.upload-button').css('cursor' ,'context-menu');
            $('#edit').show();
            $('#name').css('background-color','transparent ');
            $('#description').css('background-color','transparent ');
        });
    </script>
@endsection
