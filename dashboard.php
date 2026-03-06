<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
}
?>

<h2>Welcome <?php echo $_SESSION['user']; ?></h2>

<a href="create.php">Create Post</a> |
<a href="add_post.php">Add New Post</a> |
<a href="index.php">View Posts</a> |
<a href="logout.php">Logout</a>
