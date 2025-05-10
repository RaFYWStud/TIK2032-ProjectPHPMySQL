<?php
require_once 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageTmpPath = $_FILES['image']['tmp_name'];
        $imageName = basename($_FILES['image']['name']);
        $uploadDir = 'uploads/';
        $imagePath = $uploadDir . $imageName;

        if (move_uploaded_file($imageTmpPath, $imagePath)) {
            $imageUrl = $imagePath;

            // Insert article into the database
            $sql = "INSERT INTO articles (title, author, content, image_url) VALUES ('$title', '$author', '$content', '$imageUrl')";
            if (mysqli_query($conn, $sql)) {
                header("Location: blog.php?success=1");
                exit;
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "Failed to upload image.";
        }
    } else {
        echo "Image upload error.";
    }
}
