<?php
require 'config.php';

$error = '';
$success = '';
$username = '';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    if(!empty($username) && !empty($password)){
        try {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->execute([$username, $hashedPassword]);
            $success = "Registration successful.";
            $username = '';
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $error = "That username is already taken.";
            } else {
                $error = "Registration failed.";
            }
        }
    } else {
        $error = "Fill in the required fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <a href="index.php">Home</a>
    <div class="registrationForm">
        <?php if (!empty($error)): ?>
            <p><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <?php if (!empty($success)): ?>
            <p><?php echo htmlspecialchars($success); ?></p>
        <?php endif; ?>
        <form action="" method="POST">
            <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
            <input type="password" name="password" required>
            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
