<?php
session_start();
require_once 'server_funcs.php';
require_once 'vars.php';

if(!empty($_GET['moveArray']) && !empty($_GET['target'])) {
    $array = json_decode($_GET['moveArray']);
    $targetlib = $_GET['target'];
    
    echo $targetlib;
} else {
    echo 'select one';
}

if (!empty($array)) {
    $act_id = $_SESSION['id'];
    $act_lib = $_SESSION['active_lib'];
    
    foreach ($array as $ref) {
        $tref = get_refArray($act_lib, $ref);
        insertRef($targetlib, $tref['title'], $tref['author'], $tref['year'], $tref['pdf']);
        delete_ref($act_lib, $ref);
    }
}else {
    echo 'please select one';
}

get_sorted_refs($act_lib, $_SESSION['sortby'], $_SESSION['current_order']);