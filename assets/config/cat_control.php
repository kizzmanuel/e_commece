<?php
    require "dbConnect.php";
    require "../includes/sessions.php";
    $currUser = $_SESSION['user'];

    if (isset($_POST['addCat'])) {
        $id = rand(1000000,9999999);
       $name = $_POST['cat'];
       $sql = "INSERT INTO categories(cat_id,cat_name) VALUES(?,?)";
        $stmt = mysqli_stmt_init($connectDb);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"ss",$id,$name);

        $execute = mysqli_stmt_execute($stmt);

        if ($execute) {
            $_SESSION['success_msg'] = "Category Added successfully!";
            header("Location: ".$_SERVER['HTTP_REFERER']);
        }else{
            $_SESSION['error_msg'] = "Something went wrong!";
            header("Location: ".$_SERVER['HTTP_REFERER']);
        }
    }

    elseif (isset($_GET['del'])) {
        $id = $_GET['del'];
        $sql = "DELETE FROM categories WHERE id = '$id'";
        $query = mysqli_query($connectDb,$sql);
        if ($query) {
            $_SESSION['success_msg'] = "Records Deleted successfully!";
            header("Location: ".$_SERVER['HTTP_REFERER']);
        }else{
            $_SESSION['error_msg'] = "Something went wrong!";
            header("Location: ".$_SERVER['HTTP_REFERER']);
        }
    }

    elseif (isset($_POST['subCat'])) {
        $sub_id = rand(1000000,9999999);
        $cat_id = $_POST['catid'];
        $name = $_POST['cat'];
        $sql = "INSERT INTO sub_categories(cat_id,sub_id,sub_name) VALUES(?,?,?)";
         $stmt = mysqli_stmt_init($connectDb);
         mysqli_stmt_prepare($stmt,$sql);
         mysqli_stmt_bind_param($stmt,"sss",$cat_id,$sub_id,$name);
 
         $execute = mysqli_stmt_execute($stmt);
 
         if ($execute) {
             $_SESSION['success_msg'] = "Sub-Category Added Successfully!";
             header("Location: ".$_SERVER['HTTP_REFERER']);
         }else{
             $_SESSION['error_msg'] = "Something went wrong!";
             header("Location: ".$_SERVER['HTTP_REFERER']);
         }
    }

    // echo $_SERVER['HTTP_REFERER'];
