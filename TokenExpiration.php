<?php
// session_start();
// $url = "https://api.github.com/user";
// $ch = curl_init($url);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_HTTPHEADER, [
//     "Authorization: token " . $_SESSION["token"],
//     "User-Agent: MyGitHubApp",
// ]);
// curl_setopt($ch, CURLOPT_HEADER, true);
// $response = curl_exec($ch);
// curl_close($ch);
// $pattern = "/github-authentication-token-expiration:\s(.*)/";
// preg_match($pattern, $response, $match);
// $timeZone = date_default_timezone_set("Asia/Amman");
// $expire = strtotime($match["1"]);
// $expirationTime = date("Y/m/d H:i:s", $expire);
// return $expirationTime;
// $date1 = new DateTime($creationTime);
// $date2 = new DateTime();
// $diff = $date1->diff($date2);
// echo "Token expires in ".$diff->format("y/m/d H:i:s");
// echo "Difference: " . $diff->y . " years, " . $diff->m . " months, " . $diff->d . " days, ";
// echo $diff->h . " hours, " . $diff->i . " minutes, " . $diff->s . " seconds.";
