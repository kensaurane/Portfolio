<?php
session_start();
include('db.php');

if (isset($_SESSION['logged_in'])) {
    // Check user control if admin has logged in
    if ($_SESSION['user_type'] === 'A') {
        header('location: admin/index.php');
        exit;
    } else {
        header('location: account.php');
        exit;
    }
}

if (isset($_POST['login_btn'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $stmt = $conn->prepare("SELECT user_id, user_fullname, email_add, username, password, user_type FROM user WHERE email_add=? LIMIT 1");
    $stmt->bind_param('s', $email);

    if ($stmt->execute()) {
        $stmt->bind_result($user_id, $user_fullname, $email_add, $username, $password, $user_type);
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            $stmt->fetch();

            // Verify password
            if (password_verify($pass, $password)) {
                // Proceed with Login user
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_fullname'] = $user_fullname;
                $_SESSION['email_add'] = $email_add;
                $_SESSION['username'] = $username;
                $_SESSION['user_type'] = $user_type;
                $_SESSION['logged_in'] = true;

                // Check user control
                if ($user_type === 'A') {
                    header('location: admin/index.php');
                    exit;
                } else {
                    header('location: account.php?message=Logged in Successfully');
                    exit;
                }
            } else {
                // Incorrect password
                header('location: login.php?error=Incorrect Password');
                exit;
            }
        } else {
            // User not found
            header('location: login.php?error=Could not Verify Account');
            exit;
        }
    } else {
        // Database query error
        header('location: login.php?error=Something went Wrong');
        exit;
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>

        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            max-width: 400px;
            width: 100%;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: black;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .register-link {
            margin-top: 15px;
            display: block;
            color: #555;
            text-decoration: none;
        }

        .register-link:hover {
            text-decoration: underline;
        }

        .wrapper {
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
        }
        
        body {
        background-image: url('assets/img/bg.jpg');
        }

        #login-form #login-btn{
    background-color: black;
    color: #fff;
    }
    </style>
</head>
<body>

       <!--Login-->
       <section class="my-5 py-5">
       <div class="wrapper">
         <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Login</h2>
            <hr class="mx-auto">
         </div>
         <div class="mx-auto container">
            <form id="login-form" method="POST" action="login.php">
              <p style="color:red" class="text-center"><?php if(isset($_GET['error'])){ echo $_GET['error'];}?></p>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control " id="login-email" name="email" placeholder="Email" required/>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" id="login-password" name="password" placeholder="Password" required/>
                </div>
                <div class="form-group"> 
                    <input type="submit" class="btn" id="login-btn" name="login_btn" value="Login"/>
                </div>
                <div class="form-group">
                    <a id="register-url" href="register.php" class="btn">Dont have an account? Register</a>
                </div>
            </form>
         </div>
       </section>
</body>
</html>