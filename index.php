<?php

    require 'config.php';
    $posts = [];
    session_start();
    
   
    //$user_id = $_SESSION['user_id'];
    $stmt = $pdo->prepare("SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id ORDER BY posts.created_at DESC");
    $stmt->execute();
    $posts = $stmt->fetchAll();



    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Home</title>
</head>
<body>
    <h1>First Blog</h1>
    <?php if(isset($_SESSION['user_id'])): ?>
        <a href="logout.php">Logout</a>
        <a href="create_post.php">Create Post</a>
    <?php else: ?>
    <a href="login.php">Login</a>
    <a href="register.php">Register</a>
    <?php endif;?>
    <div class="posts-list">
            <?php foreach ($posts as $post): ?>
                <div class="post">
                    <h2><?php echo htmlspecialchars($post['title']);?></h2>
                    <p><?php echo htmlspecialchars($post['content']) ;?></p>
                    <?php if(isset($_SESSION['user_id'])):?>
                        <form action="delete_post.php" method="POST" onsubmit="return confirm('are you sure you want to delete this post?')">
                            <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($post['id']);?>">
                            <button type="submit">Delete</button>
                        </form>
                    <?php endif;?>
                    <p>
                        By <address class="author">admin</address>
                        On <time datetime=""><?php echo htmlspecialchars($post['created_at']);?></time>
                    </p>
                </div>
            <?php endforeach;?>
        </div>
</body>
</html>