<?php

require_once "includes/dbh.inc.php";

if(isset($_POST['update_update_btn'])){
   $update_value = $_POST['update_quantity'];
   $update_id = $_POST['update_quantity_id'];
   $update_quantity_query = mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_value' WHERE order_num = '$update_id'");
   if($update_quantity_query){
      header('location:order.php');
   };
};

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE order_num = '$remove_id'");
   header('location:order.php');
};

if(isset($_GET['continue'])){
   mysqli_query($conn, "DELETE FROM `cart`");
   header('location:menu.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shopping cart</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <style>
        /* .wrapper{
            width: 900px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
        .product-img {
        height: auto;
        object-fit: cover;
        width: 50%;
        text-align: center;
      }
	  span {
		  padding-right: 10px;
		  padding-left: 10px;
	  }
     input[name="update_update_btn"] {
         width: 50%;
         margin-left: 40px;
         margin-top: 40px;

      }
      p {
         text-align: center;
      }
      thead {
         background-color: #fff;
      }
      tr {
         background-color: #fff;
      } */
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
    </style>
</head>
<body>

<?php 
   require_once 'navbar.php'; 
?>
<section>
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
    <div class="col">
    <h1 class="text-center pb-5"><strong>Shopping Cart</strong></h1>
        <div class="card mb-4">
          <div class="card-body p-4">
        <table class="table align-middle mb-0 bg-white">
            <thead class="bg-light">
               <tr>
                  <th class="text-center"><strong>Product</strong></th>
                  <th class="text-center"><strong>Name</strong></th>
                  <th class="text-center"><strong>Price</strong></th>
                  <th class="text-center"><strong>Quantity</strong></th>
                  <th class="text-center"><strong>Total Price</strong></th>
                  <th class="text-center"><strong>Action</strong></th>
               </tr>
            </thead>
            <tbody>
               <?php 
                  $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
                  $grand_total = 0;
                  if(mysqli_num_rows($select_cart) > 0){
                     while($row = mysqli_fetch_assoc($select_cart)){
               ?>
               <tr>
                  <td>
                  <div class="d-flex justify-content-center">
                     <img
                           src="<?=$row['images']?>"
                        alt=""
                        style="width: 200px; height: 200px"
                        class="rounded-circle"
                        />
                  </div>
                  </td>
                  <td>
                     <div class="ms-3">
                        <p class="fw-bold mb-1 text-center"><?php echo $row['name']; ?></p>
                        <p class="text-muted mb-0"></p>
                     </div>
                  </td>


                  <td>
                  <p class="fw-bold mb-1 text-center">₱<?php echo $row['price']; ?></p>
                        <p class="text-muted mb-0"></p>
                  </td>
                  <td class="text-center">
                           <form action="" method="post">
                              <input type="hidden" name="update_quantity_id"  value="<?php echo $row['order_num']; ?>" >
                           <div class="row-sm">
                              <input type="number" class="form-control-sm" name="update_quantity" min="1"  value="<?php echo $row['quantity']; ?>" >
                              </div>
                              <div class="row-sm pt-3">

                              <input type="submit" class="btn btn-primary btn-rounded" value="update" name="update_update_btn">
                              </div>
                           </form>   
                        </td>
                        <td class="text-center"><p class="fw-bold mb-1">₱<?php echo $sub_total = number_format($row['price'] * $row['quantity']); ?></p></td>

                  <td class="text-center">
                     <a href="order.php?remove=<?php echo $row['order_num']; ?>" onclick="return confirm('remove item from cart?')" class="delete-btn"> <i class="fa-solid fa-xmark text-danger"></i></a>
                  </td>

               </tr>
               <?php
                     $grand_total += $sub_total;  
                        };
                     };
                     ?>    
            </tbody>
            </table>

                  <div class="card mb-5">
                     <div class="card-body p-4">
                        <div class="float-end">
                           <p class="mb-0 me-5 d-flex align-items-center">
                              <span class="small text-muted me-2">Order total:</span> <span
                                 class="lead fw-normal">₱<?php echo $grand_total; ?></span>
                           </p>
                        </div>
                     </div>
                  </div>
                  <div class="d-flex justify-content-end pb-4">
                     <a href="order.php?continue" onclick="return confirm('are you sure you want to delete all?');" class="btn btn-danger btn-lg me-2 <?= ($grand_total > 1)?'':'disabled'; ?>"> <i class="fas fa-trash"></i> delete all </a>
                  </div>
                  <div class="d-flex justify-content-end">
                     <a href="menu.php"> <button type="button" class="btn btn-primary btn-lg me-2">Continue shopping</button>
                     <a href="checkout.php" class="btn btn-danger btn-lg <?= ($grand_total > 1)?'':'disabled'; ?>">Procced to checkout</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
</body>
</html>

<?php
    include_once 'footer.php'
?>