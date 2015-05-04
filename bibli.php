<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php session_start(); ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel = "stylesheet" type="text/css" href="css/aaa.css"/>
        <script>
            function add() {
                alert("Mouse over!");
            }

            function showref(name) {
                xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById('list').innerHTML = xmlhttp.responseText;
                    }
                };
                xmlhttp.open("GET", "ajaxServer.php?libname=" + name, true);
                xmlhttp.send();
                displayContent("ajaxOtherlibs.php", 'otherlibs');
            }

            function get_wishid() {
                var wish = document.querySelector('.refs:checked').value;
//                alert(wish);
                xmlhttpgw = new XMLHttpRequest();
                xmlhttpgw.onreadystatechange = function () {
                    if (xmlhttpgw.readyState == 4 && xmlhttpgw.status == 200) {
                        document.getElementById('editbox').innerHTML = xmlhttpgw.responseText;
                    }
                };
                xmlhttpgw.open("GET", "ajaxEdit.php?libid=" + wish, true);
                xmlhttpgw.send();
            }

            function getChkArray(name) {
                var chkbox = document.getElementsByName(name);
//            alert(chkbox[0].value);
                var chked = [];

                for (var i = 0; i < chkbox.length; i++) {
                    if (chkbox[i].checked == true)
                        chked.push(chkbox[i].value);
                }
                return chked.length > 0 ? chked : -1;
            }

            function removeRefs(name) {
                var remArray = new Array();
                remArray = getChkArray(name);
                var json = JSON.stringify(remArray);
                var url = "ajaxRemove.php?removeArray=" + json;

                xmlhttp1 = new XMLHttpRequest();
                xmlhttp1.onreadystatechange = function () {
                    if (xmlhttp1.readyState == 4 && xmlhttp1.status == 200) {
                        document.getElementById('list').innerHTML = xmlhttp1.responseText;
                    }
                };

                xmlhttp1.open('get', url, true);
                xmlhttp1.send();
                displayContent("ajaxTrash.php", 'trash');
            }

            function moveto(name) {
//                alert('cor');
                var mArray = new Array();
                mArray = getChkArray(name);
                var json = JSON.stringify(mArray);
                alert(json);
                var target = document.getElementById('targetlib');
                var lib = target.value;
                var url = "ajaxMoveTo.php?moveArray=" + json + "&target=" + lib;

                xmlhttp_mt = new XMLHttpRequest();
                xmlhttp_mt.onreadystatechange = function () {
                    if (xmlhttp_mt.readyState == 4 && xmlhttp_mt.status == 200) {
                        document.getElementById('list').innerHTML = xmlhttp_mt.responseText;
                    }
                };

                xmlhttp_mt.open('get', url, true);
                xmlhttp_mt.send();
            }

            function displayContent(purl, pdivid) {
                var url = purl;
                xmlhttpdt = new XMLHttpRequest();
                xmlhttpdt.onreadystatechange = function () {
                    if (xmlhttpdt.readyState == 4 && xmlhttpdt.status == 200) {
                        document.getElementById(pdivid).innerHTML = xmlhttpdt.responseText;
                    }
                };
                xmlhttpdt.open('get', url, true);
                xmlhttpdt.send();
            }

            function delTrashRefs(name) {
                var trasharray = new Array();
                trasharray = getChkArray(name);
//                alert('remove=' + trasharray);
                var jsonTrash = JSON.stringify(trasharray);
                var urld = "deleteTrash.php?trashArray=" + jsonTrash;

                xmlhttp_dtr = new XMLHttpRequest();
                xmlhttp_dtr.onreadystatechange = function () {
                    if (xmlhttp_dtr.readyState == 4 && xmlhttp_dtr.status == 200) {
                        document.getElementById('trash').innerHTML = xmlhttp_dtr.responseText;
                    }
                };
                xmlhttp_dtr.open('get', urld, true);
                xmlhttp_dtr.send();
            }

            function dropOtherLibs(name) {
                var droparray = new Array();
                droparray = getChkArray(name);
//                alert('remove=' + trasharray);
                var json = JSON.stringify(droparray);
                var urld = "deleteTrash.php?trashArray=" + json;

                xmlhttp_dtr = new XMLHttpRequest();
                xmlhttp_dtr.onreadystatechange = function () {
                    if (xmlhttp_dtr.readyState == 4 && xmlhttp_dtr.status == 200) {
                        document.getElementById('trash').innerHTML = xmlhttp_dtr.responseText;
                    }
                };
                xmlhttp_dtr.open('get', urld, true);
                xmlhttp_dtr.send();
            }

        </script>
    </head>
    <body>
        <div id="header">
            <div id="logout">
                <form action="server_login.php" method="post">
                    <input type="hidden" name="status" value="logout"/>
                    <input type="submit" name="submit" value="Logout"/>
                </form>
            </div>
            <div id="searchbox">
                <form action="search.php" method="post">
                    <input class="search" name="keyword" type="text" />
                    <input class="search" type="submit" name="submit" value="Search" />
                </form>
            </div>
            <div id="selectlib">
                <?php
                require_once 'webpage_functions.php';
                show_libs($_SESSION['id']);
                ?>
            </div>
        </div>
        <?php
        require_once 'server_funcs.php';
        if (isset($_POST['action'])) {
            $action = $_POST['action'];
        } else {
//            echo 'no action';
            $action = "";
        }

        switch ($action) {
            //possibly no need to store a deleted table.
            case 'deltab':
                if (isset($_POST['submit']) && isset($_POST['libs'])) {
                    $libs = $_POST['libs'];
                    foreach ($libs as $lib) {
                        drop_trash_table($_SESSION['id'], $lib);
                    }
                }
                break;
            case 'addref':
                if (isset($_POST['submit']) && !empty($_POST['title']) && !empty($_POST['author']) && !empty($_POST['year']) && !empty($_POST['pdf'])) {
                    $libname = $_SESSION['active_lib']; //stored in session
//                        echo "<script>alert('$libname')</script>";
                    $title = $_POST['title'];
                    $author = $_POST['author'];
                    $year = $_POST['year'];
                    $pdf = $_POST['pdf'];
                    insertRef($libname, $title, $author, $year, $pdf);
                } else {
                    echo "<script>alert('not enough info')</script>";
                }
                break;
            case 'update':
                if (isset($_POST['submit'])) {
                    $up_title = $_POST['update_title'];
                    $up_author = $_POST['update_author'];
                    $up_year = $_POST['update_year'];
                    $up_pdf = $_POST['update_pdf'];
                    $refid = $_POST['refid'];
                    update_ref($_SESSION['active_lib'], $refid, $up_title, $up_author, $up_year, $up_pdf);
                } else {
                    echo 'not enough infomation';
                }
                break;
            case 'newlib':
                if (allow_more_libs($_COOKIE['id']) && !is_already_exist_libname($_POST['newlib']) && isset($_POST['newlib'])) {
                    $libname = $_POST['newlib'];
                    create_new_lib($_COOKIE['id'], $libname);
                } else {
                    echo 'You could not have more librarys !';
                }
                break;
            case 'rename':
                if (!is_already_exist_libname($_POST['newlibname'])) {
                    $oldlibname = $_SESSION['active_lib'];
                    $_SESSION['active_lib'] = $_POST['newlibname'];
                    update_libname($_SESSION['id'], $oldlibname, $_POST['newlibname']);
                    rename_table($oldlibname, $_POST['newlibname']);
                } else {
                    echo 'This name already exists.';
                }
                break;
            default:
                break;
        }
        ?>
        <div id="container">
            <div id="left_list">
                <div id="addbox" >
                    <fieldset>
                        <legend>Add a new ref</legend>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <table>
                                <tr>
                                    <th>Title:</th><td><input name="title" type="text"/></td>
                                </tr>
                                <tr>
                                    <th>Author:</th><td><input name="author" type="text"/></td>
                                </tr>
                                <tr>
                                    <th>Year:</th><td><input name="year" type="text" /><br/></td>
                                </tr>
                                <tr>
                                    <th>PDF:</th><td><input name="pdf" type="text" /><br/></td>
                                </tr>
                            </table>
                            <div class="s_input">
                                <input type="hidden" name="action" value="addref"/>
                                <input  type="submit" name="submit" value="add ref"/>
                            </div>
                        </form>
                    </fieldset>
                </div>
                <div>
                    <fieldset>
                        <legend>Edit</legend>
                        <div id="editbox">
                            Here is the edit box
                        </div>
                    </fieldset>
                </div>
                <div id="movetobox" class="s_input">
                    <fieldset>
                        <legend>Move to</legend>
                        <input type="text" name="targetlib" id="targetlib" />
                        <input type="button" name="moveto" value="Confirm" 
                               onclick="moveto('checkbox[]')"/>
                    </fieldset>

                </div>
                <div id="newlibbox" class="s_input">
                    <fieldset>
                        <legend>New Library</legend>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <input type="text" name="newlib" placeholder="New Library"/>
                            <input type="hidden" name="action" value="newlib"/>
                            <input name="submit" type="submit" value="New Library"/>
                        </form>
                    </fieldset>
                </div>
                <div>
                    <fieldset>
                        <legend>The Other Libraries</legend>
                        <div id="otherlibs" class="s_input">
                            <?php
                            get_other_libs($_SESSION['id'], $_SESSION['active_lib']);
                            ?>
                        </div>
                    </fieldset>
                </div>
                <div id="renamelibbox" class="s_input">
                    <fieldset>
                        <legend>Rename Current Library </legend>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <input type="text" name="newlibname" placeholder="new name"/>
                            <input type="hidden" name="action" value="rename"/>
                            <input type="submit" name="submit" value="confirm"/>
                        </form>
                    </fieldset>
                </div>
                <div id="sharebox">
                    <fieldset>
                        <legend>Share</legend>
                        <a href="share.php">Share With</a>
                        <a href="unshare.php">Unshare</a>
                    </fieldset>
                </div>
            </div>
            <div id="right_list">
                <div id="ref_list">
                    <div id="btn_remove">
                        <input type="button" name="" value="Move to Trash" 
                               onclick="removeRefs('checkbox[]')" />
                    </div>
                    <div >
                        <form action="bibli.php" method="post">
                            <div id="list">
                                <?php
                                get_sorted_refs($_SESSION['active_lib'], $_SESSION['sortby'], $_SESSION['current_order']);
                                ?>
                            </div>
                            <input type='button' name='edit' value='edit' onclick='get_wishid()'/>
                        </form>
                    </div>

                </div>
                
                <div id="trash_list">
                    <div id="trashbox">

                        <div id="trash">
                            <?php
                            get_trash($_SESSION['id']);
                            ?>
                        </div>
                        <div id="trash_cleanupbox">
                            <form method="post" action="cleanTrash.php">
                                <input type="submit" name="submit" value="CleanUp"/>
                            </form>
                        </div>
                        <div id="trash_delbox">
                            <input type="button" name="deltrash" value="delete refs by js" 
                                   onclick="delTrashRefs('trash[]')" />
                        </div>
                    </div>
                </div>
            </div>
            <div id="blankspace">

            </div>
        </div>
    </body>
</html>
