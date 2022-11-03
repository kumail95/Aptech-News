<?php
include "config.php";

if (empty($_FILES['new-image']['name'])) 
{
  $file_name = $_FILES['old_image'];  
}
else 
{
    $errors = array();
  
  $file_name = $_FILES['new-image']['name'];
  $file_size = $_FILES['new-image']['size'];
  $file_tmp = $_FILES['new-image']['tmp_name'];
  $file_type = $_FILES['new-image']['type'];
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

    $sql = "UPDATE post SET title= '{$_POST['post_title']}' ,`description`='{$_POST['postdesc']}', category={$_POST['category']},post_img='{$file_name}' 
    WHERE post_id={$_POST['post_id']};";

    $result = mysqli_query($con,$sql);

    if ($result) 
    {
        header("location: post.php");
    }
    else 
    {
        echo '<div class="alert alert-danger text-center" role="alert"> Query Failed !! </div>';
    }
?>