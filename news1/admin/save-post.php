<?php
include "config.php";

if (isset($_FILES['fileToUpload']))
{
  $errors = array();
  
  $file_name = $_FILES['fileToUpload']['name'];
  $file_size = $_FILES['fileToUpload']['size'];
  $file_tmp = $_FILES['fileToUpload']['tmp_name'];
  $file_type = $_FILES['fileToUpload']['type'];
  $file_ext = pathinfo($file_name,PATHINFO_EXTENSION);
  $extensions = array("jpeg","jpg","png","gif");

    if (in_array($file_ext,$extensions) === false) 
    {
        $errors[] = "This Extension File Not Allowed, Please Choose A JPG Or PNG File.";

    }

    if ($file_size > 2097152)
    {
        $errors[] = "File Size Must Be 2MB Or Lower .";
    }

    if (empty($errors) == true)
    {
        move_uploaded_file($file_tmp,"upload/".$file_name);
    }
    else 
    {
      print_r($errors);
      die();
    }
}

    session_start();
    $titel = mysqli_real_escape_string($con,$_POST['post_title']);
    $description = mysqli_real_escape_string($con,$_POST['postdesc']);
    $category = mysqli_real_escape_string($con,$_POST['category']);
    $date = date("d M, Y");
    $author = $_SESSION['user_id'];

    $sql = " INSERT INTO `post`( `title`, `description`, `category`, `post_date`, `author`, `post_img`) VALUES ('$titel','$description','$category','$date','$author','$file_name');";

    $sql .= " UPDATE `category` SET `post` = `post` + 1 WHERE `category_id` = '$category'";
    
    if (mysqli_multi_query($con,$sql))
    {
        header("location: post.php");
    }
    else
    {
      echo"<div class='alert-danger'> Query Failed .</div>";  
    }
?>