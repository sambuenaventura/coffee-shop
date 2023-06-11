<?php
    require_once "navbar.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Express</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/styles.css" />
    <style>
      .brew {
        max-width: 500px;
        padding-left: 250px;
        border-radius: 50px;
      }
      .brown {
        color: #ae6f44;
      }
    </style>
</head>
<body>
    <div class="masthead"
        style="background-image: url('images/bg3.jpg');"
    >
        <div class="color-overlay d-flex justify-content-center align-items-center">
            <div class="singleCol container text-center">
                <h1 style="text-shadow: 2px 2px black;"><strong>COFFEE <span class="brown">EXPRESS</span></strong></h1>
                <p class="lead">
                    <strong>
                    Stay inspired, motivated, and productive with more of your favorite coffee from yours truly.              
                    </strong>
                </p>
                <?php
                    if (isset($_SESSION["useruid"])) {
                        echo "<a href='menu.php' class='btn btn-outline-light'><strong>SHOP NOW</strong></a>";
                    }
                    elseif (isset($_SESSION["adminuid"])) {
                      echo "<a href='menu.php' class='btn btn-outline-light'><strong>SHOP NOW</strong></a>";

                    }
                      else {
                    echo "<a href='login.php' class='btn btn-outline-light'><strong>Order Here!</strong></a>";
                }   
                ?>            
            </div>
        </div>
    </div>
    <section class="customBG feature gradient">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path
          fill="#483434"
          fill-opacity="1"
          d="M0,224L48,213.3C96,203,192,181,288,154.7C384,128,480,96,576,117.3C672,139,768,213,864,208C960,203,1056,117,1152,101.3C1248,85,1344,139,1392,165.3L1440,192L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"
        ></path>
      </svg>
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6">
            <img class="brew" src="images/brew1.jpg" alt=""/>
          </div>

          <div class="col-md-6">
            <h1 class="my-3 text-dark"><strong>BREWED TO BE GOOD</strong></h1>
            <p class="my-4 text-dark lead">
              Coffee Express is specially cultivated and brewed to stimulate<br> you mentally and physically
            </p>

          </div>
        </div>
      </div>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path
          fill="#483434"
          fill-opacity="1"
          d="M0,224L48,213.3C96,203,192,181,288,154.7C384,128,480,96,576,117.3C672,139,768,213,864,208C960,203,1056,117,1152,101.3C1248,85,1344,139,1392,165.3L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"
        ></path>
      </svg>
      
    </section>
    
    <section class="icons py-5">
      <div class="container">
        <div class="row text-center">
          <div class="col-md-4">
            <div class="icon gradient mb-4">
            <div class="icon gradient mb-4">
            <img src="images/list1.jpg" height="500px" alt=""/>

            </div>
            </div>
            <h3 class="mb-0">
            <strong>Cultivated and grown with the best practices</strong>
              </h3>
          </div>
          <div class="col-md-4">
            <div class="icon gradient mb-4">
            <div class="icon gradient mb-4">
            <img src="images/list2.jpg" height="500px" alt=""/>

            </div>
            </div>
            <h3 class="mb-0">
            <strong>The finest of beans selected and dried to perfection</strong>
              </h3>
          </div>
          <div class="col-md-4">
            <div class="icon gradient mb-4">
            <img src="images/list3.jpg" height="500px" alt=""/>

            </div>
            <h3 class="mb-0">
            <strong>Brewed to be good for your utmost enjoyment</strong>
              </h3>
          </div>
        </div>
      </div>
    </section>

      <div class="brownBG">
        <div class="container py-4">
            <div class="row py-4">
                <div class="col-12 col-md-4">
                  <h1 style="text-align: center;"><i class="fa-solid fa-mug-hot"></i></h1>
                  <h2 style="text-align: center;">Good Coffee</h2>
                    <p style="text-align: center;">
                        Coffee Express sources its coffee from more than 30 countries in the three major growing 
                        regions of the world. Quality is top priority and will never be compromised.
                    </p>
                </div>
                <div class="col-12 col-md-4">
                <h1 style="text-align: center;"><i class="fa-solid fa-couch"></i></h1>
                <h2 style="text-align: center;">Great Ambiance</h2>
                    <p style="text-align: center;">
                        What's a good coffee without having a place to chill while enjoying your coffee? 
                        We got you! Work? Study? Or you are just here to relax? We cater all your needs.
                    </p>
                </div>
                <div class="col-12 col-md-4">
                  <h1 style="text-align: center;"><i class="fa-solid fa-wifi"></i></h1>
                  <h2 style="text-align: center;">Free Wifi</h2>
                    <p style="text-align: center;">
                        We offer free wifi regardless of whether you make a purchase. Work and study in our place 
                        as all our tables have built in outlets. Would you ask for more?
                    </p>
                </div>
            </div>
        </div>
      </div>


<?php
    require_once 'footer.php'
?>
</body>
</html>