<?php
    $RepoCreate = [
        "name" => $_POST["name"],
        "description" => $_POST["description"],
        "private" => $_POST["private"] == "true" ? true : false
    ];
    $ch = require "CurlConnect.php";
    curl_setopt($ch, CURLOPT_URL,"https://api.github.com/user/repos");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($RepoCreate));
    $response = json_decode(curl_exec($ch),true);
    curl_close($ch);
    $StatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $patchAcceptedStatusCodes = [200, 201, 204];
    $ErrorCodes = [400, 401, 403, 404, 406, 409, 410, 415, 422, 429, 500, 502, 503];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>successfullyAdded</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <link rel="icon" type="image/png" href="social.png">
    <?php require "font.php"?>
    <style>
        <?php require "Styling.php" ?>
        main{
            margin-top:150px;
            text-align: center;
        }
    </style>
</head>
<body>
   <main>
       <?php if(in_array($StatusCode , $patchAcceptedStatusCodes)):?>
        <h1>Repository Name : <?= $response["name"] ?></h1><br>
        <h3>Repository created successfully...</h3><br><br>
        <a style = "background: #119822; border:none;" role = "button" href="show.php?full_name=<?= $response['full_name']?>">Show the Added Repo</a>
        <?php require "BackToHomePage.php"?>
        <a role="button" onclick="sendPostRequest()">Back To Home Page</a>
       <?php endif;?>
       <?php if(in_array($StatusCode , $ErrorCodes)):?>
        <h1>Repository is not created successfully...</h1><br><br>
        <?php require "BackToHomePage.php"?>
        <a style = "background: #c1121f; border:none;" role="button" onclick="sendPostRequest()">Back To Home Page</a>
       <?php endif;?>
    </main> 
</body>
</html>
