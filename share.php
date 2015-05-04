<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <script>
            function verifyEmail(name) {
//                alert('in');
                var email = document.getElementById(name).value;
//                alert(email);
                ve = new XMLHttpRequest();
                ve.onreadystatechange = function () {
                    if (ve.readyState == 4 && ve.status == 200) {
                        document.getElementById('sw').innerHTML = ve.responseText;
                    }
                };
                url = "verifyEmail.php?input=" + email;
                ve.open("get", url, true);
                ve.send();
            }
        </script>
        <?php
        session_start();
        require_once 'server_funcs.php';
        require_once 'webpage_functions.php';
//        $id = 2;
        $id = $_SESSION['id'];
        ?>
        <form action="share_server.php" method="post">
            <?php
            show_all_libs($id);
            ?>

            Share With:<br/>

            <input type="text" name="sharewith" id="sharewith" onkeyup="verifyEmail('sharewith')"><span id="sw"></span><br/>
            <input type="submit" name="submit" value="Share" />
        </form>
    </body>
</html>
