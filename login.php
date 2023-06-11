<?php
    require_once 'navbar.php'
?>
  
  <style>
    body { padding-top: 40px; }
      @media screen and (max-width: 768px) {
      body { padding-top: 0px; }
    }

  </style>

<div id="intro" class="bg-image shadow-2-strong">
  <div class="mask d-flex align-items-center h-100" style="background-color: rgba(0, 0, 0, 0.5);">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-4">Welcome back!</h2>
              <div class="pb-1">
                <?php
                    if (isset($_GET["error"])) {
                        if ($_GET["error"] == "emptyinput") {
                            echo "<button disabled type='button' class='btn btn-warning btn-rounded'>Fill in all fields!</button>";
                        }
                        else if ($_GET["error"] == "wronglogin") {
                            echo "<button disabled type='button' class='btn btn-warning btn-rounded'>Incorrect login information!</button>";
                        }             
                    }
                ?>
              </div>
                <form action="includes/login.inc.php" method="post">
                        <div class="form-outline mb-1">
                          <input type="text" name="uid" id="form3Example1cg" class="form-control form-control-lg" />
                          <label class="form-label" for="form3Example1cg">Username/Email</label>
                        </div>

                        <div class="form-outline mb-1">
                          <input type="password" name="pwd" id="form3Example4cg" class="form-control form-control-lg" />
                          <label class="form-label" for="form3Example4cg">Password</label>
                        </div>

                        <div class="form-check d-flex justify-content-center mb-3">
                          <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3cg" />
                          <label class="form-check-label" for="form2Example3g">
                            Remember me
                          </label>
                        </div>

                        <div class="d-flex justify-content-center">
                          <button type="submit" name="submit" 
                            class="btn btn-primary btn-block btn-lg text-light">Log in</button>
                        </div>

                        <p class="text-center text-muted mt-3 mb-0">Don't have an account? <a href="signup.php"
                            class="fw-bold text-body"><u>Sign up</u></a></p>
                </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php
  require_once 'footer.php';
?>
