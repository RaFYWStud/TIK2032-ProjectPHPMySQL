<?php
require_once 'koneksi.php';

//Mengambil data artikel dari database
$sql = "SELECT id, title, author, content, image_url, created_at FROM articles ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

//Mengecek apakah artikel sukses dibuat
if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo "<script>alert('Artikel berhasil dibuat!');</script>";
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles.css" />
    <script src="darkmode.js" defer></script>
    <title>Blog</title>
</head>

<body>
    <header>
        <button id="dark-mode-toggle">
            <img src="Asset/Image/icons8-dark-mode-100.png" alt="" />
            <img src="Asset/Image/icons8-light-mode-100.png" alt="" />
        </button>
        <h1>Blog</h1>
    </header>
    <nav>
        <a href="index.html">Home</a>
        <a href="blog.php">Blog</a>
        <a href="gallery.html">Gallery</a>
        <a href="contact.php">Contact</a>
    </nav>
    <div class="container blog-container">
        <button id="open-modal" class="create-article-button">
            Add Article
        </button>

        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div>
                <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                <img src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="Article Image" />
                <p class="article-meta">
                    <span text>By: <?php echo htmlspecialchars($row['author']); ?></span>
                    <span>Created at: <?php echo date('F j, Y, g:i a', strtotime($row['created_at'])); ?></span>
                </p>
                <a href="article_detail.php?id=<?php echo $row['id']; ?>">Read More</a>
                <hr />
            </div>
        <?php endwhile; ?>

    </div>
</body>

</html>

<div id="article-modal" class="modal">
    <div class="modal-content">
        <span id="close-modal" class="close-button">&times;</span>
        <h2>Make a New Article</h2>
        <form
            action="save_article.php"
            method="POST"
            enctype="multipart/form-data">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required />

            <label for="author">Author:</label>
            <input type="text" id="author" name="author" required />

            <label for="content">Content:</label>
            <textarea id="content" name="content" rows="10" required></textarea>

            <label for="image">Image:</label>
            <input
                type="file"
                id="image"
                name="image"
                accept="image/*"
                required />

            <button type="submit">Submit</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const modal = document.getElementById("article-modal");
        const openModalButton = document.getElementById("open-modal");
        const closeModalButton = document.getElementById("close-modal");

        openModalButton.addEventListener("click", () => {
            modal.classList.add("show");
        });

        closeModalButton.addEventListener("click", () => {
            modal.classList.remove("show");
        });

        window.addEventListener("click", (event) => {
            if (event.target === modal) {
                modal.classList.remove("show");
            }
        });
    });
</script>