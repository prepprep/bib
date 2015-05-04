<?php
session_start();
require_once 'vars.php';
require_once 'server_funcs.php';

if (isset($_POST['submit']) && !empty($_POST['sharewith']) && !empty($_POST['libs'])) {
    $email = $_POST['sharewith'];

//    $owner = 2;
    $owner = $_SESSION['id'];
    if (is_email_exist($email)) {

        $withid = get_id($email);

        if ($owner != $withid) {
            $libs = $_POST['libs'];

            foreach ($libs as $libname) {
                shareWith($owner, $withid, $libname);
                echo "<script>window.location = 'bibli.php'</script>";
            }
        } else {
            echo "<script>alert('Can not share with yourself!');</script>";
            echo "<script>window.location = 'share.php'</script>";
        }
    }  else {
        echo "<script>alert('Not a valid email address!');</script>";
    echo "<script>window.location = 'share.php'</script>";
    }
} else {
    echo "<script>alert('Not enough infomation, please check again');</script>";
    echo "<script>window.location = 'share.php'</script>";
}
