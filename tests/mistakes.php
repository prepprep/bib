<?php

/* table and colume can not be replaced by parameters in pdo.*/
function create_table($libname) {
    try {
        $connection = new PDO(db_dsn, db_username, db_passwd);
        $query = $connection->prepare("
                CREATE TABLE :libname (
                title VARCHAR(255) NOT NULL,
                author VARCHAR(255) NOT NULL,
                year YEAR NOT NULL,
                addedAt TIMESTAMP,
                pdf VARCHAR(255) NOT NULL
                );
                ");
        $query->execute(array(':libname' => $libname));
    } catch (Exception $ex) {
        echo 'in create_table' . PHP_EOL;
        echo $ex->getMessage();
    }
}
function create_trash_table($id) {
    try {
        //ensure all trash tables not the same name.
        $trashname = 'trash' . $id;
        $connection = new PDO(db_dsn, db_username, db_passwd);
        $query = $connection->prepare("
                CREATE TABLE :trash (
                title VARCHAR(255) NOT NULL,
                author VARCHAR(255) NOT NULL,
                year YEAR NOT NULL,
                addedAt TIMESTAMP,
                pdf VARCHAR(255) NOT NULL
                );
                ");
        $query->execute(array(':trash' => $trashname));
    } catch (Exception $ex) {
        echo 'in create_trash_table' . PHP_EOL;
        echo $ex->getMessage();
    }
}