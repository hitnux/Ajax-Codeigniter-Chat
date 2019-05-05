<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>HB Chat Room</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html{
                background: #343A40;
            }
            .login-card{
                position: relative;
                margin:auto;
                background-color: rgba(0, 150, 255, 0.7);
                min-height: 75vh;
                width: 70vw;
                text-align: center;
                border-radius: 15px;
                margin-top:3%;
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
            .messages{
                overflow-y: auto;
                position: relative;
                text-align: center;
                margin: auto;
                width: 100%;
                height: calc(75vh - 60px);
                border-top-left-radius: 15px;
                border-top-right-radius: 15px;
                background: #fff;
            }
            .message-card, .user-message-card{
                text-align: left;
                margin: 10px;
                padding: 10px;
                width: 30%;
                border-radius: 5px;
                position: relative;
                top: 10px;
            }
            .message-card{
                background: rgba(0, 150, 255, 1);
                color: #fff;
                display: block;
            }
            .user-message-card{
                left: calc(65vw - 28%);
                background: orange;
                color: #343A40;
            }
            .message-user{
                margin-right: 10px;
                color: #000;
            }
            .form{
                position: absolute;
                bottom: 0;
                margin-bottom: 10px;
                width: 100%;
                display: flex;
            }
            input[type=text]{
                width: 90%;
                padding: 7px;
                margin-top: 24%;
                font-size: 15px;
                margin: 5px;
                border:none;
                border-radius: 2px;
                flex: 11;
            }
            input[type=text]:hover, input[type=text]:focus{
                background: #343A40;
                color: #fff;
            }
            .button{
                flex:1;
                margin: auto;
                margin-top: 5px;
                margin: 5px;
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
                margin: 0;
                left: 0;
                right: 0;
                text-align: center;
                width: 100%;
                background: orange;
                height: 30px;
                position: fixed;
                bottom: 0;
                padding-top: 10px;
                color: #343A40;
            }
            @media only screen and (max-width: 900px) {
                .login-card{
                    width: 95vw;
                    height: 90vh;
                }
                .messages{
                    height: calc(90vh - 60px);
                }
                .message-card, .user-message-card{
                    left: 0;
                    width: 87%;
                }
            }
        </style>
    </head>
    <body>
        <div class="login-card">
            <div class="messages">
                <?php
                foreach ($messages as $msg){ 
                    if($msg->name==$user->name){
                        echo '<div class="user-message-card"><b class="message-user">'.$msg->name.':</b>'.$msg->text.'</div>';
                    }else{
                        echo '<div class="message-card"><b class="message-user">'.$msg->name.':</b>'.$msg->text.'</div>'; 
                    }
                }
                ?>
            </div>
            <div class="form">
                <input type="text" id="message" placeholder="Message" autocomplete="off" maxlength="1024" required="required">
                <input type="submit" class="button" value="Submit">
            </div>
        </div>
        <div class="footer">Halil Bilgin - 2019</div>
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>
        const currentUser="<?php echo $user->name;?>";
        const currentID="<?php echo $user->user_id;?>";
        let messages=$("span").html();
        let news=false;
        console.log(messages);
        $( document ).ready(function() {
            showmessages();
            $(".messages").animate({ scrollTop: 20000000 });
        });
        setInterval(function(){
            showmessages();
            if(news){
                $(".messages").animate({ scrollTop: 20000000 });
                news=false;
            }
        }, 1000);
        
            $('.button').click(function(){
                if(inputControl()){
                   send();
                }
            });
            $('#message').keypress(function(e){
                if(e.which == 13){
                    if(inputControl()){
                       send();
                    }
                }
            });
            function inputControl(){
                let input=$('#message').val();
                if(input){
                    return input;
                }else{
                    return false;
                }
            }
            function showmessages(){
                $.ajax({
                   url: '<?php echo base_url("showMessages"); ?>',
                   type:'POST',
                   data:{user: currentID},
                   success: function(result){
                        $('.messages').append(result);
                        if(result){
                            news=true;
                        }
                    }
               })
            }
            function send(){
                let message=$('#message').val();
                $.ajax({
                   url: '<?php echo base_url("send"); ?>',
                   type:'POST',
                   data:{user: currentID, message: message},
                   success: function(result){
                        $('.messages').append('<div class="user-message-card"><b class="message-user"><?php echo $user->name; ?>:</b>'+message+'</div>');
                        $('#message').val("");
                        $(".messages").animate({ scrollTop: 20000000 });
                    }
               })
            }
        </script>
    </body>
</html>
