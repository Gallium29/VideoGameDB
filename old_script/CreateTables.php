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

$sql = "CREATE TABLE User(
	user_id int,
	age int,
	gender char,
	job varchar(100),
	primary key (user_id)
)";
if (!$conn->query($sql)) {
    echo $conn->error;
}

$sql = "
CREATE TABLE Developer(
	developer_id int,
	developer_name varchar(100),
	location varchar(100),
	average_game_rating decimal(5, 2),
    primary key (developer_id)
);";
if (!$conn->query($sql)) {
    echo $conn->error;
}


$sql = "
CREATE TABLE Game(
	game_id int,
    game_name varchar(100),
	genre varchar(100),
	rating decimal(5, 2),
	release_date date,
    developer_id int,
    primary key (game_id),
	foreign key (developer_id) references Developer(developer_id)
);
";
if (!$conn->query($sql)) {
    echo $conn->error;
}


$sql = "
CREATE TABLE Platform(
	platform_id int,
	platform_name varchar(100),
	primary key(platform_id)
);";
if (!$conn->query($sql)) {
    echo $conn->error;
}

$sql = "
CREATE TABLE Purchased(
	user_id int,
	game_id int,
	purchase_date date,
	rating decimal(5, 2),
	foreign key(user_id) references User(user_id),
	foreign key(game_id) references Game(game_id)
);";
if (!$conn->query($sql)) {
    echo $conn->error;
}

$sql = "
CREATE TABLE BelongsTo(
	game_id int,
	platform_id int,
	foreign key(game_id) references Game(game_id),
	foreign key(platform_id) references Platform(platform_id)
);";
if (!$conn->query($sql)) {
    echo $conn->error;
}

$conn->close();

?>