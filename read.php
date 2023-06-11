<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "includes/dbh.inc.php";
	require_once "navbar.php";

    
    // Prepare a select statement
    $sql = "SELECT * FROM drinks WHERE d_id = ?";
    
    if($stmt = mysqli_prepare($conn, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_id);
		// echo "Hello";
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
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
                // URL doesn't contain valid id parameter. Redirect to error page
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
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
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
                    <h1 class="mt-5 mb-3 text-center">View Record</h1>
                    <div class="form-group">
                        <label><strong>Name</strong></label>
                        <p><?php echo $row["name"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label><strong>Price</strong></label>
                        <p><?php echo $row["price"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label><strong>Description</strong></label>
                        <p><?php echo $row["description"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label><strong>Image location</strong></label>
                        <p><?php echo $row["images"]; ?></p>
                    </div>


                    <p><a href="admin.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
