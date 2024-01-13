<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

   // $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = $_POST['email'];
   $pass = $_POST['password'];
   // $cpass = md5($_POST['cpassword']);
   // $user_type = $_POST['user_type'];
   // $status = $_POST['status'];

   $selectUser = " SELECT * FROM registered_user WHERE registered_email = '$email' && registered_password = '$pass'";
   $selectVendor = " SELECT * FROM food_vendor WHERE vendor_email = '$email' && vendor_password = '$pass'";
   $selectAdmin = " SELECT * FROM administrator WHERE admin_email = '$email' && admin_password = '$pass'";

   $resultUser = mysqli_query($conn, $selectUser);
   if(mysqli_num_rows($resultUser) > 0){
      $row = mysqli_fetch_array($resultUser);
      $_SESSION['user_id'] = $row['user_id'];
      $_SESSION['registered_username'] = $row['registered_username'];
      header('location:user_page.php');
   }

   $resultVendor = mysqli_query($conn, $selectVendor);
   if(mysqli_num_rows($resultVendor) > 0){
      $row = mysqli_fetch_array($resultVendor);
      $_SESSION['vendor_id'] = $row['vendor_id'];
      $_SESSION['vendor_username'] = $row['vendor_username'];
      header('location:vendor_page.php');
   }

   $resultAdmin = mysqli_query($conn, $selectAdmin);
   if(mysqli_num_rows($resultAdmin) > 0){
      $row = mysqli_fetch_array($resultAdmin);
      $_SESSION['admin_id'] = $row['admin_id'];
      $_SESSION['admin_username'] = $row['admin_username'];
      header('location:staff_page.php');
   }

   $error[] = 'incorrect email or password';

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>login now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="email" name="email" required placeholder="enter your email">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="submit" name="submit" value="login now" class="form-btn">
      <p>don't have an account? <a href="register_form.php">register now</a></p>
      <p>VISIT AS GUEST? <a href="./registration_general_user.php">click here</a></p>
   </form>

</div>

</body>
</html>