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

if (isset($_POST['purchase'])) {
    $game_id = $_POST['game_id'];
    $user_id = $_SESSION['user_id'];
    $date = date("Y/m/d");
    $insert_query = "INSERT INTO Purchased
                     VALUES ('$user_id', '$game_id', '$date', 0)";
    if ($conn->query($insert_query) == True) {
        echo "Thank you for your order.";
    }
    else {
        echo "error: " . $conn->error;
    }
}

$sql1 = "CREATE view GameAboveAvg as
                select X.game_id, avg(X.rating)
                from Game as X
                group by X.game_id
                having avg(X.rating) >= all(select avg(Y.rating)
                                        from Game as Y);";
$result = $conn->query($sql1) or die($conn->error);

$sql2 = "SELECT game_id, game_name, genre, release_date, rating, developer_name
         from Game natural join GameAboveAvg natural join Developer;";

$result = $conn->query($sql2) or die($conn->error);


echo "<table border=1>
<tr>
<th>Game ID</th>
<th>Game Name</th>
<th>Genre</th>
<th>Release Date</th>
<th>Rating</th>
<th>Developer Name</th>
</tr>";
while (($row = $result->fetch_assoc()) != null) {
    echo "<form action='ViewAllGame.php' method='post'>";
    echo "<tr>";
    echo "<td>" . "<input type=text name='game_id' value=" . $row['game_id'] . "></td>";
    echo "<td>" . "<input type=text name='game_name' value=" . $row['game_name'] . "></td>";
    echo "<td>" . "<input type=text name='genre' value=" . $row['genre'] . "></td>";
    echo "<td>" . "<input type=text name='release_date' value=" . $row['release_date'] . "></td>";
    echo "<td>" . "<input type=text name='rating' value=" . $row['rating'] . "></td>";
    echo "<td>" . "<input type=text name='developer_name' value=" . $row['developer_name'] . "></td>";
    echo "<td>" . "<input type=submit name='purchase' value='purchase'" . "></td>";
    echo "</form>";
}
echo "</table>";

$sql2 = "Drop View GameAboveAvg";
$result = $conn->query($sql2) or die($conn->error);

$conn->close();
?>

<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <a href="ViewOrder.php"><button type="button" class="btn btn-primary">Your Orders</button></a>
        </div>
        <div class="col-sm-6">
            <a href="/HomePage.html"><button type="button" class="btn btn-primary">Back to Login Page</button></a>
        </div>
    </div>

</div>

</body>
</html>