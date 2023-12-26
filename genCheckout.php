<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="./lucasStyle.css">
    </head>
    <body>
        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
            <table>
    <?php
                $connectDB = mysqli_connect("localhost", "root", "", "web_project");
                $DBdata = mysqli_query($connectDB, "SELECT * FROM ((orders JOIN orders_item USING (orders_id)) JOIN food USING (food_id)) WHERE (user_id = 1 AND orders_status IS NULL)");
                if(mysqli_num_rows($DBdata) > 0) {
                    while($row = mysqli_fetch_array($DBdata)) {    
    ?>
                        <tr>
                            <td rowspan="2" class="resize_food_img_container"><img src="<?php echo $row['food_image']?>" alt="Menu"></td>
                            <td class="resize_food_name_container2"><?php echo $row['food_name']?></td>
                            <td class="resize_item_quantity_container">x <?php echo $row['item_quantity']?></td>
                        </tr>
                        <tr>
                            <td class="resize_instruction_container"><input type="text" name="specialInstruction[<?php echo $row['food_id']?>]" placeholder="Kindly Provide Your Special Instruction Here..."></td>
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
                <table class="align_table4">
                    <tr><td><b>Your info:</b></td></tr>
                    <tr><td><?php echo $userInfoRow['registered_username']?></td></tr>
                    <tr><td><?php echo $userInfoRow['registered_phoneNum']?></td></tr>
                    <tr><td class="row_padding_top"><b>Vendor info:</b></td></tr>
                    <tr><td><?php echo $vendorInfoRow['vendor_username']?></td></tr>
                    <tr><td><?php echo $vendorInfoRow['vendor_email']?></td></tr>
                    <tr><td><?php echo $vendorInfoRow['vendor_phoneNum']?></td></tr>
                </table>
                <table class="align_table2">
                    <tr>
                        <td>Subtotal</td>
                        <td class="position_abs_right100">
    <?php 
                            $row = mysqli_fetch_array(mysqli_query($connectDB, "SELECT * FROM orders WHERE user_id = 1 AND orders_status IS NULL"));
                            echo "RM {$row['orders_subtotal']}";
    ?>    
                        </td>
                    </tr>
                </table>
            </div>
            <br>
            <button type="submit" class="checkout_button" name="placeOrderGen" formaction="<?php echo htmlspecialchars('./processing.php')?>" formmethod="POST">Place Order</button>
        </form>
    </body>
</html>