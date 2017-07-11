<?php
$host="localhost"; // Host name
$username="*****"; // Mysql username
$password="*****"; // Mysql password
$db_name="mydatabase"; // Database name

$web_path="/public_html/" //address of your files on the server(such as "/public_html/").
$from="info@example.com " //email address of your website (such as: info@example.com).
$to= "me@gmail.com" //email of yours (such as : me@gmail.com).
$subject="The Web files have been Threatened"  //subject of email


// Create connection
$conn = new mysqli($host, $username, $password, $db_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
