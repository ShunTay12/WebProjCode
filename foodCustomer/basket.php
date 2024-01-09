<?php session_start(); ?>
<!DOCTYPE html>
<!-- UPDATE orders
SET orders_subtotal = (SELECT SUM(food.food_price * orders_item.item_quantity)
                       FROM food 
                       JOIN orders_item
                       USING(food_id)
                       WHERE orders_id = (SELECT orders_id FROM orders WHERE user_id = 1 											AND orders_status IS NULL)
                       )
WHERE user_id = 1 AND orders_status IS NULL; -->
<html>
    <head>
        <link rel="stylesheet" href="./lucasStyle.css">
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
            <a href="./selectFood.php" title="Back To Menu"><img src="./images/backButton.png" alt="Back to menu" class="back_button"></a>
            <form action="<?php echo htmlspecialchars('./processing.php')?>" method="POST">
                <table>
            <?php
                    $connectDB = mysqli_connect("localhost", "root", "", "web_project");
                    $DBdata = mysqli_query($connectDB, "SELECT * FROM ((orders JOIN orders_item USING (orders_id)) JOIN food USING (food_id)) WHERE (user_id = 1 AND orders_status IS NULL)");
                    if(mysqli_num_rows($DBdata) > 0) {
                        mysqli_query($connectDB, "UPDATE orders
                                                    SET orders_subtotal = (SELECT SUM(food.food_price * orders_item.item_quantity)
                                                                            FROM food 
                                                                            JOIN orders_item
                                                                            USING(food_id)
                                                                            WHERE orders_id = (SELECT orders_id 
                                                                                                FROM orders 
                                                                                                WHERE user_id = 1 AND orders_status IS NULL)
                                                                            )
                                                    WHERE user_id = 1 AND orders_status IS NULL");
                        while($row = mysqli_fetch_array($DBdata)) {    
            ?>
                            <tr>
                                <td rowspan="2" class="resize_food_img_container"><img src="<?php echo $row['food_image']?>" alt="Menu"></td>
                                <td colspan="3" class="resize_food_name_container"><?php echo $row['food_name']?></td>
                            </tr>
                            <tr>
                                <td class="larger_food_price_container"><?php echo "RM {$row['food_price']}"?></td>
                                <td class="dustbin_container"><button type="submit" name="delete" value="<?php echo $row['food_id']?>"><img src="./images/dustbin.jpg" alt="Delete dustbin"></button></td>
                                <td class="food_quantity_container">
                                    <button type="submit" name="minus" value="<?php echo $row['food_id']?>"><img src="./images/minus.svg" alt="Minus"></button>
                                    <span><?php echo $row['item_quantity']?></span>
                                    <button type="submit" name="plus" value="<?php echo $row['food_id']?>"><img src="./images/plus.svg" alt="Plus"></button>
                                </td>
                            </tr>
            <?php
                        }
            ?>
                </table>
                <br><br><hr><br><br><br>
                <table class="subtotal_table1">
                    <tr>
                        <td><b>Subtotal</b></td>
                        <td class="subtotal_container"><b>
            <?php 
                            $row = mysqli_fetch_array(mysqli_query($connectDB, "SELECT * FROM ((orders JOIN orders_item USING (orders_id)) JOIN food USING (food_id)) WHERE (user_id = 1 AND orders_status IS NULL)"));
                            echo "RM {$row['orders_subtotal']}";
            ?>          
                        </b></td>
                    </tr>
                </table>
                <br><br><br><br>
                <button type="submit" class="checkout_button" formaction="./regCheckout.php" formmethod="POST">Checkout</button>
            </form>
            <?php
                    } else {
                        echo '<div class="empty_basket_message">Seems like no item in your basket</div><br><br>';
                    }
                    unset($_SESSION['food_category']);
            ?>
        </div>
    </body>
</html>