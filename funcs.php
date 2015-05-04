<?php

require_once 'vars.php';

if (isset($_POST['submit'])) {
//    $email = $_POST['email'];
//    $psd = $_POST['pass'];
    
    //this should be in the cookie
    $id = 1;

    $libname = $_POST['libname'];
//    $author = $_POST['author'];
//    $year = $_POST['year'];
//
//    if (!empty($libname)) {
//        insert($id, $libname, $author, $year);
//    }
    $result = getRef($libname);
    echo $result;
}

function getRef($libname) {
    try{
        $connection = new PDO(db_dsn, db_username, db_passwd);
        $query = $connection->prepare("SELECT * FROM testlib WHERE libName = :libname; ");
        $query->bindParam(':libname', $libname);
        $query->execute();
        return $query->fetchAll();
    } catch (Exception $ex) {
        echo 'in get ref' . PHP_EOL;
        echo $ex->getMessage();
    }
}


function insert($id, $libname, $author, $year) {
    insertUserlib($id, $libname);
    insertRef($libname, $author, $year);
}

function insertUserlib($id, $libname) {
    try {
        $connection = new PDO(db_dsn, db_username, db_passwd);
        $query = $connection->prepare("INSERT INTO userlib (id,libName) "
                . "VALUES (:id, :libName);");
        $query->execute(array(':id' => $id, ':libName' => $libname));
    } catch (Exception $ex) {
        echo 'in insert Userlib' . PHP_EOL;
        echo $ex->getMessage();
    }
}

function insertRef($libname, $author, $year) {
    try {
        $connection = new PDO(db_dsn, db_username, db_passwd);
        $query = $connection->prepare("INSERT INTO testlib (libName,author,year) "
                . "VALUES (:libName,:author,:year);");
        $query->execute(array(':libName' => $libname, ':author' => $author, ':year' => $year));
    } catch (Exception $ex) {
        echo 'in insertRef' . PHP_EOL;
        echo $ex->getMessage();
    }
}
