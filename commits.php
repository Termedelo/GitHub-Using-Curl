<?php
$page = 1;
$allCommits = [];
$ch = require "CurlConnect.php";
$full_name = $_GET['full_name'];
do {
    $full_name_url = "https://api.github.com/repos/".trim($full_name)."/commits?per_page=100&page=$page";
    curl_setopt($ch, CURLOPT_URL, $full_name_url);
    $commits = json_decode(curl_exec($ch),true);
    $allCommits = array_merge($allCommits, $commits);
    $page++;
} while (count($commits) === 100);
curl_close($ch);
$StatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$AcceptedStatusCodes = [200, 201, 204];
$ErrorCodes = [400, 401, 403, 404, 406, 409, 410, 415, 422, 429, 500, 502, 503];
?>
<!DOCTYPE html>
<html lang="en">
   <head>
       <title>ShowingCommits</title>
       <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
       <link rel="icon" type="image/png" href="social.png">
       <?php require "font.php"?>
       <style>
        <?php require "Styling.php"?>
        .noCommits{
            margin-top:150px;
            text-align: center;
        }
        th, td{
            text-align: center;
        }
       </style>
   </head>
   <body>
       <main>
       <?php if(in_array($StatusCode , $AcceptedStatusCodes)):?> 
       <button style="width:100%; margin:10px 0 25px 0;" onclick='scrollToBottom()'>↓ ↓ ↓ Go To The Bottom Of The Page ↓ ↓ ↓</button>
       <table>
        <thead>
            <th>#</th>
            <th>Author Name</th>
            <th>Commit Message</th>
            <th>Creation Time</th>
        </thead>
        <tbody>
            <?php 
                $timeZone = date_default_timezone_set("Asia/Amman");
                $i = 1;
                foreach ($allCommits as $commit) {
                    $time = strtotime($commit["commit"]["author"]["date"]);
                    echo "<tr>";
                    echo "<td style = 'text-align:center;'>".$i++."</td>";
                    echo "<td style = 'text-align:center;'>".$commit["commit"]["author"]["name"]."</td>";
                    echo "<td style = 'overflow-wrap: break-word; word-break: break-word; width: 550px;'>".$commit['commit']['message']."</td>";
                    echo "<td>".date("y/m/d H:i:s", $time)."</td>";
                    echo "</tr>";
                }
                
             ?>  
        </tbody>
      </table>
      <?php require "BackToHomePage.php"?>
      <a style="width:100%" role="button" onclick="sendPostRequest()">Back To Home Page</a>
      <?php endif;?>
       <?php if(in_array($StatusCode , $ErrorCodes)): ?>
        <div class="noCommits">
          <h1>This Repository Has No Commits...</h1><br><br>
          <?php require "BackToHomePage.php"?>
          <a style="background: #c1121f; border:none;" role="button" onclick="sendPostRequest()">Back To Home Page</a>
        </div>
       <?php endif; ?>
    </main>
    <script>
       function scrollToBottom() {
            window.scrollTo({top: 10000, behavior: "smooth"});
        }
    </script>
   </body>
</html>