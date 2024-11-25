<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All-Orders</title>
    <style>
        h1{
            text-align: center;
        }

        h2{
            font-size: 50px;
            color: rgb(141, 25, 25);
            text-align: center;
            margin: 30px 30px;
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
    <h1>All Orders</h1>
    <table>
        <thead>

        <?php
        
        $get_orders = "SELECT * 
                       from `orders`";
        $result= mysqli_query($con,$get_orders);
        $row_count = mysqli_num_rows($result);

        

            if($row_count==0){
                echo"<h2>No Orders Yet</h2>";
            }
            else{
                echo "<tr>
                    <th>S No.</th>
                    <th>View Amount</th>
                    <th>Invoice number</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>";

                $numner =0;
                while($row_data=mysqli_fetch_assoc($result)){
                    $order_id = $row_data['order_id'];
                    $product_id = $row_data['product_id'];
                    $customer_id = $row_data['customer_id'];
                    $order_amount = $row_data['order_amount'];
                    $order_date = $row_data['order_date'];
                    $order_status = $row_data['order_status'];
                    $invoice_number = $row_data['invoice_number'];
                    $numner++;

                    echo "  <tr>
                                <td>$numner</td>
                                <td>$order_amount</td>
                                <td>$invoice_number</td>
                                <td>$order_date</td>
                                <td>$order_status</td>
                                <td><a href='admin.php?delete_order=$order_id'><i class='fa-solid fa-trash'></i></a></td>
                            </tr>";

                }


            }
        ?>
            
            
        </tbody>
    </table>
</body>
</html>