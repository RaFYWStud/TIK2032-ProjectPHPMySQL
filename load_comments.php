<?php
require_once 'koneksi.php';

$offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;
$limit = 5;

$sql = "SELECT commentator_name, comment_text, created_at FROM comments ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $sql);

$comments = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $comments[] = $row;
    }
}

echo json_encode($comments);
