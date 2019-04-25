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

$game_id = $_POST["game_id"];
$game_name = $_POST["game_name"];
$genre = $_POST["genre"];
$rating = $_POST["rating"];
$release_date = $_POST["release_date"];
$developer_id = $_POST["developer_id"];

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

/* game */
$sql = "INSERT INTO Game
		VALUES ('$game_id', '$game_name', '$genre', '$rating', '$release_date', '$developer_id')";
if ($conn->query($sql) === TRUE) {
    echo "Insertion success.\n";
}
else {
    echo "Insertion Error: " . $conn->error;
}

/* res after insertion */

/* game */

$sql = "SELECT * 
        FROM Game";
$result = $conn->query($sql);

echo "<table class='table'>
<thead class='thead-dark'>
<tr>
<th>Game ID</th>
<th>Game Name</th>
<th>genre</th>
<th>Rating</th>
<th>Release Date</th>
<th>Developer ID</th>
</tr>
</thead>
<tbody>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['game_id'] . "</td>";
    echo "<td>" . $row['game_name'] . "</td>";
    echo "<td>" . $row['genre'] . "</td>";
    echo "<td>" . $row['rating'] . "</td>";
    echo "<td>" . $row['release_date'] . "</td>";
    echo "<td>" . $row['developer_id'] . "</td>";
    echo "</tr>";
}
echo "</tbody>";
echo "</table>";

$conn->close();

?>

<footer class="container-fluid text-center">
    <a href="/admin/InsertGame.html"><button type="button" class="btn btn-primary">Back</button></a>
</footer>
</body>
</html>
