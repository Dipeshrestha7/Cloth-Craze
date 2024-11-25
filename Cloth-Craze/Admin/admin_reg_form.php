<?php
include('../database/connect.php');
// include('../function/common_function.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <style>
        /* Reset styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-image: url("../images/bgBLACK.webp");
        }

        /* Sign-up section styles */
        .signup {
            padding: 50px 0;
            background-image: url("/images/bgBLACK.webp");
        }

        .signup .container {
            border: 2px solid white;
            max-width: 600px;
            margin: 0 auto;
            background-color: black;
            color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
        input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            margin: 10px 35%;
            padding: 10px 50px;
            background-color: #201e1e;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #000000;
            color: red;
            box-shadow: 2px 2px 2px 2px rgb(141, 25, 25);
        }

        p a {
            color: white;
            text-decoration: none;
            transition: 200ms;
        }

        p a:hover {
            color: rgb(141, 25, 25);
            text-decoration: 2px underline rgb(141, 25, 25);
        }

        /* Footer styles */
        footer {
            background-image: url("/images/bgBLACK.webp");
            color: #fff;
            text-align: center;
            padding: 20px 0;
        }

        footer:hover {
            color: rgb(141, 25, 25);
        }
    </style>
</head>
<body id="main">

<section class="signup">
    <div class="container">
        <h2>Admin Registration</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Enter your name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" id="image" name="image" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="cpassword">Confirm Password:</label>
                <input type="password" id="cpassword" name="cpassword" placeholder="Confirm your password" required>
            </div>
            <div class="form-group">
                <button type="submit" name="submit">Register</button>
            </div>
            <p>Already have an account? <a href="admin_login.php">Login</a></p>
        </form>
    </div>
</section>

<script>
        function validateForm() {
            const password = document.getElementById('password').value;
            const cpassword = document.getElementById('cpassword').value;
            const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;

            if (!passwordRegex.test(password)) {
                alert('Password must be at least 8 characters long and contain at least one letter, one number, and one special character.');
                return false;
            }

            if (password !== cpassword) {
                alert('Passwords do not match.');
                return false;
            }

            return true;
        }
    </script>


<footer>
    <p>&copy; 2024 Cloth Craze. All rights reserved.</p>
</footer>

<!-- php code -->
<?php
if (isset($_POST['submit'])) {
    $admin_username = $_POST['username'];
    $admin_email = $_POST['email'];
    $admin_password = $_POST['password'];
    $admin_cpassword = $_POST['cpassword'];
    $hash_password = password_hash($admin_password, PASSWORD_DEFAULT);

    $admin_image = $_FILES['image']['name'];
    $admin_image_tmp = $_FILES['image']['tmp_name'];

    // Check if email already exists
    $select_query = "SELECT * FROM `admin` WHERE admin_email = '$admin_email'";
    $result = mysqli_query($con, $select_query);
    $rows_count = mysqli_num_rows($result);
    
    if ($rows_count > 0) {
        echo "<script>alert('Email is already in use')</script>";
    } else if ($admin_password != $admin_cpassword) {
        echo "<script>alert('Passwords do not match')</script>";
    } else if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/', $admin_password)) {
        echo "<script>alert('Password must be at least 8 characters long and contain at least one letter, one number, and one special character.')</script>";
    } else {
        // Move uploaded file and insert into database
        move_uploaded_file($admin_image_tmp, "./admin_images/$admin_image");
        $insert_query = "INSERT INTO `admin` (admin_name, admin_email, admin_password, admin_image)
                         VALUES ('$admin_username', '$admin_email', '$hash_password', '$admin_image')";
        $sql_execute = mysqli_query($con, $insert_query);
        
        if ($sql_execute) {
            echo "<script>alert('ID created successfully')</script>";
            echo "<script>window.open('admin_login.php', '_self')</script>";
        } else {
            die(mysqli_error($con));
        }
    }
}
?>
</body>
</html>
