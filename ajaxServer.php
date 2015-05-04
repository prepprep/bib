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
        require_once 'webpage_functions.php';

        if (!empty($_GET['libname'])) {
            $libname = $_GET['libname'];
            $_SESSION['active_lib'] = $libname;
//            echo $libname;
        } else {
            $libname = get_active_lib($id);
            $_SESSION['active_lib'] = $libname;
//            echo $libname;
        }

        $sortby = (isset($_GET['sortby'])) ? $_GET['sortby'] : $_SESSION['sortby'];
        $order = (isset($_GET['order'])) ? $_GET['order'] : $_SESSION['current_order'];

        get_sorted_refs($libname, $sortby, $order);
        ?>
    </body>
</html>
