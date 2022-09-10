<?php
  include_once "assets/config/dbConnect.php";
  include_once "assets/includes/sessions.php";

  auth();
  include_once "assets/includes/header.php";

    $currUser =  $_SESSION['user'];
    $sql = "SELECT * FROM users WHERE id = '$currUser'";
    $query = mysqli_query($connectDb,$sql);
    $row = mysqli_fetch_assoc($query);
?>
<div class="container my-4">
    <div class="card mx-auto p-3 shadow" style="max-width: 700px;">
        <?php echo success_msg(); echo error_msg(); ?>
        <div class="row">
            <div class="col-md-8"></div>
            <!-- 

                When sending file data always add the attribute for enctype
                enctype="multipart/form-data"
             -->
            <form action="assets/config/file_control" method="post" enctype="multipart/form-data" class="col-md-4">
                <label for="prof-img" class="position-relative">
                    <img src="assets/images/avatars/<?php 
                        if (empty($row['prof_pic'])) {
                            echo "user.png";
                        }else{
                            echo $row['prof_pic']."?".mt_rand();
                        }
                    ?>" height="150" width="150" class="d-block shadow mx-auto" style="border-radius: 5px 5px 50% 50%;">

                    <div class="text-center position-absolute w-100" style="bottom: 0; left: 0; font-size: 40px; border-radius: 0 0 300px 300px; background-color: rgba(0, 0, 0, .6);">
                        <i class="icon-camera text-light"></i>
                    </div>
                </label>
                <input type="file" name="file" id="prof-img" class="form-control d-none" required>
                <button type="submit" class="btn btn-primary" name="updatePix">Change Image</button>
            </form>
        </div>
        <form action="assets/config/update_config.php" method="post" class="row">
            <div class="col-md-6 mb-2">
                <label>First Name</label>
                <input type="text" value="<?php echo $row['first_name']; ?>" name="fname" class="form-control" required>
            </div>
            <div class="col-md-6 mb-2">
                <label>Last Name</label>
                <input type="text" value="<?php echo $row['last_name']; ?>" name="lname" class="form-control" required>
            </div>
            <div class="col-md-6 mb-2">
                <label>Phone Number</label>
                <input type="tel" name="phone" value="<?php echo $row['phone']; ?>" class="form-control" required>
            </div>
            <div class="col-md-6 mb-2">
                <label>Email</label>
                <input type="email" value="<?php echo $row['email']; ?>" class="form-control" readonly>
            </div>


            <div class="col-12 my-2 text-right">
                <button type="submit" name="update" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>


<?php include_once "assets/includes/footer.php"; ?>