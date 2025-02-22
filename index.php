<?php
    $Token = @$_POST["token"];
    $User = @$_POST["User"];
    @session_start();
    $_SESSION["token"] = trim($Token);
    $_SESSION["User"] = trim($User);
    //! Don't move these lines..................................
    $headers = [
        "User-Agent: {$_SESSION['User']}",
        "Authorization: token {$_SESSION['token']}"
    ];
    $ch = curl_init();
    curl_setopt_array($ch, [
    CURLOPT_HTTPHEADER => $headers,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_URL => "https://api.github.com/user/repos"
    ]);
    $repos = json_decode(curl_exec($ch),true);
    curl_close($ch);
    $StatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $AcceptedStatusCodes = [200, 201, 204];
    $ErrorCodes = [400, 401, 403, 404, 406, 409, 410, 415, 422, 429, 500, 502, 503];
    //#------------------------------------------------------------------------------
    $url = "https://api.github.com/user";
    $chExpire = curl_init($url);
    curl_setopt_array($chExpire, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            "Authorization: token " . $_SESSION["token"],
            "User-Agent: ". $_SESSION["User"]
        ],
        CURLOPT_HEADER => true
    ]);
    $response = curl_exec($chExpire);
    curl_close($chExpire);
    $patternToken = "/github-authentication-token-expiration:\s(.*)/";
    $patternUserName = '/"login"\s*:\s*"([^"]+)"/';
    preg_match($patternToken, $response, $TokenExpire);
    preg_match($patternUserName, $response, $UserName);
    $gitGubUserName = @$UserName[1];
    $timeZone = date_default_timezone_set("Asia/Amman");
    $expire = @strtotime($TokenExpire["1"]);
    $tokenExpirationDate = date("Y/m/d H:i:s", $expire);
?>
<!DOCTYPE html>
<html lang="en" id="htmlTag">
    <head>
    <title>MyGitHubApp</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="icon" type="image/png" href="social.png">
    <?php require "font.php"?>
    <style>
        <?php require "Styling.php" ?>
        th,td{
         text-align: center;
        }
        h5{
          font-family: Comfortaa;
        }
        #logoutBtn{
            border-radius: 150px;
            background: #9062CA; 
            border:none;
            outline: none;
            margin-top: 13px;
            padding: 15px;
        }
        #WrongThings{
            margin-top:190px;
            text-align: center;
        }
        .lightMode{
            position: absolute;
            display: flex;
            flex-direction: column;
            text-align: center;
            background-color: transparent;
            border-color: transparent;
            outline: transparent;
            left: -95px;
        }
        .ModeDiv{
          position: absolute;
          display: flex;
          flex-direction: column;
          text-align: center;
          background-color: transparent;
          border-color: transparent;
          outline: transparent;
          left: calc(100% - 100px);
          align-content: space-between;
          flex-wrap: wrap;
        }
        .infoBar{
            display: flex;
            justify-content: left;
            flex-direction: column;
        }
    </style>
</head>
<body>
    <main>
        <div class="ModeDiv">
        <div class="lightMode" role="button" onclick = "ChangeMode()">
            <i id = "bulb" style = "color:#a4acba; font-size:35px;" class="fa-regular fa-lightbulb"></i>
            <h5 id = "ModeText">Dark</h5>
        </div>
        <a id = "logoutBtn" role = 'button' href="loginPage.php">Logout</a>
        </div>
      <?php if(in_array($StatusCode , $AcceptedStatusCodes) && $gitGubUserName === $User): ?>
      <div class="infoBar">
       <h5>User: <?=$gitGubUserName?></h5>
       <h5> Token Expiration Date: <?=$tokenExpirationDate?></h5>
      </div>
    <table>
        <thead>
            <th>#</th>
            <th>full_name</th>
            <th>name</th>
            <th>description</th>
            <th>Privacy</th>
            <th>Repo Settings</th>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($repos as $repo) {
                echo "<tr>";
                echo "<td>".$i++."</td>";
                echo "<td>".$repo['full_name']."</td>";
                echo "<td>".$repo['name']."</td>";
                echo "<td>".($repo['description']??"there is no description.")."</td>";
                echo "<td>".($repo['private']?"Private":"Public")."</td>";
                echo "<td><a role = 'button' href='show.php?full_name= {$repo["full_name"]}'>Show</a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <a style = "width: 100%; background: #119822; border:none;" href="newRepo.php" role="button">Add A New Repo</a>
    <?php endif;?>
    <?php if(in_array($StatusCode , $ErrorCodes) || $gitGubUserName !== $User): ?>
        <div id="WrongThings">
            <h1>Wrong User Name or Token Try Again....</h1>
            <a style="background: #c1121f; border:none;" role="button" href="loginPage.php">Back To Login Page</a>
        </div>
    <?php endif;?>
    <script>
        <?php require "mode.php"?>
    </script>
</body>
</main>
</html>