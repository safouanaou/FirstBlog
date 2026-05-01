<?php 
    require 'config.php';
    $error = '';
    $title  = '';
    $content = '';

    session_start();

    if(!isset($_SESSION['user_id'])){
        header('Location: login.php');
        exit;
    };

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $user_id = $_SESSION['user_id'];
        $title = trim($_POST['title']);
        $content = trim($_POST['content']);
        if($title === '' or $content === ''){
            $error = 'title and content cannot be empty';
        }else {
            $stmt = $pdo->prepare("INSERT INTO posts (user_id, title, content) VALUES (?,?,?)");
            $stmt->execute([$user_id, $title, $content]);
            header('Location:index.php');
            exit;
        }

    };

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Post</title>
</head>
<body>
    <?php if(!empty($error)): ?>
        <p><?php echo htmlspecialchars($error);?></p>
    <?php endif ;?>
    <form action="" method="POST">
        <label for="title">Title</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($title);?>">
        <label for="post-body">Post</label>
        <textarea name="content" id=""><?php echo htmlspecialchars($content);?></textarea>
        <button type="submit">Post</button>
    </form>
</body>
</html>
