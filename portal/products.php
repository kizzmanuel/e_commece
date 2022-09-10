<?php
require "../assets/config/dbConnect.php";
require_once "../assets/includes/sessions.php";
auth();

$currUser = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - Earlycode Blog</title>
    <link href="../assets/img/logo.png" rel="shortcut icon" />
    <link href="../assets/css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/fontawsome/css/all.css">
    <link rel="stylesheet" href="../assets/css/animate.css">
</head>

<body class="sb-nav-fixed">
    <div id="layoutSidenav">
        <?php include "../assets/includes/dashnav.php"; ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <?php echo success_msg();
                    echo error_msg(); ?>



                    <div class="card my-3 py-4 p-2">

                        <h3><?php echo $_GET['n']; ?></h3>

                        <!-- Show Products -->
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>--</td>
                                        <th scope="col">Product ID</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Product Stock</th>
                                        <th scope="col">Product Price</th>
                                        <th scope="col">...</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sub = $_GET['q'];
                                        $sql = "SELECT * FROM products WHERE sub_id = '$sub'  ORDER BY id DESC";
                                        $query = mysqli_query($connectDb,$sql);
                                        echo mysqli_num_rows($query);
                                        if (mysqli_num_rows($query) < 1) {
                                            echo  "<h2 class='text-center p-3 text-danger'>No Products Found</h2>";
                                        }
                                        while($row = mysqli_fetch_assoc($query)){
                                    ?>
                                    <tr>
                                        <td>
                                            <img src="../assets/images/children.jpg" height="100">
                                        </td>
                                        <td><?php echo $row['product_id']; ?></td>
                                        <td><?php echo $row['title']; ?></td>
                                        <td><?php echo $row['stock']; ?></td>
                                        <td><?php echo $row['price']; ?></td>
                                        <td>
                                            <a href="#" class="btn btn-primary">view</a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                       
                    </div>
                </div>
            </main>
            <!-- Footer -->
            <?php require "../assets/includes/dashfoot.php"; ?>

        </div>
    </div>
</body>

</html>