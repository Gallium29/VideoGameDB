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

/* special query1 */

/* user */
$sql1 = "CREATE VIEW gamepurchasedby AS
SELECT purchased.user_id, game.game_name
FROM game INNER JOIN purchased On game.game_id = purchased.game_id
order by purchased.user_id";

$sql2 = "SELECT game_name, count(user_id) as gc
from gamepurchasedby
group by game_name
order by gc desc;";

$res1 = $conn->query($sql1);
$result = $conn->query($sql2) or die($conn->error);

echo "<table class='table'>
<thead class='thead-dark'>
<tr>
<th>Game</th>
<th>Count</th>
</tr>
</thead>
<tbody>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['game_name'] . "</td>";
    echo "<td>" . $row['gc'] . "</td>";
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
</head>
</html>