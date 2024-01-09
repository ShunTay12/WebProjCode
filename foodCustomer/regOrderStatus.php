<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="./lucasStyle.css">
        <script src="./lucasIndex.js"></script>
        <script src="./lucasFontawesome.js"></script>
    </head>
    <body>
        <div class="prevent_hidden">
            <div class="header">
                <img src="./images/LogoUMP-removebg-preview.png" alt="Logo UMP" class="float_left">
                <ul>
                    <li><a href="">HOME</a></li>
                    <li><a href="">Order Status</a></li>
                    <li><a href="">MembershipCard</a></li>
                    <li><a href="">Dashboard</a></li>
                    <li><a href="">Setting</a></li>
                </ul>
                <div class="cart_border">
                    <a href=""><i class="fa-solid fa-cart-shopping" style="color: #000000;"></i></a>
                </div>
                <button>Login / Sign Up</button>
            </div>
            <hr class="hr_blur">
            <div class="orders_status_top_container">
                <table>
                    <tr>
                        <td rowspan="2">
        <?php
                            $connectDB = mysqli_connect("localhost", "root", "", "web_project");
                            $ordersStatusRow = mysqli_fetch_array(mysqli_query($connectDB, "SELECT orders_status 
                                                                                            FROM orders 
                                                                                            WHERE orders_id = (SELECT MAX(orders_id) 
                                                                                                                FROM orders 
                                                                                                                WHERE user_id = 1)"));
                            if($ordersStatusRow['orders_status'] == 'Ordered') {
        ?>
                                <img src="./images/foodOrdered.png" alt="foodOrdered">
        <?php
                            } else if($ordersStatusRow['orders_status'] == 'Prepared') {
        ?>
                                <img src="./images/foodPrepared.png" alt="foodPrepared">
        <?php
                            } else if($ordersStatusRow['orders_status'] == 'Completed') {
        ?>
                                <img src="./images/foodCompleted.png" alt="foodCompleted">
        <?php
                            }
        ?>
                        </td>
                        <td><img src="./images/QR.png" alt="qrCode"></td>
                        <td rowspan="2">
        <?php
                            if($ordersStatusRow['orders_status'] == 'Completed') {
        ?>
                                <button type="button" onclick="location.href = './regOrderReceipt.php'" class="receipt_button">Payment Receipt</button>
        <?php
                            } else {
        ?>
                                <button type="button" class="receipt_button">Payment Receipt</button>
        <?php
                            }
        ?>
                        </td>
                    </tr>
                    <tr><td>Scan Me To View Order</td></tr>
                </table>
            </div>
            <br><br><br>
            <table>
        <?php
                $DBdata = mysqli_query($connectDB, "SELECT * 
                                                    FROM ((orders 
                                                    JOIN orders_item USING (orders_id)) 
                                                    JOIN food USING (food_id)) 
                                                    WHERE orders_id = (SELECT MAX(orders_id) 
                                                                        FROM orders 
                                                                        WHERE user_id = 1)");
                if(mysqli_num_rows($DBdata) > 0) {
                    while($row = mysqli_fetch_array($DBdata)) {    
        ?>
                        <tr>
                            <td rowspan="2" class="resize_food_img_container"><img src="<?php echo $row['food_image']?>" alt="Menu"></td>
                            <td class="resize_food_name_container2"><?php echo $row['food_name']?></td>
                            <td class="resize_item_quantity_container">x <?php echo $row['item_quantity']?></td>
                        </tr>
                        <tr>
                            <td class="resize_instruction_container">
        <?php
                                if($row['special_instructions'] != NULL) {
                                    echo $row['special_instructions'];
                                } else {
                                    echo 'No Special Instruction';
                                }
        ?>
                            </td>
                            <td class="larger_food_price_container2"><?php echo "RM {$row['food_price']}"?></td>
                        </tr>
        <?php
                    }
                }
        ?>
            </table>
            <br>
            <div class="payment_info_container">
        <?php
                $userInfoRow = mysqli_fetch_array(mysqli_query($connectDB, "SELECT * FROM registered_or_general_user JOIN registered_user USING(user_id) WHERE user_id = 1"));
                $vendorInfoRow = mysqli_fetch_array(mysqli_query($connectDB, "SELECT * FROM food_vendor WHERE vendor_id = (SELECT vendor_id FROM kiosk WHERE kiosk_name = 'Kiosk1')"));
        ?>
                <table class="align_table1">
                    <tr><td><b>Your info:</b></td></tr>
                    <tr><td><?php echo $userInfoRow['registered_username']?></td></tr>
                    <tr><td><?php echo $userInfoRow['registered_email']?></td></tr>
                    <tr><td><?php echo $userInfoRow['registered_phoneNum']?></td></tr>
                    <tr><td class="row_padding_top"><b>Vendor info:</b></td></tr>
                    <tr><td><?php echo $vendorInfoRow['vendor_username']?></td></tr>
                    <tr><td><?php echo $vendorInfoRow['vendor_email']?></td></tr>
                    <tr><td><?php echo $vendorInfoRow['vendor_phoneNum']?></td></tr>
                </table>
                <table class="align_table3">
                    <tr>
                        <td>Subtotal</td>
                        <td>
        <?php
                            echo "RM {$_SESSION['subtotal']}";
        ?>    
                        </td>
                    </tr>
                    <tr>
                        <td>Points Redeemed</td>
                        <td>
        <?php                   
                            $paymentRow = mysqli_fetch_array(mysqli_query($connectDB, "SELECT * 
                                                                                        FROM payment 
                                                                                        WHERE orders_id = (SELECT MAX(orders_id) 
                                                                                                            FROM orders 
                                                                                                            WHERE user_id = 1)"));
                            echo "{$paymentRow['points_redeemed']} points";
        ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="row_padding_top">Total</td>
                        <td class="row_padding_top">
        <?php
                            
                            $ordersRow = mysqli_fetch_array(mysqli_query($connectDB, "SELECT * 
                                                                                        FROM orders 
                                                                                        WHERE orders_id = (SELECT MAX(orders_id) 
                                                                                                            FROM orders 
                                                                                                            WHERE user_id = 1)"));
                            echo "RM {$ordersRow['orders_subtotal']}";
        ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Points Received</td>
                        <td>
        <?php
                            echo "{$paymentRow['points_received']} points";
        ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="row_padding_top">Payment Method</td>
                        <td class="row_padding_top">
        <?php
                            echo $paymentRow['payment_method'];
        ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <?php
            if(!isset($_SESSION['paid']) && $ordersStatusRow['orders_status'] == 'Completed') {
                mysqli_query($connectDB, "UPDATE registered_user SET registered_points = registered_points - (SELECT points_redeemed FROM payment WHERE orders_id = (SELECT MAX(orders_id) FROM orders WHERE user_id = 1 AND orders_status = 'Completed')) + (SELECT points_received FROM payment WHERE orders_id = (SELECT MAX(orders_id) FROM orders WHERE user_id = 1 AND orders_status = 'Completed')) WHERE user_id = 1");
                $_SESSION['paid'] = 'yes';
            }
        ?>
    </body>
</html>