<?php
   $ch = require "CurlConnect.php";
   $full_name = $_GET['full_name'];
   $full_name_url = "https://api.github.com/repos/".trim($full_name);
   $ch = require "CurlConnect.php";
   curl_setopt($ch, CURLOPT_URL, $full_name_url);
   $repo = json_decode(curl_exec($ch),true);
   curl_close($ch);
   $timeZone = date_default_timezone_set("Asia/Amman");
   $time = strtotime($repo["created_at"]);
   $creationTime = date("y/m/d H:i:s", $time);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <title>ShowingRepoDet</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <link rel="icon" type="image/png" href="social.png">
    <?php require "font.php"?>
    <style>
        <?php require "Styling.php" ?>
        th,td{
         text-align: center;
        }
        main{
            margin-top:150px;
        }
    </style>
</head>
<body>
    <main>
    <table>
        <thead>
            <th>Name</th>
            <th>Description</th>
            <th>Creation Time</th>
            <th>Size</th>
            <th>Commits</th>
        </thead>
        <tbody>
            <?php 
                echo "<tr>";
                echo "<td>".$repo["name"]."</td>";
                echo "<td>".($repo["description"]??"there is no description.")."</td>";
                echo "<td>".$creationTime."</td>";
                echo "<td>".ceil($repo["size"]/1034)."MB</td>";
                echo "<td><a style = 'background:#dc2f02; outline:none; border:none;' href='commits.php?full_name= {$repo["full_name"]}' role = 'button'>show me commits</a></td>";
                echo "</tr>";
            ?>
        </tbody>
    </table>
    <div style="width:100%; text-align: center; margin-top:50px;">
    <a role = 'button' style = "width: 27%; background: #d81159 ; border:none;" href='edit.php?full_name=<?=$repo["full_name"]?>?'>
        Edit the repository
    </a> &nbsp;&nbsp;&nbsp;&nbsp;
    <a role = 'button' style = "width: 27%; background: #d00000; border:none;" href='delete.php?full_name=<?=$repo["full_name"]?>?'>
        Delete the repository
    </a> &nbsp;&nbsp;&nbsp;&nbsp;
    <?php require "BackToHomePage.php"?>
    <a style="width: 27%;" role="button" onclick="sendPostRequest()">Back To Home Page</a>
    </div>
    <script>
        <?php require "mode.php"?>
    </script>
</body>
</main>
</html>