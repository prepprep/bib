<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'server_funcs.php';
require_once 'vars.php';

session_start();
cleanup_trash($_SESSION['id']);
echo "<script>window.location = 'bibli.php'</script>";
