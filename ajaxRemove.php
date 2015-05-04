<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'server_funcs.php';
require_once 'vars.php';

if(isset($_GET['removeArray']) && !empty($_GET['removeArray'])) {
    $arr = json_decode($_GET['removeArray']);
} else {
    echo 'select one';
}

if (!empty($arr)) {
    $act_id = $_SESSION['id'];
    $act_lib = $_SESSION['active_lib'];
    
    foreach ($arr as $ref) {
        $tref = get_refArray($act_lib, $ref);
        insertRef('trash' . $act_id, $tref['title'], $tref['author'], $tref['year'], $tref['pdf']);
        delete_ref($act_lib, $ref);
    }
}else {
    echo 'please select one';
}

get_sorted_refs($act_lib, $_SESSION['sortby'], $_SESSION['current_order']);

