<?php
$game_id = $_POST["game_id"];
$game_name = $_POST["game_name"];
$genre = $_POST["genre"];
$developer_id = $_POST["developer_id"];

$servername = "localhost";
$username = "root";
$password = "zhengjia";
$dbname = "gamedb";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo "Connection failed.";
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "UPDATE Game SET game_name = '$game_name', genre = '$genre', developer_id = '$developer_id' WHERE game_id = $game_id";
if ($conn->query($sql) === TRUE) {
    echo "Update success.\n";
}
else {
    echo "Update Error: " . $conn->error;
}

?>