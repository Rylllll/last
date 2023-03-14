<?php

include_once('Connection.php');
// Get the ID of the row to be deleted from the POST data
$id = $_POST['id'];

// Connect to the database


// Prepare the DELETE statement
$stmt = mysqli_prepare($conn, "DELETE FROM images WHERE id = ?");

// Bind the ID parameter to the statement
mysqli_stmt_bind_param($stmt, "i", $id);

// Execute the statement
mysqli_stmt_execute($stmt);

// Close the statement and database connection
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
