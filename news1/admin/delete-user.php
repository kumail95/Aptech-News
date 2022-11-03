<?php

    include "config.php";

    if ($_SESSION['user_role'] == '0')
{
    header("location: post.php");
}

    $userid = $_GET['id'];

    $sql = "DELETE FROM `user` WHERE `user_id` = '$userid'";

    if (mysqli_query($con,$sql))
    {
        header("location:users.php");
    }

    else 
    {
        echo'<div class="alert alert-danger text-center" role="alert"> Delete The User Record </div>';
    }
    mysqli_close($con);
?>