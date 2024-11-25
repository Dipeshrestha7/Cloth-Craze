<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Users</title>
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
    <h1>All Users</h1>
    <table>
        <thead>

        <?php
        
        $get_user = "SELECT * 
                       from `customers`";
        $result_users= mysqli_query($con,$get_user);
        $row_count = mysqli_num_rows($result_users);

        

            if($row_count==0){
                echo"<h2>No User Yet</h2>";
            }
            else{
                echo "<tr>
                    <th>S No.</th>
                    <th>Customer Name</th>
                    <th>Customer Email</th>
                    <th>Customer Image </th>
                    <th>Customer Address</th>
                    <th>Customer Number</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>";

                $numner =0;
                while($row_data=mysqli_fetch_assoc($result_users)){
                    $user_id = $row_data['customer_id'];
                    $user_name = $row_data['customer_name'];
                    $user_image = $row_data['customer_image'];
                    $user_email = $row_data['customer_email'];
                    $user_address = $row_data['customer_address'];
                    $user_number = $row_data['customer_number'];
                    $numner++;

                    echo "  <tr>
                                <td>$numner</td>
                                <td>$user_name</td>
                                <td>$user_email</td>
                                <td><img src='../User_area/user_images/$user_image'</td>
                                <td>$user_address</td>
                                <td>$user_number</td>
                                <td><a href='admin.php?delete_user=$user_id'><i class='fa-solid fa-trash'></i></a></td>
                            </tr>";

                }


            }
        ?>
            
            
        </tbody>
    </table>
</body>
</html>