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

/* special query3 */

$sql1 = "CREATE view GameAboveAvg as
select X.game_id, avg(X.rating)
from Purchased as X
group by X.game_id
having avg(X.rating) >= all(select avg(Y.rating)
							from Purchased as Y);";

$sql2 = "SELECT game_name
from Game natural join GameAboveAvg;";

$res1 = $conn->query($sql1);
$res2 = $conn->query($sql2);

if ($res2->num_rows > 0) {
    echo "<table><tr><th>game_name</th></tr>";
    while($row = $res2->fetch_assoc()) {
        echo "<tr><td>".$row["game_name"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}


$conn->close();

?>