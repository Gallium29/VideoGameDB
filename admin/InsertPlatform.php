<html lang="en">
<head>
    <title>Special</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<body>

<div class="jumbotron">
    <div class="container text-center">
        <h1>Special Queries</h1>
        <p>On this page you will be able to perfrom the special queries</p>
    </div>
</div>

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
$result = $conn->query($sql);


echo "<table class='table'>
<thead class='thead-dark'>
<tr>
<th>Platform ID</th>
<th>Platform Name</th>
</tr>
</thead>
<tbody>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['platform_id'] . "</td>";
    echo "<td>" . $row['platform_name'] . "</td>";
    echo "</tr>";
}
echo "</tbody>";
echo "</table>";

$conn->close();

?>

<footer class="container-fluid text-center">
    <a href="/admin/InsertPlatform.html"><button type="button" class="btn btn-primary">Back</button></a>
</footer>
</body>
</html>
