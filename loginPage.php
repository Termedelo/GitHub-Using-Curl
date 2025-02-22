<!DOCTYPE html >
<html id="htmlTag" lang="en" data-theme="dark">
<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="icon" type="image/png" href="social.png">
    <?php require "font.php"?>
    <style>
        <?php require "Styling.php" ?>
        h1{
            font-family: Comfortaa;
            text-align: center;
            margin-top: 120px; 
        }
        .lightMode{
            position: absolute;
            left: calc(100% - 100px);
            display: flex;
            flex-direction: column;
            text-align: center;
            background-color: transparent;
            border-color: transparent;
            outline: transparent;
        }
    </style>
</head>
   <body>
    <main>
        <div class="lightMode" role="button" onclick = "ChangeMode()">
            <i id = "bulb" style = "color:#a4acba; font-size:35px;" class="fa-regular fa-lightbulb"></i>
            <h5 id = "ModeText">Dark</h5>
        </div>
        <h1>Just A Simple GitHub DashBoard</h1>
        <form action = "index.php" method="POST">
            <label for="User">User Name</label>
            <input type="text" name="User" placeholder="Enter Your GitHub User Name"/>
            <label for="token">Authorization Token</label>
            <input type="password" name="token" placeholder="Enter Your Authorization Token Here"/>
            <button type="submit">Login With This Token</button>
        </form>
    </main>
    <script>
        <?php require "mode.php";?>
    </script>
   </body>
</html>