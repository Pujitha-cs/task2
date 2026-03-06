<?php
session_start();
include "config.php";

if(!isset($_SESSION['user'])){
    header("Location: login.php");
}

$limit = 3;

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

$search = "";
if(isset($_GET['search'])){
    $search = $_GET['search'];
    $sql = "SELECT * FROM posts 
            WHERE title LIKE '%$search%' OR content LIKE '%$search%' 
            ORDER BY created_at DESC 
            LIMIT $start,$limit";
}else{
    $sql = "SELECT * FROM posts 
            ORDER BY created_at DESC 
            LIMIT $start,$limit";
}

$result = $conn->query($sql);

$count_sql = "SELECT COUNT(*) as total FROM posts";
$count_result = $conn->query($count_sql);
$total_posts = $count_result->fetch_assoc()['total'];
$total_pages = ceil($total_posts / $limit);
?>

<!DOCTYPE html>
<html>
<head>
<title>My Blog</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="container mt-4">

<h2>All Posts</h2>

<a href="dashboard.php" class="btn btn-secondary">Back</a>

<br><br>

<form method="GET" class="mb-3">
<input type="text" name="search" placeholder="Search posts..." class="form-control">
<br>
<button type="submit" class="btn btn-primary">Search</button>
</form>

<?php

while($row = $result->fetch_assoc()){
    echo "<div class='card mb-3'>";
    echo "<div class='card-body'>";
    echo "<h3>".$row['title']."</h3>";
    echo "<p>".$row['content']."</p>";
    echo "<small>".$row['created_at']."</small><br><br>";
    echo "<a class='btn btn-warning btn-sm' href='edit.php?id=".$row['id']."'>Edit</a> ";
    echo "<a class='btn btn-danger btn-sm' href='delete.php?id=".$row['id']."'>Delete</a>";
    echo "</div>";
    echo "</div>";
}

?>

<nav>
<?php
for($i=1;$i<=$total_pages;$i++){
    echo "<a class='btn btn-primary btn-sm m-1' href='index.php?page=".$i."'>".$i."</a>";
}
?>
</nav>

</body>
</html>
