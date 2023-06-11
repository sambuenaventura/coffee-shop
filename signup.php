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
              
              <h2 class="text-uppercase text-center mb-4">Create an account</h2>
              <div class="pb-1">
              <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") {
                echo "<button disabled type='button' class='btn btn-warning btn-rounded'>Fill in all fields!</button>";
            }
            else if ($_GET["error"] == "invaliduid") {
                echo "<button disabled type='button' class='btn btn-warning btn-rounded'>Chooose a proper username!</button>";
            }
            else if ($_GET["error"] == "invalidemail") {
                echo "<button disabled type='button' class='btn btn-warning btn-rounded'>Chooose a proper email!</button>";
            }
            else if ($_GET["error"] == "passwordsdontmatch") {
                echo "<button disabled type='button' class='btn btn-warning btn-rounded'>Passwords doesn't match!!</button>";
            }
            else if ($_GET["error"] == "stmtfailed") {
                echo "<button disabled type='button' class='btn btn-warning btn-rounded'>Something went wrong, try again!</button>";
            }  
            else if ($_GET["error"] == "usernametaken") {
                echo "<button disabled type='button' class='btn btn-warning btn-rounded'>Username/Email already taken!</button>";
            } 
            else if ($_GET["error"] == "passwordstrength") {
              echo "<button disabled type='button' class='btn btn-warning btn-rounded'><b>Weak password!</b> <br>Make sure your password has a minimum of 8 characters and includes 1 number, 1 uppercase and 1 lowercase letter, and 1 special character.</button>";
          }                 
            else if ($_GET["error"] == "none") {
                echo "<button disabled type='button' class='btn btn-success btn-rounded'>You have signed up!</button>";
            }             
        }
    ?>
              </div>
              <form action="includes/signup.inc.php" method="post">

                <div class="form-outline mb-1">
                  <input type="text" name="name" id="form3Example1cg" class="form-control form-control-lg" />
                  <label class="form-label" for="form3Example1cg">Your Name</label>
                </div>

                <div class="form-outline mb-1">
                  <input type="email" name="email" id="form3Example3cg" class="form-control form-control-lg" />
                  <label class="form-label" for="form3Example3cg">Your Email</label>
                </div>
                <div class="form-outline mb-1">
                  <input type="text" name="uid" id="form3Example3cg" class="form-control form-control-lg" />
                  <label class="form-label" for="form3Example3cg">Your Username</label>
                </div>
                <div class="form-outline mb-1">
                  <input type="password" name="pwd" id="form3Example4cg" class="form-control form-control-lg" />
                  <label class="form-label" for="form3Example4cg">Password</label>
                </div>

                <div class="form-outline mb-1">
                  <input type="password" name="pwdrepeat" id="form3Example4cdg" class="form-control form-control-lg" />
                  <label class="form-label" for="form3Example4cdg">Repeat your password</label>
                </div>

                <div class="form-check d-flex justify-content-center mb-3">
                  <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3cg" />
                  <label class="form-check-label" for="form2Example3g">
                    I agree all statements in <a href="#!" class="text-body"><u>Terms of service</u></a>
                  </label>
                </div>

                <div class="d-flex justify-content-center">
                  <button type="submit" name="submit" 
                    class="btn btn-primary btn-block btn-lg text-light">Sign up</button>
                </div>

                <p class="text-center text-muted mt-3 mb-0">Have an account already? <a href="login.php"
                    class="fw-bold text-body"><u>Log in</u></a></p>

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
    include_once 'footer.php'
?>