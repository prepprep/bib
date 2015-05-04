<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require_once 'server_funcs.php';

$refid = $_GET['libid'];
$refArray = get_refArray($_SESSION['active_lib'], $refid);
//print_r($refArray);

echo "
    
    <form action='bibli.php' method='post'>
    <table>
    <tr>
    <th>Title:</th>
    <td><input type='text' name='update_title' value=".$refArray['title']." /></td>
    </tr> 
    <tr>
    <th>Author:</th>
    <td><input type='text' name='update_author' value=".$refArray['author']." /></td>
    </tr> 
    <tr>
    <th>Year:</th>
    <td><input type='text' name='update_year' value=".$refArray['year']." /></td>
    </tr>  
    <tr>
    <th>PDF:</th>
    <td><input type='text' name='update_pdf' value=".$refArray['pdf']." /></td>
    </tr> 
    </table>
    <input type='hidden' name='refid' value='$refid'/>
    <input type='hidden' name='action' value='update'/>
    <input type='submit' name='submit' value='update'/>
    </form>
    
";
