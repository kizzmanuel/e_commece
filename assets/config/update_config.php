<?php
    require "dbConnect.php";
    require "../includes/sessions.php";

    $currUser = $_SESSION['user'];

    if (!isset($_POST['update'])) {
        header('Location: ../../signin');
    }else{
        $firstname = $_POST['fname'];
        $lastname = $_POST['lname'];
        $phone = $_POST['phone'];


        $sql = "UPDATE users SET first_name = ?, last_name = ?, phone = ? WHERE id = '$currUser'";
        $stmt = mysqli_stmt_init($connectDb);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,'sss',$firstname,$lastname,$phone);
        $execute = mysqli_stmt_execute($stmt);

        if (!$execute) {
            $_SESSION['error_msg'] = "Something Went Wrong!";
            header('Location: ../../profile');
        }else{
            $_SESSION['fullname'] = $firstname.' '.$lastname;
            $_SESSION['success_msg'] = "Update successful!";
            header('Location: ../../profile');
        }
    }