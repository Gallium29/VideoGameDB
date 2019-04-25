<?php

$platform_id = $_POST["platform_id"];
$platform_name = $_POST["platform_name"];

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

/* platform */
$sql = "INSERT INTO Platform
		VALUES ('$platform_id', '$platform_name')";
if ($conn->query($sql) === TRUE) {
    echo "Insertion success.\n";
}
else {
    echo "Insertion Error: " . $conn->error;
}

/* res after insertion */

/* platform */
$sql = "SELECT * 
		FROM Platform";
$res = $conn->query($sql);
if ($res->num_rows > 0) {
    echo "<table><tr><th>platform_id</th><th>platform_name</th></tr>";
    while($row = $res->fetch_assoc()) {
        echo "<tr><td>".$row["platform_id"]."</td><td>".$row["platform_name"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();

?>

<a href="/admin/InsertPlatform.html"><button type="button" class="btn btn-primary">Back to Insert Page</button></a>
