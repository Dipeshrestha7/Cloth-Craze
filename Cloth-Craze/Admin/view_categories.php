

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View-Categories</title>
    <style>
        h1{
            margin: 50px;
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

    </style>
</head>
<body>
    <h1>All Categories</h1>
    <table>
        <thead>
            <tr>
                <th>S No.</th>
                <th>Category Name</th>
                <th>Category Image</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <?php
        $select_cat ="SELECT *
                      from `product_category`";
        $result_cat =mysqli_query($con,$select_cat);
        $number =0;
        while($row =mysqli_fetch_assoc($result_cat)){
            $category_id = $row['category_id'];
            $category_name = $row['category_name'];
            $category_image = $row['category_image'];
            $number++;
        
        ?>

        <tbody>
            <tr>
                <td><?php echo $number?></td>
                <td><?php echo $category_name?></td>
                <td><img src='./product_images/<?php echo $category_image?>'></td>
                <td><a href='admin.php?edit_categories=<?php echo $category_id?>'><i class='fa-solid fa-pen-to-square'></i></a></td>
                <td><a href='admin.php?delete_categories=<?php echo $category_id?>'><i class='fa-solid fa-trash'></i></a></td>
            </tr>
        <?php
         }   
            ?>
        </tbody>
    </table>
</body>
</html>