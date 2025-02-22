<?php
    @session_start();
    $ch = require "CurlConnect.php";
    curl_setopt($ch, CURLOPT_URL,"https://api.github.com/repos/".trim($_GET["full_name"]));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    $response = json_decode(curl_exec($ch),true);
    curl_close($ch);
    $StatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $patchAcceptedStatusCodes = [200, 204];
    $ErrorCodes = [400, 401, 403, 404, 406, 409, 410, 415, 422, 429, 500, 502, 503];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>UpdateRepos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <link rel="icon" type="image/png" href="social.png">
    <?php require "font.php"?>
    <style>
        <?php require "Styling.php" ?>
        main{
            margin-top:180px;
            text-align: center;
        }
    </style>
</head>
<body>
    <main>
        <?php if(in_array($StatusCode , $patchAcceptedStatusCodes)):?>
         <h1>Repository Deleted successfully...</h1><br>
         <?php require "BackToHomePage.php"?>
         <a style = "background: #c1121f; border:none;" role="button" onclick="sendPostRequest()">Back To Home Page</a>
       <?php endif;?>
       <?php if(in_array($StatusCode , $ErrorCodes)):?>
        <h1>Repository is not Deleted...</h1><br>
        <?php require "BackToHomePage.php"?>
        <a style = "background: #c1121f; border:none;" role="button" onclick="sendPostRequest()">Back To Home Page</a>
      <?php endif;?>
    </main>
</body>
</html>