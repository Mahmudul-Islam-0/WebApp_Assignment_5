<?php
$link = mysqli_connect("localhost", "root", "", "tdl");
if ($link === false) {
    die("ERROR: Could not connect." . mysqli_connect_error());
}

$sql = "SELECT * FROM information";
$result = mysqli_query($link, $sql);

$tasks = array();
while ($row = mysqli_fetch_assoc($result)) {
    $tasks[] = $row['Activities'];
}

mysqli_close($link);

echo json_encode($tasks);


?>