<?php

require_once "includes/dbh.inc.php";
require_once 'navbar.php'; 

if(isset($_POST['add_to_cart'])){

   $name = $_POST['name'];
   $price = $_POST['price'];
   $image = $_POST['images'];
   $quantity = 1;

   $cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$name'");

   if(mysqli_num_rows($cart) > 0){
      $message[] = $name . ' <span class="one">is already added to <a class="text-link" href="order.php">cart</a></span>';
   }else{
      $insert = mysqli_query($conn, "INSERT INTO `cart`(name, price, images, quantity) VALUES('$name', '$price', '$image', '$quantity')");
      $message[] = $name.' <span class="two">added to <a class="text-link" href="order.php">cart</a> succesfully</span>';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <style>
      body{
         background-color: #ffffff;
      }
      .navbar {
         background-color: #7c6767;

      }
      .navbar .nav-link {
        color: #ffffff !important;
      }
      body { padding-top: 60px; }
         @media screen and (max-width: 768px) {
         body { padding-top: 0px; }
      }
      .row {
         display: flex;
         justify-content: center;
         align-items: center;
      }
      .product-detail {
         padding:5px;
         margin-bottom: 10px;
         /* background-color: #f2c4ce; */
         border: 1px solid grey;
      }
      .other-detail {
         text-align: center;
         
      }

      .price {
         font-weight: 600;
         font-size: 20px;
         color: #000;
      }

      .product-img {
         height: 100%;
         /* object-fit: cover; */
         width: 100%;
      }
      /* .price-style {
         background-color: #f58f7c;
      } */

      .btn-style {
         margin-bottom: 10px;
      }
      .btn {
         background-color: #613b29;
         color: white;
      }
      .one {
         color: orange;
      }
      .two {
         color: green;
      }
      /* h3 {
         color: red;
      } */
      .darkBG {
         background-color: #363636;
    color: white;
      }
</style>

</head>
<body>
   

<body>

<div class="container">
   <div class="row">
   <div class="col-sm-9">
          <div class="row">
             
             <h1 class="pt-5 pb-2 text-center"><strong>Drinks Menu</strong></h1>
             <?php

if(isset($message)){
   foreach($message as $message){
      echo '<div class="pb-3 text-center"><h4>'.$message.' <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </h4></div>';
   };
};

?>
      <?php    
      $select_products = mysqli_query($conn, "SELECT * FROM `drinks`");
      if(mysqli_num_rows($select_products) > 0){
         while($row = mysqli_fetch_assoc($select_products)){
      ?>
      <div class="col-md-4">
      <form action="" method="post">
         
         <div class="product-detail">
            
               <img class="product-img" src="<?=$row['images']?>" height="100" alt="">
            <div class="other-detail">
               <h3><?php echo $row['name']; ?></h3>
               <div class="price-style"> 
                  <p class="price">₱<?php echo $row['price']; ?></p>

               <input type="hidden" name="name" value="<?php echo $row['name']; ?>">
               <input type="hidden" name="price" value="<?php echo $row['price']; ?>">
               <input type="hidden" name="images" value="<?php echo $row['images']; ?>">
               <input type="submit" class="btn btn-style" value="add to cart" name="add_to_cart">
               </div>
            </div>
         </div>
      </form>
      </div>

      <?php
         };
      };
      ?>

   </div>


</div>


<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>