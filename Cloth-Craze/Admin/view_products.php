

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Product</title>
    <style>
        h1{
            text-align: center;
        }
        table {
        margin: 50px 100px;
        width: 175vh;
        border-collapse: collapse;
        background-color: #000000;
        }

        table a {
        text-decoration: none;
        color: white;
        font-size: large;
        transition: 250ms;
        font-family:'Times New Roman', Times, serif;
        
        }
        /* Styling for table headers */
        th {
            padding: 10px 20px;
            text-align: center;
            background-color: #201e1e;
        }

        /* Styling for table cells */
        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }
        td img{
            width: 100px;
            height: 100px;
            text-align: center;
        }
        td i:hover{
            color:rgb(141, 25, 25);
        } 

    </style>
</head>
<body>
    <h1>All Products</h1>
    <table>
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Product Image</th>
                <th>Product Price</th>
                <th>Total Sold</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>

        <tbody>
            <?php
            
            $get_products= "SELECT * 
                            from `product_details`";
            $result = mysqli_query($con,$get_products);
            $number = 0;
            while($row = mysqli_fetch_assoc($result)){
                $product_id = $row['product_id'];
                $product_name = $row['product_name'];
                $product_image = $row['product_image'];
                $product_price = $row['product_price'];
                $number++;
             ?>   
                    <tr>
                        <td><?php echo $number?></td>
                        <td><?php echo $product_name?></td>
                        <td><img src='./product_images/<?php echo $product_image?>'></td>
                        <td><?php echo $product_price?></td>
                        <td><?php
                                $get_count = "SELECT * 
                                              from `orders_pending`
                                              where product_id =$product_id";
                                $result_count = mysqli_query($con,$get_count);
                                $rows_count =mysqli_num_rows($result_count);
                                echo $rows_count;

                            ?></td>
                        <td><a href='admin.php?edit_products=<?php echo $product_id?>'><i class='fa-solid fa-pen-to-square'></i></a></td>
                        <td><a href='admin.php?delete_products=<?php echo $product_id?>'><i class='fa-solid fa-trash'></i></a></td>
                    </tr>
            <?php 
            } 
            ?>

            
        </tbody>
    </table>
</body>
</html>