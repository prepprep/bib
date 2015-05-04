<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'server_funcs.php';
session_start();

if (isset($_GET['trashArray'])) {
    $trash = json_decode($_GET['trashArray']);
    foreach ($trash as $del_id) {
        delete_trash($_SESSION['id'], $del_id);
    }
    get_trash($_SESSION['id']);
} else {
    echo 'please select one';
}



