<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Welcome to K-Cooperation</title>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
    </head>
    <body>
        <div class="header">
            <div id="logo">Bibliogrphy</div>
            <div id="btn_reg">
                <input type="button" value="Register" onclick="window.location = 'register.html';"/>
            </div>
        </div>
        <div class="content">

            <div class="picturebox">
                <img src="src/frontImage.jpg" alt="not such image"/>
            </div>
            <div id="rightbox">
                <div id="space"></div>
                <div class="login">
                    <form action="server_login.php" method="post">
                        <input type="username" name="email" id="" placeholder="Username Please"/>
                        <br/><br/>
                        <input type="password" name="passwd" id="" placeholder="Password Please"/>
                        <br/><br/>
                        <input type="hidden" name="status" value="login"/>
                        <input type="submit" name="submit" id="submit" value="Login"/>
                    </form>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        
    </body>
</html>
