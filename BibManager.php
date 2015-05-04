<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Welcome to K-Cooperation</title>
        <style>
            body{
                margin: 0;
                padding: 5px;
            }
            .header, .footer{
                border: 1px solid black;
                margin: 0;
            }
            
            .content{
                margin: 0;
                padding: 10px;
                border-left: 1px solid black;
                border-right: 1px solid black;
                border: 1px solid aqua;
                background-color: chartreuse;
                height: 650px;
            }
            .content div{
                border: 1px dashed blue;
                background-color: red;
            }
            .left{
                float: left;
                width: 600px;
            }
        </style>
    </head>
    <body>
        <div class="header">
            <ul>
                <li>
                    <dl>
                        <dt></dt>
                        <dd></dd>
                    </dl>
                </li>
            </ul>
            <ul>
                <li>
                    <dl>
                        <dt></dt>
                        <dd></dd>
                    </dl>
                </li>
            </ul>
            <ul>
                <li>
                    <dl>
                        <dt></dt>
                        <dd></dd>
                    </dl>
                </li>
            </ul>
        </div>
        <div class="content">
            <div class="banner">
                This is the banner, sort, search,etc
            </div>
            <div class="left">
                This is the left content
            </div>
            <div class="right">
                This is the right content
            </div>
            <div class="docker">
                This is docker
            </div>
        </div>
        <div class="footer">
            <h2>This is the footer.</h2>
        </div>
    </body>
</html>
