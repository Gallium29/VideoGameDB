<?php

$user_id = $_POST["user_id"];
$game_id = $_POST["game_id"];
$purchase_date = $_POST["purchase_date"];
$rating = $_POST["rating"];

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

/* insert function */

/* purchased */
$sql = "INSERT INTO Purchased
		VALUES ('$user_id', '$game_id', '$purchase_date', '$rating')";
if ($conn->query($sql) === TRUE) {
    echo "Insertion success.\n";
}
else {
    echo "Insertion Error: " . $conn->error;
}

/* res after insertion */

/* purchased */
$sql = "SELECT * 
		FROM Purchased";
$res = $conn->query($sql);
if ($res->num_rows > 0) {
    echo "<table><tr><th>user_id</th><th>game_id</th><th>purchase_date</th><th>rating</th></tr>";
    while($row = $res->fetch_assoc()) {
        echo "<tr><td>".$row["user_id"]."</td><td>".$row["game_id"]."</td><td>".$row["purchase_date"]."</td><td>".$row["rating"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}


$conn->close();

?>