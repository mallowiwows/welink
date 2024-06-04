<?php
  if(isset($_POST['submit'])){
    include "connection.php";
    $username = mysqli_real_escape_string($conn, $_POST['user']);
    $password = mysqli_real_escape_string($conn, $_POST['pass']);

    $sql = "select * from admin where username = '$username'";
    $sql = "select * from admin where password = '$password'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
    
    if($row){
      if($password = $row["password"]){
        header("Location: welcome.php");
    } else{
      echo "NO USER FOUND";
    }
} 
  }
?>

<!doctype html>
<html lang="en">
  <style>
    body{    
    background-image: url("back.jpg");
    background-repeat: no-repeat;
    background-size: cover;
  }
  </style>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <?php 
    include "navbar.php";
    ?>
    <div id ="form">
        <h3> Admin Login </h3>
        <form name="form" action="admin_login.php" method = "POST";>
          <label>Username</label>
          <input type="text" id="user" name="user" placeholder="admin" required><br><br>
          <label>Password</label>
          <input type="password" id="pass" name="pass" placeholder="*******" required><br><br>
          <input type="submit" id="btn" value="Login" name="submit"/>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>