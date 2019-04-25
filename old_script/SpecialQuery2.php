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
$res2 = $conn->query($sql2);

if ($res2->num_rows > 0) {
    echo "<table><tr><th>game_name</th><th>game_count</th></tr>";
    while($row = $res2->fetch_assoc()) {
        echo "<tr><td>".$row["game_name"]."</td><td>".$row["gc"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}


$conn->close();

?>