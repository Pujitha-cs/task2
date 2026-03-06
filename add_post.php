<?php
session_start();
include "config.php";

if(!isset($_SESSION['user'])){
    header("Location: login.php");
}

if(isset($_POST['submit'])){
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "INSERT INTO posts (title, content) VALUES ('$title','$content')";
    $conn->query($sql);

    header("Location: index.php");
}
?>

<h2>Add New Post</h2>

<form method="POST">
Title:<br>
<input type="text" name="title" required><br><br>

Content:<br>
<textarea name="content" required></textarea><br><br>

<button type="submit" name="submit">Add Post</button>
</form>

<br>
<a href="index.php">Back</a>
