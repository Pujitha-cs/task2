<?php
session_start();
include "config.php";

if(!isset($_SESSION['user'])){
    header("Location: login.php");
}

$id = $_GET['id'];

if(isset($_POST['update'])){
    $title = $_POST['title'];
    $content = $_POST['content'];

    $conn->query("UPDATE posts SET title='$title', content='$content' WHERE id=$id");
    header("Location: index.php");
}

$result = $conn->query("SELECT * FROM posts WHERE id=$id");
$row = $result->fetch_assoc();
?>

<h2>Edit Post</h2>

<form method="POST">
    Title: <input type="text" name="title" value="<?php echo $row['title']; ?>" required><br><br>
    Content:<br>
    <textarea name="content" required><?php echo $row['content']; ?></textarea><br><br>
    <button type="submit" name="update">Update</button>
</form>

<br>
<a href="index.php">Back</a>
