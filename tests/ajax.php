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
            function getinfo() {
                xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById('show').innerHTML = xmlhttp.responseText;
                    }
                };
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

            function show(name) {
                document.getElementById('show').innerHTML = getChkArray(name);
            }
            function testjson(name) {
                var testArray = new Array();
                testArray = getChkArray(name);
                //alert('testArray=' + testArray);
                var jsonArray = JSON.stringify(testArray);
                var url = "json.php?action=test&jsonArray=" + jsonArray;

                xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById('show').innerHTML = xmlhttp.responseText;
                    }
                };

                xmlhttp.open('get', url, true);
                xmlhttp.send();
            }
        </script>
    </head>
    <body>
        <div>
            check box<br/>
            <input type="checkbox" name="chk" value="1"/>aaa<br/>
            <input type="checkbox" name="chk"  value="2"/>bbb<br/>
            <input type="checkbox" name="chk" value="3"/>ccc<br/>
            <input type="button" name="show" value="show checked id" onclick="show('chk')"/>
            <input type="button" name="display" value="show json" onclick="testjson('chk')"/>
        </div>
        <div id="show">

        </div>
        <?php
        // put your code here
        ?>
    </body>
</html>
