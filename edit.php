<?php
  $full_name = $_GET["full_name"];
  $full_name_url = "https://api.github.com/repos/".trim($full_name);
  $ch = require "CurlConnect.php";
  curl_setopt($ch, CURLOPT_URL, $full_name_url);
  $repo = json_decode(curl_exec($ch),true);
  curl_close($ch);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>EditRepos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <link rel="icon" type="image/png" href="social.png">
    <?php require "font.php"?>
    <style>
        <?php require "Styling.php" ?>
        .checkBoxDiv{
            margin: 10px 0 30px 0;
            text-align: center;
        }
        main{
            margin-top:50px;
        }
    </style>
</head>
  <body>
    <main>
    <form action="update.php" method="POST">
        <input type="hidden" name="full_name" value="<?= $repo['full_name'] ?>">
        <label for="RepoName">Repo Name</label>
        <input type="text" name="name" value = "<?= $repo['name']?>"/>
        <label for="RepoDescription">Repo Description</label>
        <textarea name="description"><?= $repo['description']?></textarea> 
        <div class="checkBoxDiv">
          <legend>Select the Repository Privacy Settings</legend>
          <input type="radio" id="public" name="private" aria-invalid="true" value = "false" <?= $repo["private"] == false ? "checked": "unchecked" ?>/>
          <label htmlFor="public">Public</label>
          <input type="radio" id="private" name="private"  aria-invalid="false" value = "true" <?= $repo["private"] == true ? "checked": "unchecked" ?>/>
          <label htmlFor="private">Private</label>
        </div>
        <div style="width:100%; text-align: center; margin-top:50px;">
          <button style = "width:40%;  background: #d81159 ; border:none;">Edit Now</button>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <?php require "BackToHomePage.php"?>
          <a style="width: 40%;" role="button" onclick="sendPostRequest()">Back To Home Page</a>
        </div>
      </form>
    </main>
  </body>
</html>