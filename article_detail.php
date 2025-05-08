<?php
require_once 'koneksi.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT title, author, content, image_url, created_at FROM articles WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $article = mysqli_fetch_assoc($result);
    } else {
        die("Article not found.");
    }
} else {
    die("Invalid article ID.");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title><?php echo htmlspecialchars($article['title']); ?></title>
</head>

<body>
    <header>
        <h1><?php echo htmlspecialchars($article['title']); ?></h1>
    </header>
    <div class="container article-container">
        <img src="<?php echo htmlspecialchars($article['image_url']); ?>" alt="Article Image">
        <p><?php echo nl2br(htmlspecialchars($article['content'])); ?></p>
        <p class="article-meta">
            <span>By: <?php echo htmlspecialchars($article['author']); ?></span>
            <span>Created at: <?php echo date('F j, Y, g:i a', strtotime($article['created_at'])); ?></span>
        </p>
        <a href="blog.php">Back to Blog</a>
    </div>
</body>

</html>