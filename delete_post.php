<?php

require 'config.php';
$post_id = $_POST['post_id'];

session_start();

if(!isset($_SESSION['user_id'])){
   header('Location:login.php'); 
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $stmt = $pdo->prepare('DELETE FROM posts WHERE id = ?');
    $stmt->execute([$post_id]);
    header('Location:index.php');
    exit;

}

?>