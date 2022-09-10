<?php
  require "assets/config/dbConnect.php";
  include_once "assets/includes/sessions.php";
  include_once "assets/includes/header.php";
?>

    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Shop</strong></div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">

        <div class="row mb-5">
          <div class="col-md-9 order-2">

            <div class="row">
              <div class="col-md-12 mb-5">
                <div class="float-md-left mb-4"><h2 class="text-black h5">Shop All</h2></div>
              </div>
            </div>
            <div class="row mb-5">

              <?php
                 if (isset($_GET['q'])) {
                  // Collect users search value
                  $search = $_GET['q'];
                  $search = trim($search);
                  $sql = "SELECT * FROM products WHERE title LIKE '%$search%' OR descr LIKE '%$search%' OR price LIKE '%$search%'";
                 }else{
                  $sql = "SELECT * FROM products ORDER BY id DESC";
                 }
                  $query = mysqli_query($connectDb, $sql);
                  while ($row = mysqli_fetch_assoc($query)) {
                ?>
              <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                <div class="block-4 text-center border">
                  <figure class="block-4-image">
                    <a href="shop-single?q=<?php echo $row['product_id']; ?>"><img src="assets/images/products/<?php echo getValue($connectDb,'product_image','product_id',$row['product_id'])['image_name']; ?>" alt="Image placeholder" class="img-fluid"></a>
                  </figure>
                  <div class="block-4-text p-4">
                    <h3><a href="shop-single?q=<?php echo $row['product_id']; ?>"><?php echo ucwords($row['title']); ?></a></h3>
                    <p class="mb-0"><?php echo ucwords(substr($row['descr'],0,30).'...'); ?></p>
                    <p class="text-primary font-weight-bold">₦ <?php echo number_format($row['price'],2,'.',','); ?></p>
                  </div>
                </div>
              </div>
              <?php } ?>

            </div>
            <div class="row" data-aos="fade-up">
              <div class="col-md-12 text-center">
                <div class="site-block-27">
                  <ul>
                    <li><a href="#">&lt;</a></li>
                    <li class="active"><span>1</span></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li><a href="#">&gt;</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-3 order-1 mb-5 mb-md-0">
            <div class="border p-4 rounded mb-4">
              <h3 class="mb-3 h6 text-uppercase text-black d-block">Categories</h3>
              <ul class="list-unstyled mb-0">
                <?php
                  $sql = "SELECT * FROM categories ORDER BY cat_name ASC";
                  $query = mysqli_query($connectDb, $sql);
                  while ($row = mysqli_fetch_assoc($query)) {
                ?>
                  <li class="mb-1"><a href="#" class="d-flex"><span><?php echo ucwords($row['cat_name']); ?></span></a></li>
                <?php } ?>
              </ul>
            </div>

           
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="site-section site-blocks-2">
                <div class="row justify-content-center text-center mb-5">
                  <div class="col-md-7 site-section-heading pt-4">
                    <h2>Categories</h2>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-0" data-aos="fade" data-aos-delay="">
                    <a class="block-2-item" href="#">
                      <figure class="image">
                        <img src="images/women.jpg" alt="" class="img-fluid">
                      </figure>
                      <div class="text">
                        <span class="text-uppercase">Collections</span>
                        <h3>Women</h3>
                      </div>
                    </a>
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0" data-aos="fade" data-aos-delay="100">
                    <a class="block-2-item" href="#">
                      <figure class="image">
                        <img src="images/children.jpg" alt="" class="img-fluid">
                      </figure>
                      <div class="text">
                        <span class="text-uppercase">Collections</span>
                        <h3>Children</h3>
                      </div>
                    </a>
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0" data-aos="fade" data-aos-delay="200">
                    <a class="block-2-item" href="#">
                      <figure class="image">
                        <img src="images/men.jpg" alt="" class="img-fluid">
                      </figure>
                      <div class="text">
                        <span class="text-uppercase">Collections</span>
                        <h3>Men</h3>
                      </div>
                    </a>
                  </div>
                </div>
              
            </div>
          </div>
        </div>
        
      </div>
    </div>

<?php include_once "assets/includes/footer.php"; ?>