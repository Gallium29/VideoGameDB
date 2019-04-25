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

/* find games whose rating is above average */

/* fetch  */
$sql = "CREATE VIEW GameAboveAvg as
            SELECT X.game_id, avg(X.rating)
            FROM Purchased as X NATURAL JOIN Game
            GROUP BY game_id, game_name
            HAVING avg(X.rating) > all(SELECT avg(Y.rating)
                                       FROM Purchased as Y");


$res = $conn->query($sql);

if ($res->num_rows > 0) {
    echo "<table><tr><th>user_id</th><th>game_name</th></tr>";
    while($row = $res->fetch_assoc()) {
        echo "<tr><td>".$row["user_id"]."</td><td>".$row["game_name"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}


$conn->close();

?>