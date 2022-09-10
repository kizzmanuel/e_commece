<?php
    require "dbConnect.php";
    require "../includes/sessions.php";

    if (!isset($_POST['login'])) {
       header('Location: ../../signin');
    }else{
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = mysqli_stmt_init($connectDb);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,'s',$email);
        $execute = mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

       if (mysqli_num_rows($result) < 1) {
        $_SESSION['error_msg'] = "User not found!";
        header('Location: ../../signin');
       }else{
            $row = mysqli_fetch_assoc($result);
            $returned_password = $row['passwords'];

             if (!password_verify($password, $returned_password)) {
                $_SESSION['error_msg'] = "Incorrect Password!";
                header('Location: ../../signin');
             }else{
                $_SESSION['user'] = $row['id'];
                $_SESSION['role'] = $row['user_role'];
                $_SESSION['fullname'] = $row['first_name'].' ' .$row['last_name'];
                $_SESSION['success_msg'] = "Welcome to earlymarket";
                if ($row['user_role'] != 'user') {
                    header("Location: ../../portal/dashboard");
                }else{
                    header("Location: ../../index");
                }
             }
       }
    }