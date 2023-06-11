<?php
require_once "includes/dbh.inc.php";
require_once 'navbar.php';

if(isset($_POST['order_btn'])){

   $address = $_POST['address'];
   $address2 = $_POST['address2'];
   $postal_code = $_POST['postal_code'];
   $city = $_POST['city'];
   $phone = $_POST['phone'];
   $payment_type = $_POST['payment_type'];
   $date = date('Y-m-d H:i:s');
   
   $est_date = date('Y-m-d H:i:s', strtotime($date. ' +1 day'));

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart`");
   $price_total = 0;
   if(mysqli_num_rows($cart_query) > 0){
      while($product_item = mysqli_fetch_assoc($cart_query)){
         $product_name[] = $product_item['name'] .' ('. $product_item['quantity'] .') ';
         $product_price = number_format($product_item['price'] * $product_item['quantity']);
         $price_total += $product_price;
      };
   };

   $total_product = implode(', ',$product_name);
   $detail_query = mysqli_query($conn, "INSERT INTO `orders`(address, address2, postal_code, city, phone, payment_type, total_products, total_price, date, est_date) VALUES('$address','$address2','$postal_code','$city','$phone','$payment_type','$total_product','$price_total', '$date', '$est_date')") or die('query failed');

   header("location: ./success.php");

}
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
</head>
   <style>
      .navbar {
         background-color: #7c6767;
      }
      body { 
         padding-top: 100px; 
      }
         @media screen and (max-width: 768px) {
         body { 
            padding-top: 0px; }
      }
      .form-label {
         font-weight: bold;
      }
   </style>
<body>
   <div class="container mt-3">
      <section class="checkout-form">
      <h1 class="text-center pb-2"><strong>Complete your order</strong></h1>
         <form class="row g-3" action="" method="post">
            <div class="col md-12">
                  <label for="name" class="form-label">Address line 1</label>
                     <input type="text" class="form-control" placeholder="Address" name="address" required>
                  <label for="name" class="form-label">Address line 2</label>
                     <input type="text" class="form-control" placeholder="Apartment, suite, etc." name="address2" required>
                  <label for="name" class="form-label">Postal Code</label>
                     <input type="number" class="form-control" placeholder="Postal Code" name="postal_code" required>
                  <label for="name" class="form-label">City</label>
                     <input type="text" class="form-control" placeholder="City" name="city" required>
                  <label for="name" class="form-label">Number</label>
                     <input type="number" class="form-control" placeholder="Phone" name="phone" required>
                  <label for="name" class="form-label">Payment method</label>
                     <select class="form-select" name="payment_type">
                        <option value="cash on delivery" selected>Cash on delivery (COD)</option>
                        <option disabled value="credit card">Credit card (N/A)</option>
                        <option disabled value="paypal">Paypal (N/A)</option>
                     </select>
               </div>
               <h1 class="mt-2 mb-3 fw-bold">Your order</h1>
                     <?php
                        $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
                        $total = 0;
                        $grand_total = 0;
                        if(mysqli_num_rows($select_cart) > 0){
                           while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                           $total_price = number_format($fetch_cart['price'] * $fetch_cart['quantity']);
                           $grand_total = $total += $total_price;
                     ?>
                     <div class="col-2">
                        <div class="py-2 pt-3 bg-dark text-white text-center">
                     
                        <p><?= $fetch_cart['name']; ?>(<?= $fetch_cart['quantity']; ?>)</p></div>
                     </div>

                     <?php
                           }
                        }else{
                           echo "<div class='display-order'><span>your cart is empty!</span></div>";
                        }
                     ?>
                     <hr>
                     <h2 class="grand-total text-end">Total : ₱<?= $grand_total; ?> </h2>
            <input type="submit" class="btn btn-danger" value="Order now" name="order_btn" class="btn">
         </form>
                        <h1></h1>
      </section>
   </div>
</body>
</html>