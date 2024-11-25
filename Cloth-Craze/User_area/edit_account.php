<?php 
if(isset($_GET['edit_account'])){
    $user_session_name = $_SESSION['user_username'];
    $select_query = "SELECT * 
                     from `customers`
                     where customer_name = '$user_session_name'";
    $result_query = mysqli_query($con,$select_query);
    $row_fetch = mysqli_fetch_assoc($result_query);
    $user_id =$row_fetch['customer_id'];
    $user_name =$row_fetch['customer_name'];
    $user_email =$row_fetch['customer_email'];
    $user_address =$row_fetch['customer_address'];
    $user_number =$row_fetch['customer_number'];
}
        if(isset($_POST['update'])){
            $update_id = $user_id;
            $user_name =$_POST['username'];
            $user_email =$_POST['email'];
            $user_address =$_POST['address'];
            $user_number =$_POST['pnumber'];
            $user_image = $_FILES['image']['name'];
            $user_image_tmp = $_FILES['image']['tmp_name'];

            move_uploaded_file($user_image_tmp,"./user_images/$user_image");

            $update_data = "UPDATE `customers`
                            set customer_name = '$user_name', customer_email = '$user_email', customer_address = '$user_address',
                                customer_number ='$user_number', customer_image ='$user_image'
                            where customer_id =$update_id"; 
            $result_query_update = mysqli_query($con,$update_data);
            if($result_query_update){
                echo " <script>alert('Data Updated successfully')</script>";
                echo " <script>window.open('user-logout.php','_self')</script>";
            }
        }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account</title>
    <style>
        /* Sign-up section styles */
.signup {
    padding: 50px 0;
    border-radius: 10px;
}

.signup .container {
    max-width: 600px;
    margin: 0 auto;
    background-color:black;
    color: white;
    padding: 20px;
}

.signup h2 {
    text-align: center;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="text"],
input[type="email"],
input[type="password"],
input[type="cpassword"],
input[type="file"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.form-group img{
    width: 100px;
    height: 100px;
    object-fit: contain;
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
<h2>Edit Account</h2>
    <section class="signup">
        <div class="container">
            
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" value="<?php echo $user_name?>" placeholder="Enter your name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo $user_email?>" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="email">Image</label>
                    <input type="file" id="image" name="image" required>
                    <img src="./user_images/<?php echo $user_image?>" alt="">
                </div>
                <div class="form-group">
                    <label for="pnumber">Phone Number:</label>
                    <input type="text" id="pnumber" name="pnumber" value="<?php echo $user_number?>" placeholder="Enter your Phone Number" required>
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" value="<?php echo $user_address?>" placeholder="Enter your Address" required>
                </div>
                <div class="form-group">
                    <button type="submit" name="update">Update</button>
                </div>
               
            </form>
        </div>
    </section>
  
</body>
</html>