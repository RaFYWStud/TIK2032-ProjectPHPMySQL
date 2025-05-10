<?php
require_once 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $commentator_name = mysqli_real_escape_string($conn, $_POST['commentator_name']);
    $comment_text = mysqli_real_escape_string($conn, $_POST['comment_text']);

    $sql = "INSERT INTO comments (commentator_name, comment_text) VALUE ('$commentator_name', '$comment_text')";

    if (mysqli_query($conn, $sql)) {
        header("Location: contact.php?success=1");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
