<?php
include('../database/connect.php');
session_start();

if (isset($_SESSION['admin_username'])) {
    echo "<script>window.open('admin.php','_self')</script>";
}

if (isset($_POST['submit'])) {
    $admin_username = $_POST['admin_username'];
    $admin_password = $_POST['admin_password'];

    $select_query = "SELECT * FROM `admin` WHERE admin_name = '$admin_username'";
    $result = mysqli_query($con, $select_query);
    $row_count = mysqli_num_rows($result);
    $row_data = mysqli_fetch_assoc($result);

    if ($row_count > 0) {
        if (password_verify($admin_password, $row_data['admin_password'])) {
            $_SESSION['admin_username'] = $admin_username;
            echo "<script>alert('Login successful')</script>";
            echo "<script>window.open('admin.php','_self')</script>";
        } else {
            echo "<script>alert('Incorrect Password')</script>";
        }
    } else {
        echo "<script>alert('Incorrect Username')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
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

        /* Login section styles */
        .login {
            background-image: url("../images/bgBLACK.webp");
            padding: 50px 0;
        }

        .login .container {
            border: 2px solid white;
            color: white;
            max-width: 400px;
            margin: 0 auto;
            background-color: #000000;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .login h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group select {
            width: 50%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #201e1e;
            color: white;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            margin: 10px 30%;
            padding: 10px 20px;
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

        p {
            text-align: center;
            margin-top: 20px;
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
            margin-top: 130px;
            background-image: url("../images/bgBLACK.webp");
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
    <section class="login">
        <div class="container">
            <h2>Admin Login</h2>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="admin_username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="admin_password" required>
                </div>
                <div class="form-group">
                    <button type="submit" name="submit">Login</button>
                </div>
            </form>
            <p>Don't have an account? <a href="admin_reg_form.php">Register</a></p>
        </div>
    </section>
    <footer>
        <p>&copy; 2024 Cloth Craze. All rights reserved.</p>
    </footer>
</body>
</html>
