<?php 
    require "dbConnect.php";
    require "../includes/sessions.php";
    $currUser = $_SESSION['user'];
    if(isset($_POST['updatePix'])){
        $file = $_FILES['file'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileError = $file['error'];
        $fileSize = $file['size'];

        // Allowed Files
        $allowed = ["png","jpg","jpeg","gif"];
        $fileName = explode(".",$fileName);

        // File Extension
        $ext = end($fileName);
        
        if (!in_array($ext, $allowed)) {
            $_SESSION['error_msg'] = "This file format is not allowed, pleased choose either jpg, png, jpeg or gif";
            header("Location: ../../profile");
        }else{
            if ($fileError == 1) {
                $_SESSION['error_msg'] = "File Corrupted!";
                header("Location: ../../profile");
            }else{
                // Limit the file size to 5 mb
                if ($fileSize >  5000000) {
                    $_SESSION['error_msg'] = "File too large max: 5mb!";
                    header("Location: ../../profile");
                }else{
                    // Create new file name
                //   echo  $fileNewName = rand(100,999);
                    $fileNewName = "profile".$_SESSION['user'].".".$ext;
                    $location = "../images/avatars/";

                    if (file_exists($location.$fileNewName)) {
                        unlink($location.$fileNewName);
                        $move = move_uploaded_file($fileTmpName, $location.$fileNewName);
                        $sql = "UPDATE users SET prof_pic = ? WHERE id = '$currUser'";
                        $stmt = mysqli_stmt_init($connectDb);
                        mysqli_stmt_prepare($stmt,$sql);
                        mysqli_stmt_bind_param($stmt,'s',$fileNewName);
                        $execute = mysqli_stmt_execute($stmt);

                        if (!$execute) {
                            $_SESSION['error_msg'] = "Something Went Wrong!";
                            header('Location: ../../profile');
                        }else{
                            $_SESSION['success_msg'] = "Update successful!";
                            header('Location: ../../profile');
                        }
                    }else{
                        $move = move_uploaded_file($fileTmpName, $location.$fileNewName);
                        $sql = "UPDATE users SET prof_pic = ? WHERE id = '$currUser'";
                        $stmt = mysqli_stmt_init($connectDb);
                        mysqli_stmt_prepare($stmt,$sql);
                        mysqli_stmt_bind_param($stmt,'s',$fileNewName);
                        $execute = mysqli_stmt_execute($stmt);

                        if (!$execute) {
                            $_SESSION['error_msg'] = "Something Went Wrong!";
                            header('Location: ../../profile');
                        }else{
                            $_SESSION['success_msg'] = "Update successful!";
                            header('Location: ../../profile');
                        }
                    }

            }
            }
        }
    }

    elseif (isset($_POST['addProdImage'])){
        $pid = $_POST['pid'];
        $file = $_FILES['file'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileError = $file['error'];
        $fileSize = $file['size'];

        // Allowed Files
        $allowed = ["png","jpg","jpeg","gif"];
        $fileName = explode(".",$fileName);

        // File Extension
        $ext = end($fileName);
        
        if (!in_array($ext, $allowed)) {
            $_SESSION['error_msg'] = "This file format is not allowed, pleased choose either jpg, png, jpeg or gif";
            header("Location: ../../profile");
        }else{
            if ($fileError == 1) {
                $_SESSION['error_msg'] = "File Corrupted!";
                header("Location: ../../profile");
            }else{
                // Limit the file size to 5 mb
                if ($fileSize >  5000000) {
                    $_SESSION['error_msg'] = "File too large max: 5mb!";
                    header("Location: ../../profile");
                }else{
                    // Create new file name
                //   echo  $fileNewName = rand(100,999);
                    $fileNewName = time().".".$ext;
                    $location = "../images/products/";
                    
                    $move = move_uploaded_file($fileTmpName,$location.$fileNewName);
                    if ($move) {
                        $sql = "INSERT INTO product_image(product_id,image_name) VALUES(?,?)";
                        $stmt = mysqli_stmt_init($connectDb);
                        mysqli_stmt_prepare($stmt,$sql);
                        mysqli_stmt_bind_param($stmt,"ss",$pid,$fileNewName);

                        $execute = mysqli_stmt_execute($stmt);

                        if ($execute) {
                            $_SESSION['success_msg'] = "Image Added successfully!";
                            header("Location: ".$_SERVER['HTTP_REFERER']);
                        }else{
                            $_SESSION['error_msg'] = "Something went wrong!";
                            header("Location: ".$_SERVER['HTTP_REFERER']);
                        }
                    }else{
                        $_SESSION['error_msg'] = "Failed to Upload!";
                        header("Location: ".$_SERVER['HTTP_REFERER']);
                    }

            }
            }
        }
    }
