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

/* user */
$sql1 = "CREATE VIEW gamepurchasedby AS
SELECT Purchased.user_id, Game.game_name
FROM Game INNER JOIN Purchased On Game.game_id = Purchased.game_id
order by Purchased.user_id";

$sql2 = "SELECT * FROM gamepurchasedby";

$res1 = $conn->query($sql1) or die($conn->error);
$result = $conn->query($sql2) or die($conn->error);

echo "<table class='table'>
<thead class='thead-dark'>
<tr>
<th>User ID</th>
<th>Game Name</th>
</tr>
</thead>
<tbody>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['user_id'] . "</td>";
    echo "<td>" . $row['game_name'] . "</td>";
    echo "</tr>";
}
echo "</tbody>";
echo "</table>";

$conn->close();

?>

<footer class="container-fluid text-center">
    <a href="/admin/Special.html"><button type="button" class="btn btn-primary">Back</button></a>
</footer>
</body>
</html>