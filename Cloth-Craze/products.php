<?php
include './database/connect.php';
include 'function/common_function.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - Cloth Craze</title>
    <link rel="stylesheet" href="products.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body >
    <header>
        <nav>
            <div class="logo">
            <a href="home.php"><img src="images/Logo.jpeg" alt="Startup Company Logo"></a>
                <h1>Cloth Craze</h1>
            </div>
            <ul>
                <li><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php  cart_item();  ?></sup></a></li>
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
    <!-- callinf cart function  -->
    <?php
        cart();
    ?>

    <section id="search" class="search">
        <div  class="search-container">
            <input type="text" id="myInput" placeholder="Search..." onkeyup="searchProducts()">
            <button onclick="searchButton()" >Search</button>
        </div>
    </section>
    <section id="products" class="products">

    <h1>Category</h1> 
    <div class="pCategory" id="pCategory" >
            
            <?php

                    getProductCategory();
                    ?>

    </div>
           <div class="pdetails" id="pdetails">
            
                    <!-- fetching products  -->
            <?php

            // calling function
         getProductDetails();
         getUniqueProduct();
        //  $ip = getIPAddress();  
        //  echo 'User Real IP Address - ' . $ip;  
            ?>
                
        
    </section>
    
    <footer>
        <p>&copy; 2024 Cloth Craze. All rights reserved.</p>
    </footer>


    <script>
        // Function to handle product search
function searchProducts() {
    var input, filter, products, productLinks, productName, i;
    input = document.getElementById('myInput');
    filter = input.value.toUpperCase();
    products = document.getElementById('pCategory');
    productLinks = products.getElementsByTagName('a');

    for (i = 0; i < productLinks.length; i++) {
        productName = productLinks[i].getElementsByTagName('p')[0];
        if (productName.innerHTML.toUpperCase().indexOf(filter) > -1) {
            productLinks[i].style.display = "";
        } else {
            productLinks[i].style.display = "none";
        }
    }
}

// Function to handle click on search button
function searchButton() {
    var input, filter, products, productLinks, productName, i;
    input = document.getElementById('myInput');
    filter = input.value.toUpperCase();
    products = document.getElementById('pCategory');
    productLinks = products.getElementsByTagName('a');
    var found = false;

    // Your product data
    var allProducts = [
        { name: "Product 1", category: "Category A", price: "$10" },
        { name: "Product 2", category: "Category B", price: "$15" },
        // Add more products as needed
    ];

    for (i = 0; i < productLinks.length; i++) {
        productName = productLinks[i].getElementsByTagName('p')[0];
        if (productName.innerHTML.toUpperCase() === filter) {
            productLinks[i].style.display = "";
            found = true;
        } else {
            productLinks[i].style.display = "none";
        }
    }

    // Show product details based on the search result
    if (found) {
        var pdetailsDiv = document.getElementById('pdetails');
        pdetailsDiv.innerHTML = "<h2>Related Products</h2>";

        // Filter products based on the search query
        var filteredProducts = allProducts.filter(function(product) {
            return product.category.toUpperCase() === filter;
        });

        // Display filtered products
        if (filteredProducts.length > 0) {
            for (var j = 0; j < filteredProducts.length; j++) {
                pdetailsDiv.innerHTML += `
                    <div class="pdetail">
                        <p>${filteredProducts[j].name}</p>
                        <p>${filteredProducts[j].price}</p>
                        <button>Order Now</button>
                    </div>`;
            }
        } else {
            pdetailsDiv.innerHTML = "<p>No product found.</p>";
        }
    } else {
        var pdetailsDiv = document.getElementById('pdetails');
        pdetailsDiv.innerHTML = "<p>No product found.</p>";
    }
}

    </script>
</body>
</html>
