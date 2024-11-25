<?php
include '../database/connect.php';
include '../function/common_function.php';
session_start();

if (!isset($_SESSION['user_username'])) {
    echo "<script>window.open('user_login.php','_self')</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome <?php echo $_SESSION['user_username'];?></title>
    <link rel="stylesheet" href="../products.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
               integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
               crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
                /* Basic styling for the container */

.container {
    color: black;
    background-image: url("../images/bgBLACK.webp");
    /* background-color: white; */
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
.container:hover{
    background-color:#dbd5d5 ;
    box-shadow: 0px 0px 4px 4px rgb(141, 25, 25);
}

.profile{
    margin: 10px;
    padding: 10px 10px;
    width: 20%;
    background-color: black;
    padding: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    box-shadow: 0px 0px 4px 4px #91b4b4;
    transition: 250ms;
}
.profile:hover{
    box-shadow: 0px 0px 4px 4px rgb(141, 25, 25);

}
.profile ul{
    list-style: none;
}

.profile ul li{
    padding: 10px;
    
}
.profile ul li h3{
    font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
    padding: 10px;
    color: white;
    
}

.profile ul li a{
    font-size: larger;
    text-decoration: none;
    color: white;
}
.profile ul li a:hover{
    color: rgb(141, 25, 25);
    /* text-decoration:underline 3px rgb(141, 25, 25); */

}

.profile ul li img{
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    
}

.describe{
    margin: 10px;
    padding: 10px 10px;
    width: 70%;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
}
.describe ul{
    list-style: none;
}
/* .describe ul li{
    
} */
.describe ul li a{
    text-decoration: none;
    color: white;
    transition: 250ms;
}
.describe ul li a:hover{
    color:rgb(141, 25, 25) ;
    text-decoration:underline 3px rgb(141, 25, 25);
}
    </style>
</head>
<body >
    <header>
        <nav>
            <div class="logo">
            <a href="../home.php"><img src="../images/Logo.jpeg" alt="Startup Company Logo"></a>
                <h1>Cloth Craze</h1>
            </div>
            <ul>
                <li><a href="../cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php  cart_item();  ?></sup></a></li>
                <li><a href="../home.php">Home</a></li>
                <li><a href="../about.php">About</a></li>
                <li><a href="../services.php">Services</a></li>
                <li><a href="../products.php">Product</a></li>
            </ul>
        </nav>
    </header>
    

    <div class="container">
        <!-- profile showing -->
            <div class="profile">
            <ul>
            
             <?php 
                $username=$_SESSION['user_username'];
                $user_image = "SELECT * 
                               from `customers`
                               where customer_name ='$username'";

                $result_image = mysqli_query($con,$user_image);
                $row_image = mysqli_fetch_array($result_image);
                $user_image=$row_image['customer_image'];
                echo "<li><img src='./user_images/$user_image' alt=''></li>";
                ?>       
            <li><h3><?php echo $username ?></h3></li>     
            <li><a href="profile.php">Pending Orders</a></li>
            <li><a href="profile.php?edit_account">Edit Account</a></li>
            <li><a href="profile.php?my_orders">My Orders</a></li>
            <li><a href="profile.php?delete_account">Delete Account</a></li>
            <li><a href="user_logout.php">Logout</a></li>
            </ul>
            </div>
        <!-- Profile detail showing -->
            <div class="describe">
            <ul>
                <li><?php get_order_details();
                
                if(isset($_GET['edit_account'])){
                    include('edit_account.php');
                }
                if(isset($_GET['my_orders'])){
                    include('my_orders.php');
                }
                if(isset($_GET['delete_account'])){
                    include('delete_account.php');
                }
                ?></li>
            </ul>
            </div>

    </div>


   
    
    <footer>
        <p>&copy; 2024 Cloth Craze. All rights reserved.</p>
    </footer>


   
</body>
</html>
