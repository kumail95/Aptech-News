<?php
include "config.php";

if ($_SESSION['user_role'] == '0')
{
    header("location: post.php");
}

$cat_id = $_GET['id'];

$sql = "DELETE FROM `category` WHERE `category_id` = '$cat_id'";

if (mysqli_query($con,$sql))
{
    header("location: category.php");
}

mysqli_close($con);
?>