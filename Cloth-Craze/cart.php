<?php
include './database/connect.php';
include './function/common_function.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - <?PHP echo $_SESSION['user_username'];?></title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-image: url("images/bgBLACK.webp");
    
}

/* Header styles */
header {
    background-image: url("images/bgBLACK.webp");
    padding: 10px;
    box-shadow: 0px 0px 4px 4px #91b4b4;
    margin: 20px 30px;
    width: 195vh;
    border-radius: 10px;
    color: white;
    /* border-radius: 30px; */
}
header:hover{
    box-shadow: 0px 0px 4px 4px rgb(141, 25, 25);
}
nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-right: 20px;
}

.logo {
    display: flex;
    align-items: center;
}

.login a{
    color: white;
    text-decoration: none;

}

.logo a img {
    width: 50px;
    height: 50px;
    margin-right: 10px;
    object-fit: cover;
    border-radius: 50%;
}

h1{
    color: white;
    font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
}
h1:hover{
    color: rgb(141, 25, 25);
}
nav ul {
    list-style-type: none;
    display: flex;
    
}

nav ul li {
    margin-left: 20px;
}

nav ul li a {
    text-decoration: none;
    color: white;
    font-size: large;
    transition: 250ms;
    font-family:'Times New Roman', Times, serif;
    
}


nav ul li :hover{
    border-radius: 5px;
    color: rgb(141, 25, 25);
    text-decoration:underline 3px rgb(141, 25, 25);
    box-shadow: 0px 2px 2px 0px rgb(33, 33, 33);
    
}

.customer{
    margin-left: 74%;
    margin-bottom: 25px;
    width: 300px;
    border-radius: 10px;
    box-shadow: 0px 0px 4px 4px #91b4b4;
}
.customer:hover{
    box-shadow: 0px 0px 4px 4px rgb(141, 25, 25);
}

.user{
    display: flex;
    align-items: center;
    justify-content:right;
}
.user a{
    padding: 10px;
    text-decoration: none;
    color: white;
    font-size: large;
    transition: 250ms;
    font-family:'Times New Roman', Times, serif;
}
.user a:hover{
    
    border-radius: 5px;
    color: rgb(141, 25, 25);
    text-decoration:underline 3px rgb(141, 25, 25);
    box-shadow: 0px 2px 2px 0px rgb(33, 33, 33);
    
}
        /* Basic styling for the container */
.container {
    color: white;
    background-image: url("images/bgBLACK.webp");
    padding: 50px 80px;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
    width: 195vh;
    margin: 25px;
    border-radius: 10px;
    box-shadow: 0px 0px 4px 4px #91b4b4;
    padding: 20px;
}

/* Styling for the table */
table {
    width: 175vh;
    border-collapse: collapse;
    background-color: #000000;
}

/* Styling for table headers */
th {
    padding: 10px 20px;
    text-align: left;
    background-color: #201e1e;
}

/* Styling for table cells */
td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
}
td img{
    width: 100px;
    height: 100px;
}

/* Styling for product image */
.product-image {
    width: 100px; /* Adjust the width as needed */
    height: auto;
}

/* Styling for remove and operations columns */
.remove, .operations {
    text-align: center;
}

/* Styling for remove button */
.submit{
    margin-top: 10px;
    padding: 10px 30px;
    background-color: #201e1e;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.submit:hover{
    background-color: #000000; 
    color: red;
    box-shadow: 2px 2px 2px 2px rgb(141, 25, 25);
}

.submit a{
    text-decoration: none;
    color: white;
}
.submit a:hover{
    background-color: #000000; 
    color: red;
}
h4{
    margin: 20px 10px;
}

/* Footer styles */
footer {
    background-image: url("images/images/bgBLACK.webp");
    color: #fff;
    text-align: center;
    padding: 20px 0;
}
footer:hover {
    color: rgb(141, 25, 25);
}

    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const qtyInputs = document.querySelectorAll(".qty-input");

            qtyInputs.forEach(function(qtyInput) {
                qtyInput.addEventListener("input", function() {
                    const value = parseInt(qtyInput.value, 10);
                    if (value < 1) {
                        alert("Quantity cannot be less than 1.");
                        qtyInput.value = 1; // Set the input field to 1
                    }
                });
            });
        });
    </script>

