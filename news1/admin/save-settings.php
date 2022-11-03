<?php
include "config.php";

if (empty($_FILES['logo']['name'])) 
{
  $file_name = $_FILES['old_logo'];  
}
else 
{
    $errors = array();
  
  $file_name = $_FILES['logo']['name'];
  $file_size = $_FILES['logo']['size'];
  $file_tmp = $_FILES['logo']['tmp_name'];
  $file_type = $_FILES['logo']['type'];
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
        move_uploaded_file($file_tmp,"images/".$file_name);
    }
    else 
    {
      print_r($errors);
      die();  
    }
}

    $sql = "UPDATE settings SET websitename = '{$_POST['website_name']}',`logo`='{$file_name}', footerdesc='{$_POST['footer_desc']}'";

    $result = mysqli_query($con,$sql);

    if ($result) 
    {
        header("location: settings.php");
    }
    else 
    {
        echo '<div class="alert alert-danger text-center" role="alert"> Query Failed !! </div>';
    }
?>