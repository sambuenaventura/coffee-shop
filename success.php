<?php
  require_once "includes/dbh.inc.php";
	require_once "navbar.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
      .navbar {
      background-color: #7c6767;
      }
      body { 
         padding-top: 50px; 
      }
         @media screen and (max-width: 768px) {
         body { 
            padding-top: 0px; }
      }
    </style>
</head>
<body>
    <?php
        $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
        $total = 0;
        $grand_total = 0;
        if(mysqli_num_rows($select_cart) > 0){
          while($fetch_cart = mysqli_fetch_assoc($select_cart)){
          $total_price = number_format($fetch_cart['price'] * $fetch_cart['quantity']);
          $grand_total = $total += $total_price;
    ?>
      <span><?= $fetch_cart['name']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
    <?php
         }
      }
      else{
         echo "<div class='display-order'><span>your cart is empty!</span></div>";
      }
    ?>
      <span class="grand-total"> grand total : $<?= $grand_total; ?>/- </span>
    <?php
    if(isset($_GET['continue'])){
        mysqli_query($conn, "DELETE FROM `cart`");
        header('location:menu.php');
     }   
        $sql ="SELECT * from orders ORDER BY id DESC LIMIT 1;";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        $shippingFee = 50;
        if ($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
    ?>
    <?php
        if (isset($_SESSION["adminuid"])) {
            $user = $_SESSION["adminuid"];
        }
        elseif(isset($_SESSION["useruid"])) {
            $user = $_SESSION["useruid"];
        }
    ?>
<section class="h-100 h-dark" style="background-color: #fff;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-8 col-xl-6">
        <div class="card border-top border-bottom border-3" style="border-color: #7c6767 !important;">
          <div class="card-body p-5">

            <p class="lead fw-bold mb-5" style="color: #f37a27;">Purchase Receipt <br>Recipient: <?php echo "<span class='text-dark'>".$user."</span>"?></p>

            <div class="row">
              <div class="col mb-3">
                <p class="small text-muted mb-1">Date</p>
                <p><?php echo $row['date']; ?></p>
              </div>
              <div class="col mb-3">
                <p class="small text-muted mb-1">Estimated Arrival</p>
                <p><?php echo $row['est_date']; ?></p>
              </div>
              <div class="col mb-3">
                <p class="small text-muted mb-1">Order Id.</p>
                <p><?php echo $row['id']; ?></p>
              </div>
            </div>

            <div class="mx-n5 px-5 py-4" style="background-color: #f2f2f2;">
              <div class="row">
                <div class="col-md-8 col-lg-9">
                  <p><?php echo $row['total_products']; ?></p>
                </div>
                <div class="col-md-4 col-lg-3">
                  <p>₱ <?php echo $row['total_price']; ?></p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-8 col-lg-9">
                  <p class="mb-0">Shipping</p>
                </div>
                <div class="col-md-4 col-lg-3">
                  <p class="mb-0">₱ <?php echo $shippingFee?></p>
                </div>
              </div>
            </div>

            <div class="row my-4">
              <div class="col-md-4 offset-md-8 col-lg-3 offset-lg-9">
                <p class="lead fw-bold mb-0" style="color: #f37a27;"><span class="text-dark">Total:</span> ₱<?php echo $row['total_price'] + 50; ?></p>
              </div>
            </div>

            <p class="lead fw-bold mb-4 pb-2" style="color: #f37a27;">Tracking Order</p>

            <div class="row">
              <div class="col-lg-12">
                <div class="horizontal-timeline">
                  <ul class="list-inline items d-flex justify-content-between">
                    <li class="list-inline-item items-list">
                      <p class="py-1 px-2 rounded text-white" style="background-color: #f37a27;">Ordered</p
                        class="py-1 px-2 rounded text-white" style="background-color: #f37a27;">
                    </li>
                    <li class="list-inline-item items-list text-end" style="margin-right: 8px;">
                      <p style="margin-right: -8px;">On the way</p>
                    </li>
                    <li class="list-inline-item items-list text-end" style="margin-right: 8px;">
                      <p style="margin-right: -8px;">Delivered</p>
                    </li>
                  </ul>

                </div>

              </div>
            </div>

            <p class="mt-4 pt-2 mb-0">Thank you for ordering!<br> <a href="order.php?continue" <?= ($grand_total > 1)?'':'disabled'; ?>"></i>Confirm order</a></p>

            <?php       
              }
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>