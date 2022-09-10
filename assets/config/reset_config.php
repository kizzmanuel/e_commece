<?php
      require "dbConnect.php";
      require "../includes/sessions.php";


      if (isset($_POST['sendTOKEN'])) {
        $email = $_POST['email'];

        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = mysqli_stmt_init($connectDb);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,'s',$email);
        $execute = mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

       if (mysqli_num_rows($result) < 1) {
        $_SESSION['error_msg'] = "User not found!";
        header('Location: ../../reset');
       }else{
          $token = rand(100000,999999);

          $sql = "UPDATE users SET password_reset = '$token' WHERE email = '$email' ";
          $update = mysqli_query($connectDb,$sql);

          if(!$update){
            $_SESSION['error_msg'] = "Something went wrong!";
            header('Location: ../../reset');
          }else{

            $to = $email;
            $subject = "Password Reset";
            $message =  "
            <html>
                <div style=\"background-color: #FBD6D2; margin: 0 auto; width: 300px; box-shadow: 5px 5px 60px 10px #FBD6D2; padding: 10px;\">
                    <img src=\"https://earlymarket.apexassets.online/assets/images/logo.png\"  style=\"display: block; margin: 0 auto; width: 200px;\">

                    <h1 style=\"text-align: center; padding: 20px 0;\">Welcome to the Future</h1>
                    <h3 style=\"text-align: center; padding: 20px 0;\">Please use the token \"$token \" to reset your password</h3>
                </div>
            </html>";

            $headers = "From: Earlymarket <help@earlymarket.com>\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset= ISO-8859-1\r\n";
            $mail = mail($to,$subject,$message,$headers);

            if (!$mail) {
              $_SESSION['error_msg'] = "Something went wrong!";
              header('Location: ../../reset');
            }else{
              $_SESSION['success_msg'] = "Please visit your email to get your token!";
              header('Location: ../../reset?tokenSent');
            }
          }
       }
      }

      elseif(isset($_POST['resetPassword'])){
        $token = $_POST['token'];
        $password = $_POST['password'];
        $sql = "SELECT password_reset,email FROM users WHERE password_reset = ?";
        $stmt = mysqli_stmt_init($connectDb);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,'s',$token);
        $execute = mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

       if (mysqli_num_rows($result) < 1) {
        $_SESSION['error_msg'] = "Invalid Token!";
        header('Location: ../../reset?tokenSent');
       }else{
        if (strlen($password) < 6) {
          $_SESSION['error_msg'] = "Password is too short!";
          header('Location: ../../reset?tokenSent');
        }else{
          $password = password_hash($password, PASSWORD_DEFAULT);
          $sql = "UPDATE users SET passwords = '$password', password_reset = 'SET' WHERE password_reset = '$token'";
          $update = mysqli_query($connectDb,$sql);
          if(!$update){
            $_SESSION['error_msg'] = "Something went wrong!";
            header('Location: ../../reset');
          }else{
            $_SESSION['success_msg'] = "Password reset successful, please log in!";
            header('Location: ../../signin');
          }

        }
       }
      }