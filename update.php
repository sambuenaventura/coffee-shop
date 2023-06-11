<?php
// Include config file
    require_once "includes/dbh.inc.php";
    require_once "navbar.php";
 
// Define variables and initialize with empty values
$image = $name = $price = $description = "";
$image_err = $name_err = $price_err = $description_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate lastname
    $input_image = trim($_POST["image"]);
    if(empty($input_image)){
        $image_err = "Please enter image location.";     
    } else{
        $image = $input_image;
    }

    // Validate name
    $input_name = trim($_POST["names"]);
    if(empty($input_name)){
        $name_err = "Please enter first name.";
    } else{
        $name = $input_name;
    }
    
    // Validate lastname
    $input_price = trim($_POST["price"]);
    if(empty($input_price)){
        $price_err = "Please enter price.";     
    } else{
        $price = $input_price;
    }
    
    // Validate salary
    $input_description = trim($_POST["description"]);
     if(empty($input_description)){
        $description_err = "Please enter description.";     
    } else{
        $description = $input_description;
    }
    
    
    // Check input errors before inserting in database
    if(empty($image_err) && empty($name_err) && empty($price_err) && empty($description_err)){
        // Prepare an update statement
        $sql = "UPDATE drinks SET images=?, name=?, price=?, description=? WHERE d_id=$id";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_image, $param_name, $param_price, $param_description);
             echo "update hello";
             // Set parameters
             $param_image = $image;
             $param_name = $name;
             $param_price = $price;
             $param_description = $description;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
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
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM drinks WHERE d_id = ?";
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $query = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($query) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $image = $row["images"];
                    $name = $row["name"];
                    $price = $row["price"];
                    $description = $row["description"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($conn);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
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
                    <h2 class="mt-5 text-center">Update Record</h2>
                    <p>Please edit the input values and submit to update the drinks record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
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
                        
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="admin.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>

