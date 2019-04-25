<?php
session_start();
$_SESSION["user_id"] = $_POST["user_id"];
?>

<!DOCTYPE html>
<html lang="en">
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

<div class="container">
    <div class="row">
        <div class="col-sm-3">
            <a href="ViewAllGame.php"><button type="button" class="btn btn-primary">All Games</button></a>
        </div>
        <div class="col-sm-3">
            <a href="ViewRecentGame.php"><button type="button" class="btn btn-primary">Recently Released</button></a>
        </div>
        <div class="col-sm-3">
            <a href="ViewTopGame.php"><button type="button" class="btn btn-primary">Top Rated</button></a>
        </div>
    </div>

</div>

<a href="/HomePage.html"><button type="button" class="btn btn-primary">Back to Login Page</button></a>
</body>
</html>