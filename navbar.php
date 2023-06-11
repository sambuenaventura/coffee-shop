
<?php session_start(); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/940ea4eeb2.js" crossorigin="anonymous"></script>
    <title>Document</title>
    <style>
      #intro {
        background-image: url(https://images.unsplash.com/photo-1500353391678-d7b57979d6d2?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80);
        background-size:100%; 
        height: 100vh;
      }
      @media (min-width: 992px) {
        #intro {
          margin-top: -58.59px;
        }
      }
      .navbar .nav-link {
        color: #fff !important;
        font-weight: bold;
      }
      hr {
        margin: 1rem 0;
        color: inherit;
        background-color: currentColor;
        border: 0;
        opacity: 0.25;
      }
    </style>
</head>
<body>
<nav class="navbar fixed-top navbar-expand-lg navbar-dark p-md-3">      
  <div class="container-fluid">
      <a class="navbar-brand nav-link" href="index.php">
         <img src="images/logo.png" width="50px" alt=""/>
        </a>
        <!-- <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarExample01"
          aria-controls="navbarExample01" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars"></i>
        </button> -->
        <div class="collapse navbar-collapse" id="navbarExample01">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <!-- <hr class="bg-danger border-2 border-top border-danger"> -->
            <?php
                if (isset($_SESSION["useruid"])) {
                    echo "<li class='nav-item active'><a class='nav-link' aria-current='page' href='index.php'>Home</a></li>";
                    echo "<li class='nav-item'><a class='nav-link' href='menu.php'>Menu</a></li>";
                    echo "<li class='nav-item'><a class='nav-link' href='order.php'><i class='fa-solid fa-cart-shopping'></i></a></li></ul>";
                    echo "<ul class='navbar-nav me-right mb-2 mb-lg-0'><li class='nav-item'><a class='nav-link' href='includes/logout.inc.php'>Log out</a></li></ul>";
                }
                elseif (isset($_SESSION["adminuid"])) {
                    echo "<li class='nav-item'><a class='nav-link' href='index.php'>Home</a></li>";
                    echo "<li class='nav-item'><a class='nav-link' href='menu.php'>Menu</a></li>";
                    echo "<li class='nav-item'><a class='nav-link' href='order.php'><i class='fa-solid fa-cart-shopping'></i></a></li></ul>";
                    echo "<ul class='navbar-nav me-right mb-2 mb-lg-0'><li class='nav-item'><a class='nav-link' href='admin.php'>Admin</a></li>";
                    echo "<li class='nav-item'><a class='nav-link' href='includes/logout.inc.php'>Log out</a></li></ul>";

                }
                else {
                    echo "<li><a class='nav-link' href='login.php'>Log in</a></li>";  
                    echo "<li><a class='nav-link' href='signup.php'>Sign up</a></li>";
                             
                }
            ?>
        </ul>
        
        </div>
    </div>
    </nav>
</body>

