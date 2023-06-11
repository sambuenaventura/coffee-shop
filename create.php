<?php
// Include config file
    require_once "includes/dbh.inc.php";
    require_once "navbar.php";
 
// Define variables and initialize with empty values
$image = $name = $price = $description = "";
$image_err = $name_err = $price_err = $description_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $input_image = trim($_POST["image"]);
    if(empty($input_image)){
        $image_err = "Please enter image location.";     
    } else{
        $image = $input_image;
    }

    $input_name = trim($_POST["names"]);
    if(empty($input_name)){
        $name_err = "Please enter first name.";
    } else{
        $name = $input_name;
    }
    
    $input_price = trim($_POST["price"]);
    if(empty($input_price)){
        $price_err = "Please enter price.";     
    } else{
        $price = $input_price;
    }
    
    $input_description = trim($_POST["description"]);
     if(empty($input_description)){
        $description_err = "Please enter description.";     
    } else{
        $description = $input_description;
    }

    // Check input errors before inserting in database
    if(empty($image_err) && empty($name_err) && empty($price_err) && empty($description_err)){
        $sql = "INSERT INTO drinks (images, name, price, description) VALUES (?, ?, ?, ?)";         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_image, $param_name, $param_price, $param_description);            
            // Set parameters
            $param_image = $image;
            $param_name = $name;
            $param_price = $price;
            $param_description = $description;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                header("location: admin.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($conn);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
        .wrapper{
            width: 600px;
            margin: 0 auto;
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
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5 text-center">Create Record</h2>
                    <p>Please fill this form and submit to add a drink to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Image</label>
                            <input type="text" name="image" class="form-control <?php echo (!empty($image_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $image; ?>">
                            <span class="invalid-feedback"><?php echo $image_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="names" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="text" name="price" class="form-control <?php echo (!empty($price_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $price; ?>">
                            <span class="invalid-feedback"><?php echo $price_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" name="description" class="form-control <?php echo (!empty($description_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $description; ?>">
                            <span class="invalid-feedback"><?php echo $description_err;?></span>
                        </div>

                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="admin.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>

