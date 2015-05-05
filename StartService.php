<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'vars.php';

$sql_table_user = "
    CREATE TABLE user (
    id int(10) NOT NULL AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(12) NOT NULL,
    name VARCHAR(255),
    dob VARCHAR(12),
    gender VARCHAR(7),
    career VARCHAR(255),
    PRIMARY KEY(id) 
        )";

$sql_table_userlib = "
    CREATE TABLE userlib (
    id int(10) NOT NULL,
    libName VARCHAR(255) NOT NULL
        )";

$sql_table_trashlib = "
    CREATE TABLE trashlib (
    id int(10) NOT NULL,
    libName VARCHAR(255) NOT NULL,
    trashlibName VARCHAR(255) NOT NULL
        )";

$sql_table_share = "
    CREATE TABLE share (
    owner VARCHAR(255) NOT NULL,
    shareWith VARCHAR(255) NOT NULL,
    libName VARCHAR(255) NOT NULL
        )";

try {
    $connection = new PDO(db_dsn, db_username, db_passwd);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query1 = $connection->prepare($sql_table_user);
    $query1->execute();

    $query2 = $connection->prepare($sql_table_userlib);
    $query2->execute();

    $query3 = $connection->prepare($sql_table_trashlib);
    $query3->execute();

    $query4 = $connection->prepare($sql_table_share);
    $query4->execute();
    
    echo "<script>window.location = 'index.php'</script>";
} catch (Exception $ex) {
    echo 'in start service' . PHP_EOL;
    echo $ex->getMessage();
}
