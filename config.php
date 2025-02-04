<?php
$servername = "mysql.awardspace.com";
$username = "4584468_user";   
$password = "sisaytibebu123";
$dbname = "4584468_user"; 
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

