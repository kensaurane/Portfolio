
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">

    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

    <link rel="stylesheet" href="styles.css">
    
</head>
<body>
    
  

 
<!--register-->
<
<style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .wrapper {
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
        }

        .inner {
            max-width: 400px;
            width: 100%;
        }

        #register_form {
            text-align: center;
        }

        h3 {
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-wrapper {
            margin-bottom: 10px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        .form-control {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
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
    
       body {
       background-image: url('assets/img/bg.jpg');
       }
       .register-link:hover {
            text-decoration: underline;
        }

    </style>
 
    
    
 <!--Register-->
 <section class="my-5 py-5">
 <div class="wrapper">
        <div class="container text-center mt-3 pt-5">
           <h2 class="form-weight-bold">Register Here</h2>
           <hr class="mx-auto">
        </div>
        <div class="mx-auto container">
        <div class="wrapper">
           <form id="register-form" action="registration.php" method="post">
            <p style="color:red;"><?php if(isset($_GET['error'])){ echo $_GET['error'];} ?></p>
    <div class="form-group">
        <label>Name</label>
        <input type="text" class="form-control" id="register-name" name="register_name" placeholder="Name" required/>
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="text" class="form-control" id="register-email" name="register_email" placeholder="Email" required/>
    </div>
    <div class="form-group">
        <label>Username</label>
        <input type="text" class="form-control" id="register-password" name="register_username" placeholder="Username" required/>
    </div>

    <div class="form-group">
        <label>Password</label>
        <input type="password" class="form-control" id="register-password" name="register_password" placeholder="Password" required/>
    </div>
    <div class="form-group">
        <label>Confirm Password</label>
        <input type="password" class="form-control" id="register-confirm-password" name="register_confirm_password" placeholder="Confirm Password" required/>
    </div>
    <div class="form-group">
        <input type="submit" name="submit" class="btn" id="register-btn" value="Register"/>
    </div>
    <div class="form-group">
        <a id="login-url" href="login.php" class="btn">Do you have an account? Login</a>
    </div>   
</form>
        </div>
      </section>

    
    

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    </body>
    <html>