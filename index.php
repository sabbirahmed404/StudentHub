<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Hub</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div style="background:rgb(76, 67, 136);padding:5px">
        <h2 style="text-align:center; color: #ffffff;">GREEN UNIVERSITY OF BANGLADESH</h2>
    </div>

    <div class="header" style="background-image: url('Student\ HUB.png');">
        <h1>Student HUB</h1>
        <p>Connecting <b>Students</b> of <b>Green University of Bangladesh</b> through <b>Institutes</b>.</p>
    </div>

    <div class="navbar">
        <a href="index.php" class="active">Home</a>
        <a href="registration.html">Register</a>
        <a href="clubs.html">Club Lists</a>
        <a href="login_signup.html">Club Login</a>
        <a href="#">About</a>
    </div>

    <?php 
    session_start(); 
    if (isset($_SESSION['student_id'])): ?>
    <div class="post-section">
        <h2>Create a Post</h2>
        <form action="post.php" method="POST" enctype="multipart/form-data">
            <textarea name="text" placeholder="Write something..." required></textarea>
            <input type="text" name="club_name" placeholder="Enter Club Name" required>
            <input type="file" name="media">
            <button type="submit">Post</button>
        </form>
    </div>
    <?php endif; ?>

    <div class="main">
        <h2>Recent Posts</h2>
        <div class="post-feed">
            <?php
                include 'config.php';
                $sql = "SELECT * FROM post ORDER BY created_at DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='post'>";
                        echo "<p><strong>" . $row['student_id'] . "</strong> - " . $row['created_at'] . "</p>";
                        echo "<p>" . $row['text'] . "</p>";
                        echo "<p><strong>Club Name: </strong>" . $row['club_name'] . "</p>";
                        if ($row['media']) {
                            echo "<img src='" . $row['media'] . "' alt='Post Image'>";
                        }
                        echo "<button class='poke-btn' onclick='poke()'>Poke</button>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No posts yet. Be the first to post!</p>";
                }
                $conn->close();
            ?>
        </div>
    </div>

    <div class="footer">
      <h2>Made By Sabbir Ahmed</h2>
      <a href="https://github.com/sabbirahmed404"><img src="25231.png" alt="Sabbir Ahmed's Github" style="width:42px;height:42px;"></a>
      <a href="https://www.linkedin.com/in/msabbir-ahmed/"><img src="linkedin.png" alt="Sabbir Ahmed's Linkedin" style="width:42px;height:42px;"></a>

    </div>

    <script>
        function poke() {
            alert("Thanks for your interaction. We will see you soon.");
        }
    </script>
</body>
</html>
