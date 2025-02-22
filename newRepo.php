<!DOCTYPE html>
<html lang="en">
<head>
    <title>AddingNewRepo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <link rel="icon" type="image/png" href="social.png">
    <?php require "font.php"?>
    <style>
        <?php require "Styling.php" ?>
        .checkBoxDiv{
            margin: 10px 0 30px 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <main>
        <form action="create.php" method="POST">
            <label for="RepoName">Repo Name</label>
            <input type="text" name="name"/>
            <label for="RepoDescription">Repo Description</label>
            <textarea name="description"></textarea>
            <div class="checkBoxDiv">
              <legend>Select the Repository Privacy Settings</legend>
              <input type="radio" id="public" name="private" aria-invalid="true" value = "false" />
              <label htmlFor="public">Public</label>
              <input type="radio" id="private" name="private"  aria-invalid="false" value = "true"/>
              <label htmlFor="private">Private</label>
            </div>
            <div style="width:100%; text-align: center;">
              <button style = "width: 40%; background: #119822; border:none;">Add New Repository</button>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <a style="width: 40%;" role="button" onclick="sendPostRequest()">Back To Home Page</a>
            </div>
        </form>
    </main>
    <?php require "BackToHomePage.php"?>
</body>
</html>
<!-- 
false -> public
true -> private 
-->