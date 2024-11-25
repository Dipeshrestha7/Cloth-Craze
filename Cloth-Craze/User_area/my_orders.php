<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <style>
        /* Sign-up section styles */
        .signup {
            padding: 50px 0;
            border-radius: 10px;
        }

        .signup .container {
            width: 130vh;
            margin: 0 auto;
            background-color:black;
            color: white;
            padding: 20px;
        }

        .signup h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 175vh;
            background-color: #000000;
        }
        table thead{
            background-color: #201e1e;
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
<body id="main">

<?php
$username = $_SESSION['user_username'];
$get_user = "SELECT *
             from `customers`
             where customer_name = '$username'";
$result= mysqli_query($con,$get_user);
$row_fetch= mysqli_fetch_assoc($result);
$user_id = $row_fetch['customer_id'];


?>

<h2>All my Orders</h2>
    <section class="signup">
        <div class="container">
            <table>
                <thead>
                    <tr>
                        <th>SI no</th>
                        <th>Amount</th>
                        <th>Products Id</th>
                        <th>Invoice Number</th>
                        <th>Date</th>
                        <th>Complete/Incomplete</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $get_order_details = "SELECT * 
                                          from `orders`
                                          where customer_id = $user_id";
                    $result_order= mysqli_query($con,$get_order_details);
                    $number = 1;
                    while($row_orders = mysqli_fetch_assoc($result_order)){
                        $order_id = $row_orders['order_id'];
                        $amount_due = $row_orders['order_amount'];
                        $product_id = $row_orders['product_id'];
                        $Invoice_Number = $row_orders['invoice_number'];
                        $order_id = $row_orders['order_id'];
                        $order_status = $row_orders['order_status'];
                            if($order_status=='pending'){
                                $order_status='Incomplete';
                            }else{
                                $order_status='Complete';
                            }
                        $order_date = $row_orders['order_date'];
                        echo "<tr>
                        <td>$number</td>
                        <td>$amount_due</td>
                        <td>$product_id</td>
                        <td>$Invoice_Number</td>
                        <td>$order_date</td>
                        <td>$order_status</td>";
                        ?>
                        <?php
                            if($order_status=='Complete'){
                                echo"<td>Paid</td>";
                            }
                            else{
                                echo "<td><a href ='confirm_payment.php?order_id=$order_id'>Confirm</a></td>
                                </tr>";
                            }
                        
                    
                    $number++;
                    }                      
                    ?>
                    
                </tbody>
            </table>
            
        </div>
    </section>
  
</body>
</html>