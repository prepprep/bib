<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        require_once 'vars.php';
        $libname = 'lib1';

        $sql = "SELECT * FROM $libname";
        $sort = "";
        $order = "";
        //be careful, there should be a space before ORDER
        switch ($_GET['sort']) {
            case 'title':
                $sort = " ORDER BY title";
                break;
            case 'author':
                $sort = " ORDER BY author";
                break;
            default:
                $sort = " ORDER BY title";
                break;
        }

//        switch ($_GET['order']) {
//            case 'DESC':
//                $order = " ASC";
//                break;uiyjh
//            case 'ASC':
//                $order = " DESC";
//                break;
//            default:
//                $order = " ASC";
//                break;
//        }
        $counter = 0;
        
        if ($_GET['order'] == 'a') {
            if ($counter == 0) {
                $order = " ASC";
                $counter = 1;
                echo 'ASC';
            } elseif ($counter == 1) {
                $order = " DESC";
                $counter = 0;
                echo 'DESC';
            }
        }

            try {
                $connection = new PDO(db_dsn, db_username, db_passwd);
                $sql = $sql . $sort . $order;
                $query = $connection->prepare($sql);
                $query->execute();

                echo "<table>
        <tr>
        <th>-</th>
        <th><a href='testSort.php?sort=title&order=a'>title</a></th>
        <th><a href='testSort.php?sort=author&order'>author</a></th>
        <th><a href='#'>year</a></th>
        <th><a href='#'>added at</a></th>
        <th><a href='#'>pdf</a></th>
        </tr>
        <form action='bibli.php' method='post'>";
                while ($row = $query->fetch()) {
                    echo '<tr>';
                    echo "<td><input class='refs' name='checkbox[]' type='checkbox' value= " . $row['libid'] . " /></td>";
                    echo '<td>' . $row['title'] . '</td>';
                    echo '<td>' . $row['author'] . '</td>';
                    echo '<td>' . $row['year'] . '</td>';
                    echo '<td>' . $row['addedAt'] . '</td>';
                    echo '<td>' . $row['pdf'] . '</td>';
                    echo '</tr>';
                }
                echo "
            <input type='button' name='edit' value='edit' onclick='get_wishid()'/>
            <input type='hidden' name='action' value='deleteref'/>
            <input type='hidden' name='delname' value=" . $_SESSION['active_lib'] . "/>
            <input type='submit' name='delete' value='Delete Refs'/>
            
        </form>
        </table>";
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }
            ?>
    </body>
</html>
