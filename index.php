<?php
session_start();
include "config.php";

if(!isset($_SESSION['user'])){
    header("Location: login.php");
}

$result = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
?>

<h2>All Posts</h2>
<a href="dashboard.php">Back</a><br><br>

<?php
while($row = $result->fetch_assoc()){
    echo "<h3>".$row['title']."</h3>";
    echo "<p>".$row['content']."</p>";
    echo "<small>".$row['created_at']."</small><br>";
    echo "<a href='edit.php?id=".$row['id']."'>Edit</a> | ";
    echo "<a href='delete.php?id=".$row['id']."'>Delete</a>";
    echo "<hr>";
}
?>
