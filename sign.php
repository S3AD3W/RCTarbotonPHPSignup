<?php
$success=0;
$user=0;

if($_SERVER['REQUEST_METHOD']=='POST'){
  include 'connect.php';
  $username=$_POST['username'];
  $password=$_POST['password'];

//   $sql = "insert into registrations(username,password)
//   values('$username','$password')";
//   $result=mysqli_query($con,$sql);

// if($result){
//   echo "Data inserted successfully";
// }else{
//   die(mysqli_error($con));
// }

$sql = "Select * from registrations where username = '$username' and password = '$password'";

$result = mysqli_query($con, $sql);
if($result){
  $num=mysqli_num_rows($result);//for checking if user is on the system
  if($num>0){
    // echo "Username already exists";
    $user=1;
  }else{
    $sql = "insert into registrations(username,password)
    values('$username','$password')";
    $result=mysqli_query($con,$sql);
  
  if($result){
  // echo "Signup successful";
  $success=1;
  header('location:login.php');
  }else{
  die(mysqli_error($con));
}
}
}
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title> Sign-up Form</title>
  </head>
  <body>
      <?php
        if ($user){
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Sorry!</strong> Username already exists.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;
            </span>
          </button>
        </div>';
        }

        if ($success){
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> You have successfully signed up.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';
        }
      ?>

    <h1 class="text-center" > Sign-up Page </h1>
    <div class="container m-5">
      <form action='sign.php' method="post">
        <div class="form-group">
        <label for="exampleInputEmail1"> User Name </label>
        <input type="text" class="form-control" id="exampleUserName" aria-describedby="UserNameHelp" placeholder="Enter User Name" name="username"> 
      </div>
    <div class="form-group">
      <label for="exampleInputPassword1"> Password </label>
      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Enter Password" name="password">
    </div>
    <button type="submit" class="btn btn-primary w-100">Sign up</button>
      </form>
    </div>

  </body>
</html>