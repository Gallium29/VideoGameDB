<?php

$developer_id = $_POST["developer_id"];
$developer_name = $_POST["developer_name"];
$location = $_POST["location"];
$average_game_rating = $_POST["average_game_rating"];

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

/* developer */
$sql = "INSERT INTO Developer
		VALUES ('$developer_id', '$developer_name', '$location', '$average_game_rating')";
if ($conn->query($sql) === TRUE) {
    echo "Insertion success.\n";
}
else {
    echo "Insertion Error: " . $conn->error;
}


/* res after insertion */

/* developer */
$sql = "SELECT * 
		FROM Developer";
$res = $conn->query($sql);
if ($res->num_rows > 0) {
    echo "<table><tr><th>developer_id</th><th>developer_name</th><th>location</th><th>average_game_rating</th></tr>";
    while($row = $res->fetch_assoc()) {
        echo "<tr><td>".$row["developer_id"]."</td><td>".$row["developer_name"]."</td><td> ".$row["location"]."</td><td>".$row["average_game_rating"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();

?>

<a href="InsertDeveloper.html"><button type="button" class="btn btn-primary">Back to Insert Page</button></a>