<?php
    session_start();

    function success_msg(){
        if(isset($_SESSION['success_msg'])){
            if(isset($_SESSION['success_msg'])){
                $output = "<div class='alert bg-success text-center text-white alert-dismissible fade show' role='alert'><strong>";
                $output .= htmlentities($_SESSION['success_msg']);
                $output .= "</strong></div>";
     
                 $_SESSION['success_msg'] = null;
     
                 return $output;
             }
        }
    }
    function error_msg(){
        if(isset($_SESSION['error_msg'])){
           $output = "<div class='alert bg-danger text-center text-white alert-dismissible fade show' role='alert'><strong>";
           $output .= htmlentities($_SESSION['error_msg']);
           $output .= "</strong></div>";

            $_SESSION['error_msg'] = null;

            return $output;
        }
    }

    function adminAuth(){
        if (!isset($_SESSION['user']) && $_SESSION['role'] != 'admin') {
            header('Location: ../signin');
        }
    }
    function auth(){
        if (!isset($_SESSION['user'])) {
            header('Location: signin');
        }
    }

    function getValue($con,$table,$col,$val){
        $sql = "SELECT * FROM $table WHERE $col = '$val'";
        $query = mysqli_query($con,$sql);

        return mysqli_fetch_assoc($query);
    }

