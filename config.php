<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=blog;charset=utf8mb4', 'root', 'root');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e){
    echo "connection failed" . $e->getMessage();
}
?>