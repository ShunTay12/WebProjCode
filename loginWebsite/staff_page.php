<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['admin_id'])){
   header('location:login_form.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>staff page</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="container">

   <div class="content">
      <h3>hi, <span>Staff</span></h3>
      <h1>welcome <span><?php echo $_SESSION['admin_username'] ?></span></h1>
      <p>this is an staff page</p>
      <a href="login_form.php" class="btn">login</a>
      <a href="register_form.php" class="btn">register</a>
      <a href="logout.php" class="btn">logout</a>
      <a href="qr.php" class="btn">QR</a>
      <a href="../foodAdmin/adminViewKiosk.php" class="btn">Manage All Kiosk</a>
   </div>

</div>

</body>
</html>