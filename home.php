<?php
    include 'api/db_connect.php';
   include 'auth.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('header.php') ?>
    <title>SMART Quiz System</title>
</head>
<body>
    <?php 
    include 'nav_bar.php';
    ?>
    <div class="container-fluid admin">
        <div class="card col-md-5 offset-2">
            <div class="card-body">
            <div style="text-align: center;">
            <?php echo "<img src='resources/book.png'height='200' width='200' />";
						?>
            </div>
            </div>
        </div>
       </div>
</body>

</html>