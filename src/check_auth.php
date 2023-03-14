<?php
include_once("Connection.php");


if (isset($_SESSION['user'])) {
	echo json_encode(array("logged_in" => true));
} else {
	echo json_encode(array("logged_in" => false));
}
?>
