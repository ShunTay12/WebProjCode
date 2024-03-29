<?php 
    include('../config/constants.php');

    if(isset($_GET['food_id']) && isset($_GET['food_image']) && isset($_GET['kiosk_id'])) {
        $foodId = $_GET['food_id'];
        $foodImg = $_GET['food_image'];
        $kioskId = $_GET['kiosk_id'];

        if($foodImg != "") {
            $path = "../images/menu/" . $foodImg;

            $remove = unlink($path);

            if($remove == false) {
                $_SESSION['upload'] = "<div>Failed to remove Food Image</div>";
                echo '<script>window.location = "'. SITEURL . 'foodVendor/vendorManageMenu.php?kiosk_id=' . $kioskId . '";</script>';
                die();
            }
        }

        $sql = "DELETE FROM food WHERE food_id='$foodId'";
        $run = mysqli_query($conn, $sql);

        if($run == true) {
            $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
            echo '<script>window.location = "'. SITEURL . 'foodVendor/vendorManageMenu.php?kiosk_id=' . $kioskId . '";</script>';
        }
        else {
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Food.</div>";
            echo '<script>window.location = "'. SITEURL . 'foodVendor/vendorManageMenu.php?kiosk_id=' . $kioskId . '";</script>';
        }

    }
    else {
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        echo '<script>window.location = "'. SITEURL . 'foodVendor/vendorManageMenu.php?kiosk_id=' . $kioskId . '";</script>';
    }
?>