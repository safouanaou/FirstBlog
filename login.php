<?php
require 'config.php';
$error = '';

session_start();
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = trim($_POST['username']);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if($user && password_verify($_POST['password'], $user['password'])){
        $_SESSION['user_id'] = $user['id'];
        header('Location:index.php');
        exit;
    } else {
        $error = "invalid credentials";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <div>
        <?php if(!empty($error)): ?>
            <p><?php echo htmlspecialchars($error)?></p>
            <?php endif; ?>
        <form action="" method="POST">
            <label for="username">username</label>
            <input type="text" name="username">
            <label for="password">password</label>
            <input type="password" name="password">
            <button type="submit">login</button>
        </form>
    </div>
</body>
</html>