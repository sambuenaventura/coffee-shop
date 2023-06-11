<?php
    require_once "includes/dbh.inc.php";
    require_once 'navbar.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper{
            width: 900px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
        .product-img {
            height: auto;
            object-fit: cover;
            width: 100%;
        }
	    span {
            padding-right: 10px;
            padding-left: 10px;
	    }
        .navbar {
            background-color: #7c6767;
        }
              .navbar {
         background-color: #7c6767;
        }
        body { 
            padding-top: 70px; 
        }
            @media screen and (max-width: 768px) {
            body { 
                padding-top: 0px; }
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="text-center">Admin Panel</h2>
                        <a href="create.php" class="btn text-light pull-right" style="background-color: #483434;"><i class="fa fa-plus"></i> Add New Product</a>
                    </div>
                    <?php
                    $sql = "SELECT * FROM drinks";
                    if($query = mysqli_query($conn, $sql)){
                        if(mysqli_num_rows($query) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Image</th>";
                                        echo "<th>Name</th>";
                                        echo "<th>Price</th>";
                                        echo "<th>Description</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($query)){

                                    echo "<tr>";
									?>
                                    <td><img class="product-img" src="<?=$row['images']?>"></td>
										<?php
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['price'] . "</td>";
                                        echo "<td>" . $row['description'] . "</td>";
                                    

                                        echo "<td>";
                                            echo '<a href="read.php?id='. $row['d_id'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><i class="fa-solid fa-eye ps-2 pe-2"></i></a>';
                                            echo '<a href="update.php?id='. $row['d_id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><i class="fa-solid fa-pencil ps-2 pe-2"></i></a>';
                                            echo '<a href="delete.php?id='. $row['d_id'] .'" title="Delete Record" data-toggle="tooltip"><i class="fa-solid fa-trash-can ps-2 pe-2"></i></a>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            mysqli_free_result($query);
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                     mysqli_close($conn);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>

<?php
    include_once 'footer.php'
?>