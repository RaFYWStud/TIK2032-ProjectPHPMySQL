<?php
require_once 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles.css" />
    <script src="darkmode.js" defer></script>
    <title>Contact</title>
</head>

<body>
    <header>
        <button id="dark-mode-toggle">
            <img src="Asset/Image/icons8-dark-mode-100.png" alt="" />
            <img src="Asset/Image/icons8-light-mode-100.png" alt="" />
        </button>
        <h1>Contact Me</h1>
    </header>
    <nav>
        <a href="index.php">Home</a>
        <a href="blog.php">Blog</a>
        <a href="gallery.html">Gallery</a>
        <a href="contact.html">Contact</a>
    </nav>
    <div class="container contact-info">
        <p>raffigolonda2006@gmail.com</p>

        <div>
            <a href="https://wa.me/62895706081111">
                <img src="Asset/Image/WhatsappLogo.png" alt="" width="75" />
            </a>
        </div>

        <div>
            <a href="https://www.instagram.com/raffi_golonda">
                <img
                    src="Asset/Image/InstagramLogo.png"
                    alt=""
                    width="50" />
            </a>
        </div>

        <div>
            <a href="https://github.com/RaFYWStud">
                <img src="Asset/Image/GithubLogo.png" alt="" width="50" />
            </a>
        </div>

        <div class="comment-section">
            <h2>Leave a comment</h2>
            <form action="save_comment.php" method="POST">
                <label for="commentator_name">Your Name:</label>
                <input type="text" id="commentator_name" name="commentator_name" required />

                <label for="comment_text">Your Comment:</label>
                <input type="text" id="comment_text" name="comment_text" required />

                <button type="submit">Submit</button>

            </form>
        </div>

        <!-- filepath: c:\laragon\www\TIK2032-ProjectPHPMySQL\contact.php -->
        <div class="container comment-list">
            <h2>Comments</h2>
            <?php
            $sql = "SELECT commentator_name, comment_text, created_at FROM comments ORDER BY created_at DESC";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0):
                while ($row = mysqli_fetch_assoc($result)): ?>
                    <div class="comment">
                        <p><strong><?php echo htmlspecialchars($row['commentator_name']); ?></strong> said:</p>
                        <p><?php echo nl2br(htmlspecialchars($row['comment_text'])); ?></p>
                        <p class="comment-meta">Posted on: <?php echo date('F j, Y, g:i a', strtotime($row['created_at'])); ?></p>
                        <hr />
                    </div>
                <?php endwhile;
            else: ?>
                <p>No comments yet. Be the first to comment!</p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>