<?php
  include 'api/db_connect.php';
  include 'auth.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php 
    $success = 0;
    if(isset($_POST['submit'])){
      $id = $_SESSION['login_id'];
      $name = $_POST['name'];
      $username = $_POST['username'];
      $password = $_POST['password'];
      $sql = "UPDATE users SET name='$name', username='$username', password='$password' WHERE id=$id";
      

      if(mysqli_query($conn, $sql)) {
        $success = 1;
        $_SESSION['login_name'] = $name;
        $_SESSION['login_username'] = $username;
        $_SESSION['login_password'] = $password;
      } else {
        $success = 2;
      }
    } 
  ?>
  <?php include('header.php') ?>
  <?php 
    include 'nav_bar.php';
  ?>
  
  <!-- edit account details function -->
  
  <title>SMART User Account</title>
</head>
<body>
  
  <div class="container-fluid admin">
    <div class="col-md-7">
      <?php 
        if($success == 1) {
          echo '<div class="alert alert-success">
            <strong>Update User Success!</strong>
          </div>';
        }
      ?>
      <?php 
        if($success == 2) {
          echo '<div class="alert alert-danger">
            <strong>Update User failed!</strong>
          </div>';
        }
      ?>
    </div>
    <h3>Account Details</h3>
    <div class="col-md-7">
      <form action="account.php" method="POST">
        <div class="form-group">
          <label for="name">Name</label>
          <input value="<?php echo $_SESSION['login_name'] ?>" type="text" class="form-control" name="name" placeholder="Enter Name">
        </div>
        <div class="form-group">
          <label for="username">Username</label>
          <input value="<?php echo $_SESSION['login_username'] ?>" type="text" class="form-control" name="username" placeholder="Enter Username">
        </div>
        <div class="form-group">
          <label for="pwd">Password</label>
          <input value="<?php echo $_SESSION['login_username'] ?>" type="password" class="form-control" name="password" placeholder="Enter password">
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
      </form>
    </div>
  </div>
</body>
</html>