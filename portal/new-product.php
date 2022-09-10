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



                    <div class="card p-3 shadow mt-3">
                        <h3>Add New Product</h3>

                        <!-- Get Sub Categories -->
                        <form method="get" class="my-4">
                            <label>Select Category</label>
                            <select name="cat" class="form-select my-2">
                                <?php
                                $sql = "SELECT * FROM categories ORDER BY cat_name ASC";
                                $query = mysqli_query($connectDb, $sql);
                                while ($row = mysqli_fetch_assoc($query)) {
                                ?>
                                    <option value="<?php echo $row['cat_id']; ?>"><?php echo $row['cat_name'] ?></option>
                                <?php } ?>
                            </select>

                            <div class="text-end">
                                <button type="submit" class="btn btn-success">Get Sub Categories</button>
                            </div>
                        </form>
                        <?php
                        if (isset($_GET['cat'])) {
                        ?>
                            <form action="../assets/config/product_control" method="post">
                                <select name="subId" class="form-select my-2">
                                    <?php
                                        $cat = $_GET['cat'];
                                        $sql = "SELECT * FROM sub_categories WHERE cat_id = '$cat' ORDER BY sub_name ASC";
                                        $query = mysqli_query($connectDb, $sql);
                                        while ($row = mysqli_fetch_assoc($query)) {
                                    ?>
                                        <option value="<?php echo $row['sub_id']; ?>"><?php echo $row['sub_name'] ?></option>
                                    <?php } ?>
                                </select>
                                <input type="hidden" name="catid" value="<?php echo $_GET['cat']; ?>">
                                <input type="text" name="title" placeholder="Title" class="form-control mb-3">
                                <input type="number" name="price" placeholder="Price" class="form-control mb-3">
                                <input type="number" name="stock" placeholder="Stock" class="form-control mb-3">

                                <textarea name="descr" class="form-control my-1" style="height: 200px;"></textarea>

                                <div class="text-end">
                                    <button type="submit" name="addProduct" class="btn btn-success">Add Product</button>
                                </div>
                            </form>
                        <?php } ?>
                    </div>
                </div>
            </main>
            <!-- Footer -->
            <?php require "../assets/includes/dashfoot.php"; ?>>
        </div>
    </div>
</body>

</html>