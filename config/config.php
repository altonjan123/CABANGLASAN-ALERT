<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "pms_db";

$conn = new mysqli($host, $user, $password, $db);

// echo $check = (!$mysqli) ? "Failed to connect" : "";

echo $check = (!$conn) ? "Failed to connect" : "";

?>