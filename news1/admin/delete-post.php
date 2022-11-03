<?php
include "config.php";

$post_id = $_GET['id'];
$cat_id = $_GET['catid'];

$sql1 = "DELETE FROM post WHERE post_id = {$post_id}";
$result = mysqli_query($con,$sql1);
$row = mysqli_fetch_row($result);

unlink("upload/".$row['post_img']);


$sql = "DELETE FROM post WHERE post_id = {$post_id};";
$sql .= "UPDATE category SET post = post - 1 WHERE category_id = {$cat_id}";

if(mysqli_multi_query($con,$sql))
{
    header("location: post.php");
}
else 
{
    echo"<div class='alert-danger'> Query Failed .</div>";     
}
?>