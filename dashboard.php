<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
}
?>

<h2>Welcome <?php echo $_SESSION['user']; ?></h2>
<a href="create.php">Create Post</a> |
<a href="logout.php">Logout</a> |
<a href="index.php">View Posts</a>
