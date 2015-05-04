<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'vars.php';
require_once 'server_funcs.php';

if(isset($_GET['input']) && !empty($_GET['input'])) {
    $email = $_GET['input'];
    if(is_email_exist($email)) {
        echo 'yes';
    }else {
        echo 'User not exist!';
    }
}

