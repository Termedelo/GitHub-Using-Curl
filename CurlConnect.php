<?php
   @session_start();
   $headers = [
    "User-Agent: ". $_SESSION["User"],
    "Authorization: token ".$_SESSION["token"]];
    $ch = curl_init();
    curl_setopt_array($ch, [
    CURLOPT_HTTPHEADER => $headers,
    CURLOPT_RETURNTRANSFER => true
    ]);
    return $ch;
?>