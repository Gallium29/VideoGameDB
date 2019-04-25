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
    $developer_id = $_POST['developer_id'];
    $developer_name = $_POST['developer_name'];
    $location = $_POST['location'];
    $update_query = "UPDATE Developer SET developer_name = '$developer_name', location = '$location' WHERE developer_id = '$developer_id'";
    $conn->query($update_query);
}

if (isset($_POST['delete'])) {
    $developer_id = $_POST['developer_id'];
    $developer_name = $_POST['developer_name'];
    $delete_query = "DELETE FROM Developer WHERE developer_id = $developer_id";
    if($conn->query($delete_query) === TRUE){ 
        echo "Record was deleted successfully."; 
    } 
    else { 
        echo "ERROR: Could not execute. " . $conn->error;
    }
}


$select_query = "SELECT * FROM Developer";
$result = $conn->query($select_query);

echo "<table border=1>
<tr>
<th>developer ID</th>
<th>developer Name</th>
<th>location</th>
</tr>";
while ($row = $result->fetch_assoc()) {
    echo "<form action='ViewDeveloper.php' method='post'>";
    echo "<tr>";
    echo "<td>" . "<input type=text name='developer_id' value=" . $row['developer_id'] . "></td>";
    echo "<td>" . "<input type=text name='developer_name' value=" . $row['developer_name'] . "></td>";
    echo "<td>" . "<input type=text name='location' value=" . $row['location'] . "></td>";
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