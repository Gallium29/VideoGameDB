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

if (isset($_POST['update'])) {
    $game_id = $_POST['game_id'];
    $game_name = $_POST['game_name'];
    $genre = $_POST['genre'];
    $release_date = $_POST['release_date'];
    $rating = $_POST['rating'];
    $developer_id = $_POST['developer_id'];
    $update_query = "UPDATE Game SET game_name = '$game_name', genre = '$genre', developer_id = '$developer_id', rating = '$rating', release_date = '$release_date' WHERE game_id = $game_id";
    if($conn->query($update_query) === TRUE){ 
        echo "Record was updated successfully."; 
    } 
    else { 
        echo "ERROR: Could not execute. " . $conn->error;
    }
}

if (isset($_POST['delete'])) {
    $game_id = $_POST['game_id'];
    $game_name = $_POST['game_name'];
    $delete_query = "DELETE FROM Game WHERE game_id = $game_id";
    if($conn->query($delete_query) === TRUE){ 
        echo "Record was deleted successfully."; 
    } 
    else { 
        echo "ERROR: Could not execute. " . $conn->error;
    }
}


$select_query = "SELECT * FROM Game NATURAL JOIN Developer";
$result = $conn->query($select_query);

echo "<table border=1>
<tr>
<th>Game ID</th>
<th>Game Name</th>
<th>Genre</th>
<th>Released Date</th>
<th>Rating</th>
<th>Developer ID</th>
<th>Developer Name</th>
</tr>";
while ($row = $result->fetch_assoc()) {
    echo "<form action='ViewGame.php' method='post'>";
    echo "<tr>";
    echo "<td>" . "<input type=text name='game_id' value=" . $row['game_id'] . "></td>";
    echo "<td>" . "<input type=text name='game_name' value=" . $row['game_name'] . "></td>";
    echo "<td>" . "<input type=text name='genre' value=" . $row['genre'] . "></td>";
    echo "<td>" . "<input type=text name='release_date' value=" . $row['release_date'] . "></td>";
    echo "<td>" . "<input type=text name='rating' value=" . $row['rating'] . "></td>";
    echo "<td>" . "<input type=text name='developer_id' value=" . $row['developer_id'] . "></td>";
    echo "<td>" . "<input type=text name='developer_name' value=" . $row['developer_name'] . "></td>";
    echo "<td>" . "<input type=submit name='update' value='update'" . "></td>";
    echo "<td>" . "<input type=submit name='delete' value='delete'" . "></td>";
    echo "</tr>";
    echo "</form>";
}
echo "</table>";

$conn->close();
?>

<a href="/admin/AdminDashboard.html"><button type="button" class="btn btn-primary">Back to Dashboard</button></a>


</body>
</html>