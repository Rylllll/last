<?php

include_once("Connection.php");

// check if the form is submitted
if (isset($_POST["submit"])) {
    // get the id of the row to update
    $id = $_POST["postId"];

    // get the data from the form
    $title = $_POST["title"];
    $about = $_POST["about"];

    // connect to the database

    // check connection
    
    // prepare and bind the update statement
    $stmt = $conn->prepare("UPDATE images SET title=?, about=?, image=? WHERE id=?");
    
    // get the image file data
    $image = $_FILES["image"];
    $imageName = $image["name"];
    $imageTmpName = $image["tmp_name"];
    $imageSize = $image["size"];
    $imageError = $image["error"];
    $imageType = $image["type"];
    
    // check if an image was uploaded
    if (!empty($imageName)) {
        // get the image file extension
        $imageExt = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
        
        // allowed image file extensions
        $allowedExtensions = array("jpg", "jpeg", "png", "gif");
        
        // check if the image file extension is allowed
        if (in_array($imageExt, $allowedExtensions)) {
            // check if there was no error uploading the image
            if ($imageError === 0) {
                // generate a unique name for the image file
                $imageNewName = uniqid("", true) . "." . $imageExt;
                
                // set the image file path
                $imagePath = "db_image/" . $imageNewName;
                
                // upload the image file to the server
                move_uploaded_file($imageTmpName,"./" . $imagePath);
                
                // bind the image file path to the update statement
                $stmt->bind_param("sssi", $title, $about, $imagePath, $id);
            } else {
                echo "Error uploading image: " . $imageError;
            }
        } else {
            echo "Invalid image file extension. Allowed extensions: " . implode(", ", $allowedExtensions);
        }
    } else {
        $oldImagePath = $_POST['oldImage'];
        $stmt->bind_param("sssi", $title, $about, $oldImagePath, $id);
    }
   

    // execute the statement
    if ($stmt->execute()) {
        // redirect to the main page
        // header("Location: tables.html");
        echo "success";
    } else {
        echo "Error updating row: " . $conn->error;
    }
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // close the statement and connection
    $stmt->close();
    $conn->close();
}

?>