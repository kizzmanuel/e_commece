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
                        <!-- Add Cat -->
                        <div class="text-end">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                New Category
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-start">
                                           <form action="../assets/config/cat_control.php" method="post">
                                                <label for="">Category Name</label>
                                                <input type="text" name="cat" id="" class="form-control mb-3">
                                                <input type="submit" name="addCat" class="btn btn-primary" value="Add">
                                           </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <h3>Categories</h3>

                        <!-- Show Cat -->
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Cat ID</th>
                                        <th scope="col">Category Name</th>
                                        <th scope="col">...</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sql = "SELECT * FROM categories ORDER BY id DESC LIMIT 50";
                                        $query = mysqli_query($connectDb,$sql);
                                        while($row = mysqli_fetch_assoc($query)){
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $row['cat_id']; ?></th>
                                        <td><?php echo $row['cat_name']; ?></td>
                                        <td>
                                            <a href="sub-category?q=<?php echo $row['cat_id']; ?>&n=<?php echo $row['cat_name']; ?>" class="btn btn-primary">Sub</a>
                                            <a href="../assets/config/cat_control?del=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this data')">Delete</a>
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