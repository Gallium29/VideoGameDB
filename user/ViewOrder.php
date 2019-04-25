<?php
session_start();
echo "hello, user ". $_SESSION['user_id'];
?>

<html>
<head>
    <title>Game Database</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>

<body>
<div class="jumbotron text-center">
    <h1>Game Database</h1>
    <p>An interactive game database designed for CS 6750, Spring 2019!</p>
</div>

<?php
$servername = "localhost";
$username = "root";
$password = "zhengjia";
$dbname = "gamedb";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo "connnection faild.";
    die("connnection failed: " . $conn->connect_error);
}

$user_id = intval($_SESSION['user_id']);
$select_query = "SELECT * 
                 FROM Game inner join Purchased on Game.game_id = Purchased.game_id
                 where Purchased.user_id = '$user_id'";
$result = $conn->query($select_query) or die($conn->error);

echo "<table border=1>
<tr>
<th>Game Name</th>
<th>Genre</th>
<th>Release Date</th>
<th>Rating</th>
<th>Developer Name</th>
</tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['game_id'] . "</td>";
    echo "<td>" . $row['game_name'] . "</td>";
    echo "<td>" . $row['genre'] . " </td>";
    echo "<td>" . $row['release_date'] . "</td>";
    echo "<td>" . $row['rating'] . "</td>";
}
echo "</table>";

$conn->close();
?>

<a href="/HomePage.html"><button type="button" class="btn btn-primary">Back to Login Page</button></a>


</body>
</html>