<!DOCTYPE html>
<html lang="en">
<head>
  <?php include('header.php') ?>
  <?php 
  session_start();
  if(isset($_SESSION['login_id'])){
      header('Location:home.php');
  }
  ?>
  <?php 
    
    include 'api/db_connect.php';
    // register user function
    if(isset($_POST['submit'])){
      $name = $_POST['name'];
      $username = $_POST['username'];
      $password = $_POST['password'];
      $status = 1;
      $user_type = $_POST['user_type'];
      $chk = $conn->query("SELECT * FROM users where username = '".$username."' ")->num_rows;
      if($chk > 0){
        echo '<div class="alert alert-danger">
          <strong>Username already exist</strong>
        </div>';
      } else {
        $sql = "INSERT INTO users (name, username, password, status, user_type) VALUES ('$name', '$username', '$password', '$status', '$user_type')";
        if (mysqli_query($conn, $sql)) {
          echo '<div class="alert alert-success">
          <strong>Success!</strong>User created successfully!
        </div>';
        } else {
          echo '<div class="alert alert-danger">
          <strong>'+mysqli_error($conn)+'</strong> 
        </div>';
        }
      }
      

      // if($insert_user){
      //   $id = $conn->insert_id;
      //   $insert_students =$conn->query("INSERT INTO students set user_id = '".$id."', level_section='".$level_section."' ");
      //   if($insert_students){
      //     echo json_encode(array('status'=>1));
      //   }
      // }
    }
  ?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>SMART Quiz System</title>
</head>

<body style="background: #87B1FD; no-repeat;">

  <div class="container">
    <div class="row justify-content-center">
      <h1 style="margin-top:50px;color:#fff;"><strong>SMART QUIZ SYSTEM</strong></h1>  
    </div>



		<div class="card col-md-4 offset-md-4 mt-4 mb-4">
      <div class="card-header-edge text-white">
        <strong>Register</strong>
      </div>
      <div class="card-body">
        <form action="register.php" method="post">
          <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control">
          </div>
          <div class="form-group">
            <label>Username</label>
            <input type="username" name="username" class="form-control">
          </div>
          <div class="form-group">
            <label>User Type</label>
            <select class="form-control" name="user_type">
              <option value="1">Admin</option>
              <option value="2">Lecturer</option>
              <option value="3">Student</option>
            </select>
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control">
          </div> 
          <div class="form-group text-right">
            <button class="btn btn-primary btn-block" name="submit">Register</button>
          </div>
        </form>
        <div class="form-group text-right">
          <a class="btn btn-secondary btn-block" href="login.php">Go to Login</a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>