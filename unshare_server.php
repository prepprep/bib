<?php
session_start();
require_once 'vars.php';
require_once 'server_funcs.php';

if(isset($_POST['submit']) && !empty($_POST['lib'])) {
        $owner = $_SESSION['id'];
//    $owner = 2;
    $withid = $_POST['withid'];
//    print_r($withid);
    $libname = $_POST['lib'];
    print_r($libname);
    delete_shared_lib($owner, $withid, $libname);
    echo "<script>alert('Operation Complete');</script>";
    echo "<script>window.location = 'unshare.php'</script>";
} else {
    echo "<script>alert('Please choose one');</script>";
    echo "<script>window.location = 'unshare.php'</script>";
}

