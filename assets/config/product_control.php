<?php 
    require "dbConnect.php";
    require "../includes/sessions.php";
    $currUser = $_SESSION['user'];

    if (isset($_POST['addProduct'])) {
        $pid = rand(10000000,99999999);
        $catId = $_POST['catid'];
        $subId = $_POST['subId'];
        $title = $_POST['title'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $descr = $_POST['descr'];

        $sql = "INSERT INTO products(product_id,cat_id,sub_id,title,price,stock,descr) VALUES(?,?,?,?,?,?,?)";
        $stmt = mysqli_stmt_init($connectDb);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"sssssss",$pid,$catId,$subId,$title,$price,$stock,$descr);

        $execute = mysqli_stmt_execute($stmt);

        if ($execute) {
            $_SESSION['success_msg'] = "Product Added successfully!";
            header("Location: ../../portal/dashboard");
        }else{
            $_SESSION['error_msg'] = "Something went wrong!";
            header("Location: ../../portal/dashboard");
        }
    }