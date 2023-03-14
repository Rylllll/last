<?php
include('Connection.php');


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$result = $conn->query("SELECT * FROM images");


$data = array();


while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}


$conn->close();


echo json_encode($data);



?>
