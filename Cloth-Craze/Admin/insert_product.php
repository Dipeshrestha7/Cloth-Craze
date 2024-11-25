<?php 
include('../database/connect.php');

if(isset($_POST['insert_button'])){
    $product_name =$_POST['product_name'];
    $product_category =$_POST['product_category'];
    //accessing images
    $product_image=$_FILES['product_image']['name'];
    //accessing image temp name
    $temp_image=$_FILES['product_image']['tmp_name'];

    $product_price =$_POST['product_price'];
    
    //checking empty condition
    if ($product_name =='' or $product_category=='' or $product_image=='' or $product_price=='') {
        echo " <script> alert('Please fill all available fields')</script>";
        exit;
    } else{
        move_uploaded_file($temp_image, "./product_images/$product_image");  
        //insert query 
        $insert_product = "INSERT INTO `product_details` (`category_id`, `product_name`, `product_image`, `product_price`) VALUES 
                                            ('$product_category', '$product_name', '$product_image', '$product_price')";
        $result_query = mysqli_query($con,$insert_product);
        if ($result_query) {
            echo " <script> alert('Successfully inserted the product')</script>";
        }
        
    }

}
?>

<html>
    <head>
    <link rel="stylesheet" href="signup.css">
    <title>Insert Product -Admin Dashboard</title>


    <style>
    h1{
        text-align: center;
        margin: 50px ;
    } 
    .container{
    text-align: center;
    border: 2px solid white;
    max-width: 600px;
    margin: 0 auto;
    background-color:black;
    color: white;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    input[type="text"],
    input[type="file"] {
    width: 20%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    color: black;
    }    

    .form-group {
    margin-bottom: 10px;
    }

    .form-group select{
    width: 40%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #201e1e;
    color: white;
    }

    button {
    padding: 10px 20px;
    background-color: #201e1e;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    }

    button:hover{
    background-color: #000000; 
    color: red;
    box-shadow: 2px 2px 2px 2px rgb(141, 25, 25);   
    }
    </style>
    </head>

    <body>
        <h1>Insert Product</h1>
    <form action="" method="post" enctype="multipart/form-data">
    <div class="container">
        <div class="form-group">
        <Label>Product Name</Label>
        <input type="text" name="product_name" placeholder="Enter product name">
        </div> <br>
        <div class="form-group">
        <select name="product_category" >

            <option value="">Select a Category</option>
            <?php
            $selecty_query="select * from `product_category`";
            $result_query =mysqli_query($con,$selecty_query);

            while($row= mysqli_fetch_assoc($result_query)){
                $category_title=$row['category_name'];
                $category_id=$row['category_id'];
                echo "<option value='$category_id'>$category_title </option>";
            }
            
            ?> 

        </select>
        </div> <br>
        <div class="form-group">
            <label for="">Insert Image</label>
            <input type="file" name="product_image" placeholder="Product Name">
        </div><br>
        <div class="form-group">
        <label for="">Product Price</label>
        <input type="text" id="product_price" name="product_price" placeholder="Enter product price">
        </div><br>
        
        <button type="submit" name="insert_button" >Insert Product</button>

    </div>
        <script>
        document.addEventListener("DOMContentLoaded", function() {
            const productPriceInput = document.getElementById("product_price");

            productPriceInput.addEventListener("input", function() {
                const value = parseFloat(productPriceInput.value);
                if (value < 0) {
                    alert("Product price cannot be negative.");
                    productPriceInput.value = ""; // Clear the input field
                }
            });
        });
    </script>

</form>
    </body>
</html>