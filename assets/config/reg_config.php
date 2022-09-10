<?php
    require "dbConnect.php";
    require "../includes/sessions.php";

    // Set Timezone
    date_default_timezone_set("Africa/Lagos");

    if (!isset($_POST['register'])) {
        header("Location: ../../signin");
    }else{
        // var_dump($_POST);
        //Collect the data 
        $firstName = $_POST['fname'];
        $lastName = $_POST['lname'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $conPass = $_POST['conPass'];
        $role = "user";
        $date = date("Y-m-d h:i:s");
        
        if (strlen($password) < 8) {
            $_SESSION['error_msg'] = "Password too short, max: 8 characters";
            header("Location: ../../signin");
        }
        elseif($password != $conPass){
            $_SESSION['error_msg'] = "Passwords do not match!";
            header("Location: ../../signin");
        }else{
            $password = password_hash($password, PASSWORD_DEFAULT);
            /*
                1. Prepare SQL command.
                2. Initialize Database Connection
                3. Prepare Initilized Object With Command
                4. Bind Parameters 
                5. Execute binded object
            */ 

            $sql = "INSERT INTO users(first_name,last_name,phone,email,passwords,user_role,date_created) VALUES(?,?,?,?,?,?,?)";
            $stmt = mysqli_stmt_init($connectDb);
            mysqli_stmt_prepare($stmt,$sql);
            mysqli_stmt_bind_param($stmt,"sssssss",$firstName,$lastName,$phone,$email,$password,$role,$date);

            $execute = mysqli_stmt_execute($stmt);

            if ($execute) {
                $_SESSION['success_msg'] = "Account created successfully!";
                header("Location: ../../signin");
            }else{
                $_SESSION['error_msg'] = "Something went wrong!";
                header("Location: ../../signin");
            }
           
        }
    }


/*
1. Prepare Sql command
2. initialize database connection
3. prepare initialized object with command
4. bind parameters
5. execute binded objects
*/
