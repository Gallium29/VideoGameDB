<?php

$platform_id = $_POST["platform_id"];

$servername = "localhost";
$username = "root";
$password = "zhengjia";
$dbname = "gamedb";

/* connect to database */
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo "Connection failed.";
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "DELETE FROM Platform WHERE platform_id = $platform_id"; 
if($conn->query($sql) === TRUE){ 
	echo "Record was deleted successfully."; 
} 
else{ 
	echo "ERROR: Could not able to execute $sql. " 
								. $conn->error; 
} 

$conn->close();

?> 
