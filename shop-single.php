<?php
require "assets/config/dbConnect.php";
include_once "assets/includes/sessions.php";
include_once "assets/includes/header.php";
?>

<?php
echo success_msg();
echo error_msg();
$pid = $_GET['q'];
$sql = "SELECT * FROM products WHERE product_id = '$pid' ORDER BY id DESC";
$query = mysqli_query($connectDb, $sql);
$row = mysqli_fetch_assoc($query);
?>

<div class="bg-light py-3">
  <div class="container">
    <div class="row">
      <div class="col-md-12 mb-0"><a href="index">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black"><?php echo ucwords($row['title']); ?></strong></div>
    </div>
  </div>
</div>

<div class="site-section">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <?php
            $sql = "SELECT * FROM product_image WHERE product_id = '$pid'";
            $query = mysqli_query($connectDb, $sql);
            $num = 0;
            while ($imagerow = mysqli_fetch_assoc($query)) {
              $num++;
            ?>
              <div class="carousel-item <?php echo ($num === 1) ? "active" : "" ?>">
                <img src="assets/images/products/<?php echo $imagerow['image_name']; ?>" class="d-block w-100" alt="productImage">
              </div>
            <?php } ?>
            <style>
              img[alt=productImage] {
                height: 500px;
              }

              @media (max-width: 768.9px) {
                img[alt=productImage] {
                  height: 300px;
                }
              }
            </style>
          </div>
          <button class="carousel-control-prev border-0 bg-transparent text-primary" type="button" data-target="#carouselExampleControls" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </button>
          <button class="carousel-control-next border-0 bg-transparent text-primary" type="button" data-target="#carouselExampleControls" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </button>
        </div>
      </div>
      <div class="col-md-6">
        <h2 class="text-black"><?php echo ucwords($row['title']); ?></h2>
        <small>Product Id: <?php echo $row['product_id']; ?></small>
        <p class="mb-4">
          <?php echo ucwords($row['descr']); ?>
        </p>
        <p><strong class="text-primary h4">₦ <?php echo number_format($row['price'], 2, '.', ','); ?></strong></p>
        <!-- <div class="mb-5">
              <div class="input-group mb-3" style="max-width: 120px;">
              <div class="input-group-prepend">
                <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
              </div>
              <input type="text" class="form-control text-center" value="1" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
              <div class="input-group-append">
                <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
              </div>
            </div>

            </div> -->
        <p><a href="cart.html" class="buy-now btn btn-sm btn-primary">Add To Cart</a></p>
        <?php
        if ($_SESSION['role'] === 'admin') {
        ?>
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addImage">
            Add New Immage
          </button>

          <!-- Modal -->
          <div class="modal fade" id="addImage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add Images</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="assets/config/file_control.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="pid" value="<?php echo $row['product_id']; ?>">
                    <input type="file" name="file" accept="image/*" class="form-control">
                    <button type="submit" name="addProdImage" class="btn btn-primary my-3">Save changes</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        <?php } ?> <br><br>

        <?php
              $payAmount = 1000;
              $email = "chrisgraham2625@gmail.com";
              $phone = "+23491234667789";
              $ref = "EBR".rand(10000,99999).time();
          ?>
        <!-- Starts HEre -->
        <small>Pay online with your debit card</small>
        <input type="submit" class="btn-success btn" style="cursor:pointer;" value="Pay Now" id="submit" />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
        <script type="text/javascript">
          document.addEventListener("DOMContentLoaded", function(event) {
            document.getElementById('submit').addEventListener('click', function() {

              var flw_ref = "",
                chargeResponse = "",
                trxref = "FDKHGK" + Math.random(),
                API_publicKey = "FLWPUBK_TEST-83af4504f6370dc6576a13be3875e79b-X";
              //Always change flutterwave public key to your own key

              //   ENTER ALL ESSENTIAL VARIABLES
              // var amount_ea = "50000";
              var amount_ea = <?php echo $payAmount; ?>;
              var email_ea = <?php echo (json_encode($email)); ?>;
              var phone_ea = <?php echo (json_encode($phone)); ?>;
              var ref_ea = <?php echo (json_encode($ref)); ?>;

              getpaidSetup({
                PBFPubKey: API_publicKey,
                customer_email: email_ea,
                amount: amount_ea,
                customer_phone: phone_ea,
                currency: "USD",
                txref: ref_ea,
                meta: [{
                  metaname: "EA-NG",
                  metavalue: "NG"
                }],
                onclose: function(response) {},
                callback: function(response) {
                  txref = response.data.txRef, chargeResponse = response.data.chargeResponseCode;
                  if (chargeResponse == "00" || chargeResponse == "0") {
                    //   if payment failed
                    window.location = "payment-failed";
                  } else {
                    //when successful
                    window.location = "payment-success?id=2&amount=2000&ref=sijoxaskxmaoncpo";
                  }
                }
              });
            });
          });
        </script>
      </div>
    </div>
  </div>
</div>

<?php include_once "assets/includes/footer.php"; ?>