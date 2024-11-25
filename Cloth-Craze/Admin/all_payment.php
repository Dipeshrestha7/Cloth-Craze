<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Payment</title>
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
    <h1>All Payment</h1>
    <table>
        <thead>

        <?php
        
        $get_payment = "SELECT * 
                       from `user_payment`";
        $result_payment= mysqli_query($con,$get_payment);
        $row_count = mysqli_num_rows($result_payment);

        

            if($row_count==0){
                echo"<h2>No paymnet received Yet</h2>";
            }
            else{
                echo "<tr>
                    <th>S No.</th>
                    <th>Invoice number</th>
                    <th>Amount</th>
                    <th>Payment Mode</th>
                    <th>Payment Date</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>";

                $numner =0;
                while($row_data=mysqli_fetch_assoc($result_payment)){
                    $order_id = $row_data['order_id'];
                    $payment_id = $row_data['payment_id'];
                    $amount = $row_data['amount'];
                    $payment_date = $row_data['payment_date'];
                    $payment_mode = $row_data['payment_mode'];
                    $invoice_number = $row_data['invoice_number'];
                    $numner++;

                    echo "  <tr>
                                <td>$numner</td>
                                <td>$invoice_number</td>
                                <td>$amount</td>
                                <td>$payment_mode</td>
                                <td>$payment_date</td>
                                <td><a href='admin.php?delete_payment=$payment_id'><i class='fa-solid fa-trash'></i></a></td>
                            </tr>";

                }


            }
        ?>
            
            
        </tbody>
    </table>
</body>
</html>