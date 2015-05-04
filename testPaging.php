<?php

require_once 'vars.php';

$id = 5;
$libname = 'ssss';
$page_size = 2;

if (isset($_GET['page'])) {
    $page = intval($_GET['page']);
} else {
    $page = 1;
}

try {
    $connection = new PDO(db_dsn, db_username, db_passwd);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM $libname";


    $query = $connection->prepare($sql);
    $query->execute();

    $num_of_row = $query->rowCount();
    $num_page = intval($num_of_row / $page_size);

    if ($num_of_row % $page_size) {
        $num_page++;
    }

    $offset = $page * ($num_page - 1);

    $sql_p = "SELECT * FROM $libname ORDER BY YEAR ASC LIMIT $offset, 2";
    $qq = $connection->prepare($sql_p);
    $qq->execute();

    echo $offset . PHP_EOL;
    echo $page_size . PHP_EOL;

    echo "<table>";
    while ($row = $qq->fetch()) {
        echo '<tr>';
        echo "<td><input name='trash[]' type='checkbox' value= " . $row['libid'] . " /></td>";
        echo '<td>' . $row['title'] . '</td>';
        echo '<td>' . $row['author'] . '</td>';
        echo '<td>' . $row['year'] . '</td>';
        echo '<td>' . $row['addedAt'] . '</td>';
        echo '<td>' . $row['pdf'] . '</td>';
        echo '</tr>';
    }
    echo "</table>";

    for ($i = 0; $i < $num_page; $i++) {
        $b = $i + 1;
        echo "<a href='testpaging.php?page=$i'>$b</a>" . PHP_EOL;
    }
    echo "<br/>Total Pages : " . $num_page;
} catch (Exception $ex) {
    echo ' in paging' . PHP_EOL;
    $ex->getMessage();
}
