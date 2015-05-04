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
        <?php
        session_start();
        require_once 'server_funcs.php';
        require_once 'server_funcs.php';

//        $id = 2;
        $id = $_SESSION['id'];
        view_shared_lib($id);
        ?>
    </body>
</html>
