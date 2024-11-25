<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
    <style>

    .delete {
        padding: 50px 0;
        border-radius: 10px;
    }

    .delete .container {
        max-width: 600px;
        margin: 0 auto;
        background-color:black;
        color: white;
        padding: 50px;
        align-items: center;
    }

    input[type='submit'] {
    width: 400px;
    padding: 20px;
    background-color: #201e1e;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin: 20px;
    align-items: center;
    }

    input[type='submit']:hover{
        background-color: #000000; 
        color: red;
        box-shadow: 2px 2px 2px 2px rgb(141, 25, 25);
    }
    </style>
</head>
<body>
    <h3>Delete Your Account</h3>
    <div class="delete">
        <div class="container">
            <form action="" method="post">
                <div class="form-group">
                    <input type="submit" name="delete" value="Delete Account">
                </div>

                <div class="form-group">
                    <input type="submit" name="dont_delete" value="Don't Delete Account">
                </div>
            </form>
        </div>
    </div>

    <?php
        $username_session= $_SESSION['user_username'];
        if(isset($_POST['delete'])){
            $delete_query = "DELETE
                             FROM `customers`
                             where customer_name = '$username_session' ";
            $result = mysqli_query($con,$delete_query);
            if($result){
                session_destroy();
                echo "<script> alert('Account Deleted successfully')</script>";
                echo "<script>window.open('../products.php','_self')</script>";
            }
        }

        if(isset($_POST['dont_delete'])){
                echo "<script>window.open('profile.php','_self')</script>";
        }
    ?>
</body>
</html>