</head>
<body >
    <header>
        <nav>
            <div class="logo">
            <a href="home.php"><img src="images/Logo.jpeg" alt="Startup Company Logo"></a>
                <h1>Cloth Craze</h1>
            </div>
            <ul>
                <li><a href=""><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item();  ?></sup></a></li>
                <li><a href="home.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="services.php">Services</a></li>
                <li><a href="products.php">Product</a></li>
                
            </ul>
        </nav>
    </header>

    <div class="customer">

            <?php 
            if(!isset($_SESSION['user_username'])){
                echo " 
                       <div class='user'>
                       <a href='./User_area/user_login.php'>Log In</a>
                       <a href='./User_area/user_reg_form.php'>Sign Up</a>
                            <a href=''>Welcome Guest</a>
                      </div>

                       ";
            }else{
                echo "<div class='user'>
                            <a href='./User_area/profile.php'>Welcome ".$_SESSION['user_username']."</a>
                            <a href='./User_area/user_logout.php'>Logout</a>
                      </div>";
            }
            
            ?>    
        </div>

        <div class="container">
        <div class="row">
            <h2>Total:<?php total_cart_price()?></h2>
            <form action="" method="post">
                <?php 
                global $con;
                $get_ip_address = getIPAddress();
                $cart_query = "SELECT * FROM `cart_details` WHERE ip_address = '$get_ip_address'";
                $result = mysqli_query($con, $cart_query);
                $result_count = mysqli_num_rows($result);

                if ($result_count > 0) {
                    echo "<table>
                        <thead>
                            <tr>
                                <th>Product Title</th>
                                <th>Product Image</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Remove</th>
                                <th colspan='2'>Operations</th>
                            </tr>
                        </thead>
                        <tbody>";

                    while ($row = mysqli_fetch_array($result)) {
                        $product_id = $row['product_id'];

                        $select_product = "SELECT * FROM `product_details` WHERE product_id = $product_id";
                        $result_product = mysqli_query($con, $select_product);

                        while ($row_product_price = mysqli_fetch_array($result_product)) {
                            $product_price = array($row_product_price['product_price']);
                            $price_table = $row_product_price['product_price'];
                            $product_name = $row_product_price['product_name'];
                            $product_image = $row_product_price['product_image'];
                    ?>
                           <tr>
                                <td><?php echo $product_name ?></td>
                                <td><img src="./Admin/product_images/<?php echo $product_image ?>" alt=""></td>
                                <td><input type="number" class="qty-input" name="qty[<?php echo $product_id; ?>]" value="<?php echo $row['quantity']; ?>"></td>
                                <td><?php echo $price_table ?></td>
                                <!-- <td><?php //echo $total?></td> -->
                                <td><input type="checkbox" name="removeitem[]" value="<?php echo $product_id ?>"></td>
                                <td>
                                    <input type="submit" class="submit" value="Update Cart" name="Update_Cart">
                                    <input type="submit" class="submit" value="Remove Cart" name="Remove_Cart">
                                </td>
                                
                            </tr>
                            
                    <?php
                        }
                    }
                    echo "</tbody></table>";
                } else {
                    echo "<h2 style='color: white;'>Cart is empty</h2>";
                }
                
                if ($result_count > 0) {
                    echo "
                    <input type='submit' class='submit' value='Continue Shopping' name='continue_shopping'>
                    <button class='submit'><a href='./User_area/checkout.php'>Checkout</a></button>";
                } else {
                    echo "<input type='submit' class='submit' value='Continue Shopping' name='continue_shopping'>";
                }

                if (isset($_POST['continue_shopping'])) {
                    echo "<script>window.open('products.php', '_self')</script>";
                }

                if (isset($_POST['Update_Cart'])) {
                    foreach ($_POST['qty'] as $product_id => $quantity) {
                        $update_cart = "UPDATE `cart_details` SET quantity = $quantity WHERE ip_address = '$get_ip_address' AND product_id = $product_id";
                        $result_update_quantity = mysqli_query($con, $update_cart);
                    }
                    echo "<script>window.open('cart.php', '_self')</script>";
                }

                

                function remove_cart_item() {
                    global $con;

                    if (isset($_POST['Remove_Cart'])) {
                        foreach ($_POST['removeitem'] as $remove_id) {
                            $delete_query = "DELETE FROM `cart_details` WHERE product_id = $remove_id";
                            $run_delete = mysqli_query($con, $delete_query);
                            if ($run_delete) {
                                echo "<script>window.open('cart.php', '_self')</script>";
                            }
                        }
                    }
                }

                echo $remove_item = remove_cart_item();
                ?>
            </form>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Cloth Craze. All rights reserved.</p>
    </footer>


    
</body>
</html>