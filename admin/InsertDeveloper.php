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
        <h1>Insert Developer</h1>
        <p>On this page you will see the result after inserting developers</p>
    </div>
</div>

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
$result = $conn->query($sql);

echo "<table class='table'>
<thead class='thead-dark'>
<tr>
<th>Developer ID</th>
<th>Developer Name</th>
<th>Location</th>
<th>Average Rating</th>
</tr>
</thead>
<tbody>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['developer_id'] . "</td>";
    echo "<td>" . $row['developer_name'] . "</td>";
    echo "<td>" . $row['location'] . "</td>";
    echo "<td>" . $row['average_game_rating'] . "</td>";
    echo "</tr>";
}
echo "</tbody>";
echo "</table>";

$conn->close();
?>

<footer class="container-fluid text-center">
    <a href="/admin/InsertDeveloper.html"><button type="button" class="btn btn-primary">Back</button></a>
</footer>
</body>
</html>