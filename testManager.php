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
        <script>
            function showlib(id){
                xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                   if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                       document.getElementById('list').innerHTML = xmlhttp.responseText;
                   } 
                };
                xmlhttp.open("GET", "ajaxServer.php?libname=" + id, true);
                xmlhttp.send();
            }
        </script>
    </head> 
    <body>
        <div>give lib name:<br/>
            <select name="userId" onchange="showlib(this.value)">
                <option value="">Select lib name</option>
                <option value="start">start</option>
                <option value=""></option>
                <option value=""></option>
                <option value=""></option>
            </select>
        </div>
        <div>display lib rows:
        </div>
        <div>This is for inset into lib<br/></div>
        <div id="list"></div>
        <div></div>
        <?php
        // put your code here
        ?>
    </body>
</html>
