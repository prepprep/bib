<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

define('db_dsn', 'mysql:host=localhost;dbname=zero;charset=utf8');
//$id = 1;
//$libname = 'testlib' . strval($id);
//if(create_table('testlib')){
//    echo 'success';
//}
//table($libname);
//create_table($libname);

//$title='book';
//$year = 2015;
//$libid = 1;
//update2($title,$year, $libid);

$a = 'lib1';
$b = 'good';
//rename_table($a, $b);

rename_table($b, $a);



function update2($title, $year, $libid) {
    try {
        $connection = new PDO(db_dsn, 'xxx', '');

        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = <<<EOSQL
               UPDATE lib1 SET title=:title, year=:year WHERE libid=:libid;
EOSQL;

        $query = $connection->prepare($sql);

        $query->execute(array(':title' => $title,':year'=>$year,':libid'=>$libid));
    } catch (Exception $ex) {
        echo 'in create_table' . PHP_EOL;
        echo $ex->getMessage();
    }
}

function update($year, $libid) {
    $link = mysqli_connect('localhost', 'xxx', '', 'zero');
    $sql = "UPDATE lib1 set
        title=$year
            
       WHERE libid=$libid";
    $query = mysqli_query($link, $sql) or die(mysqli_error($link));
}

function table($tab) {
    $link = mysqli_connect('localhost', 'xxx', '', 'zero');
    $sql = "CREATE TABLE $tab (
        title VARCHAR(255) NOT NULL,
                author VARCHAR(255) NOT NULL,
                year YEAR NOT NULL,
                addedAt TIMESTAMP,
                pdf VARCHAR(255) NOT NULL
            );";
    $query = mysqli_query($link, $sql);
}

function create_table($libname) {
    try {
        $connection = new PDO(db_dsn, 'xxx', '');
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = <<<EOSQL
                CREATE TABLE $libname (
                    title VARCHAR(255) NOT NULL,
                    author VARCHAR(255) NOT NULL,
                     year YEAR NOT NULL,
                     addedAt TIMESTAMP,
                     pdf VARCHAR(255) NOT NULL)
EOSQL;

        $query = $connection->prepare($sql);

        $query->execute();
    } catch (Exception $ex) {
        echo 'in create_table' . PHP_EOL;
        echo $ex->getMessage();
    }
}
