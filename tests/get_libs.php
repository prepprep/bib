<?php

require_once 'vars.php';

$id = 5;
$connection = new PDO(db_dsn, db_username, db_passwd);
$query = $connection->prepare("SELECT libName FROM userlib WHERE id = :id ");
$query->bindParam(':id', $id);
$query->execute();
//        $result = $query->fetch(PDO::FETCH_ASSOC);
//        print_r($result);
echo "<select name='userId' onchange='showref(this.value)'>";
echo "<option value=''>Select lib name</option>";

//test line
echo "<option value='test'>test</option>";

while ($result = $query->fetch(PDO::FETCH_BOTH)) {
    echo "<option value='$result[0]'>$result[0]</option>";
}
echo "</select>";
