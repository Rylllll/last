<?php
if(isset($_POST['title'])){

    $host = 'localhost';
    $user = 'root';
    $password = '';
    $dbname = 'accounts';
    $conn = mysqli_connect($host, $user, $password, $dbname);

    $filename = $_FILES['picture']['name'];
    $path = $_FILES['picture']['tmp_name'];
    $about_image = $_POST['about'];

    // Check if the file is an image
    $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
    $file_extension = pathinfo($filename, PATHINFO_EXTENSION);
    if (!in_array($file_extension, $allowed_types)) {
        echo 'Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.';
        exit();
    }

    $image_data = base64_encode(file_get_contents($path)); 
    $new_path = "db_image/" . $filename;  
    $sql = "INSERT INTO images (title, image, about) VALUES ('".$_POST['title']."', '".$new_path."', '".$about_image."')"; 
    mysqli_query($conn, $sql);

   
     
    move_uploaded_file($path, "./" . $new_path);

    mysqli_close($conn);

    
}



?>
