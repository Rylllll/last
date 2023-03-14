<?php
include_once('Connection.php');


// Retrieve login credentials from the form data
$username = $_POST["username"];
$password = $_POST["password"];

// Prepare the SQL statement to retrieve the user with the given username and password
$sql = "SELECT * FROM accounts WHERE username = '$username' AND user_password = '$password'";

$result = $conn->query($sql);
if ($result->num_rows == 1) {
    // User found, store information in session
   
    $_SESSION['user'] = $result->fetch_assoc();

    // Return success response
    echo json_encode(array('success' => true));
} else {
    // User not found, return error response
    echo json_encode(array('success' => false, 'error' => 'Invalid username or password'));
}

$conn->close();


?>
