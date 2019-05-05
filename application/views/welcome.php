<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>HB Chat</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html{
                overflow:hidden;
                background: #343A40;
            }
            .login-card{
                position: relative;
                margin:auto;
                background-color: rgba(0, 150, 255, 0.7);
                min-height: 40vh;
                width: 500px;
                text-align: center;
                border-radius: 15px;
                margin-top:11%;
            }
            .header{
                margin: auto;
                text-align: center;
                width: 100%;
                background: orange;
                height: 30px;
                border-top-left-radius: 15px;
                border-top-right-radius: 15px;
                position: absolute;
                top: 0;
                padding-top: 5px;
                padding-bottom: 5px;
                color: #343A40;
                font-size: 23px;
            }
            .form{
                position: relative;
                z-index: 5;
            }
            #info{
                display: block;
            }
            input[type=text]{
                min-width: 50%;
                padding: 7px;
                margin: 5px;
                margin-top: 24%;
                font-size: 15px;
                border:none;
                border-radius: 2px;
            }
            input[type=text]:hover, input[type=text]:focus{
                background: #343A40;
                color: #fff;
            }
            .button{
                display: block;
                margin: auto;
                margin-top: 5px;
                padding: 5px;
                background: white;
                border:none;
                border-radius: 2px;
                font-size: 15px;
            }
            .button:hover, .button:focus{
                background: #343A40;
                color: #756151;
            }
            .footer{
                margin: auto;
                text-align: center;
                width: 100%;
                background: orange;
                height: 30px;
                border-bottom-left-radius: 15px;
                border-bottom-right-radius: 15px;
                position: absolute;
                bottom: 0;
                padding-top: 10px;
                color: #343A40;
            }
        </style>
    </head>
    <body>
        <div class="login-card">
            <div class="header">
                Welcome HBChat
            </div>
            <form class="form" action="#">
                <input type="text" id="nickname" placeholder="Nickname" autocomplete="off" minlength="3" maxlength="13" required="required">
                <span id="info"></span>
                <input type="submit" class="button" value="Submit">
            </form>
            <div class="footer">Halil Bilgin - 2019</div>
        </div>
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>
            $('.button').click(function(){
                nickControl();
            });
            $('#nickname').keypress(function(e){
                if(e.which == 13){
                    nickControl();
                }
            });
            function nickControl(){
                let nickname=$('#nickname').val();
                $.ajax({
                   url: '<?php echo base_url("nicknameControl");?>',
                   type:'POST',
                   data:{nickname: nickname},
                   success: function(result){
                        if(result=="dolu"){
                           $("#info").html("Nickname kullanımda!");
                        }else if(result=="true"){
                            window.location.replace('<?php echo base_url('room'); ?>?user='+nickname);
                        }
                    }
               });
            }
        </script>
    </body>
</html>
