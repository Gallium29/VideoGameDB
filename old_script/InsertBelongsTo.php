<?php

$game_id = $_POST["game_id"];
$platform_id = $_POST["platform_id"];

$servername = "localhost";
$username = "root"; //update
$password = "zhengjia"; // update
$dbname = "gamedb";

/* connect to database */
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo "Connection failed.";
    die("Connection failed: " . $conn->connect_error);
}

/* insert function */

/* belongs to */
$sql = "INSERT INTO BelongsTo
		VALUES ('$game_id', '$platform_id')";
if ($conn->query($sql) === TRUE) {
    echo "Insertion success.\n";
}
else {
    echo "Insertion Error: " . $conn->error;
}

/* res after insertion */

/* belongs to */
$sql = "SELECT * 
		FROM BelongsTo";
$res = $conn->query($sql);
if ($res->num_rows > 0) {
    echo "<table><tr><th>game_id</th><th>platform_id</th>></tr>";
    while($row = $res->fetch_assoc()) {
        echo "<tr><td>".$row["game_id"]."</td><td>".$row["platform_id"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();

?>