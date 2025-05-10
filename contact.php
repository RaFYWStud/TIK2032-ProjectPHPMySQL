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

        <div class="comment-list">
            <h2>Comments</h2>
            <hr>
            <?php
            $limit = 5;
            $sql = "SELECT commentator_name, comment_text, created_at FROM comments ORDER BY created_at DESC LIMIT $limit";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0):
                while ($row = mysqli_fetch_assoc($result)): ?>
                    <div class="comment">
                        <div class="comment-details">
                            <h2><?php echo htmlspecialchars($row['commentator_name']); ?></h2>
                            <span class="comment-meta"><?php echo date('F j, Y, g:i a', strtotime($row['created_at'])); ?></span>
                        </div>
                        <p class="comment-text"><?php echo nl2br(htmlspecialchars($row['comment_text'])); ?></p>
                    </div> <?php endwhile;
                    else: ?>
                <p>No comments yet. Be the first to comment!</p>
            <?php endif; ?>
        </div>
        <button id="load-more-comments" data-offset="5">Load More Comments</button>
    </div>
</body>

</html>

<script>
    document.getElementById('load-more-comments').addEventListener('click', function() {
        const button = this;
        const offset = parseInt(button.getAttribute('data-offset'));

        fetch('load_comments.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `offset=${offset}`
            })
            .then(response => response.json())
            .then(comments => {
                if (comments.length > 0) {
                    const commentList = document.querySelector('.comment-list');
                    comments.forEach(comment => {
                        const commentDiv = document.createElement('div');
                        commentDiv.classList.add('comment');
                        commentDiv.innerHTML = `
                        <div class="comment-details">
                            <h2>${comment.commentator_name}</h2>
                            <span class="comment-meta">${new Date(comment.created_at).toLocaleString()}</span>
                        </div>
                        <p class="comment-text">${comment.comment_text.replace(/\n/g, '<br>')}</p>
                    `;
                        commentList.appendChild(commentDiv);
                    });

                    button.setAttribute('data-offset', offset + comments.length);
                } else {
                    button.style.display = 'none';
                }
            })
            .catch(error => console.error('Error:', error));
    });
</script>