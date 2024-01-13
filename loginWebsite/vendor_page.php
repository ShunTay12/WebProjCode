<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['vendor_id'])){
   header('location:login_form.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>vendor page</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="container">

   <div class="content">
      <h3>hi, <span>Vendor</span></h3>
      <h1>welcome <span><?php echo $_SESSION['vendor_username'] ?></span></h1>
      <p>this is an vendor page</p>
      <a href="login_form.php" class="btn">login</a>
      <a href="register_form.php" class="btn">register</a>
      <a href="logout.php" class="btn">logout</a>
      <a href="qr.php" class="btn">QR</a>
      <a href="../foodVendor/vendorManageMenu.php" class="btn">Manage My Kiosk</a>
   </div>

</div>

</body>
</html>