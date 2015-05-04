<?php

/*
  foreach ($libs as $b) {
  search($b, $keyword);
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
require_once 'vars.php';
require_once 'webpage_functions.php';
require_once 'server_funcs.php';

if (isset($_POST['submit'])) {
    $libs = get_all_libs($_SESSION['id']);
    $keyword = $_POST['keyword'];
    print_r($libs);

    echo "<table>
        <tr>
        <th>Library</th>
        <th><a href='bibli.php?sortby=title'>title</a></th>
        <th><a href='ajaxServer.php?sortby=author'>author</a></th>
        <th><a href='#'>year</a></th>
        <th><a href='#'>added at</a></th>
        <th><a href='#'>pdf</a></th>
        </tr>
        ";
    foreach ($libs as $b) {
        search($b, $keyword);
    }
    echo "</table>";
}

echo "<a href='bibli.php'>GO BACK</a>";