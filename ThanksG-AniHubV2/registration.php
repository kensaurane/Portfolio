<?php 

session_start();

include('db.php');
if (isset($_POST['submit'])) {
	$name = $_POST['register_name'];
	$email = $_POST['register_email'];
	$username = $_POST['register_username'];
	$password = $_POST['register_password'];
	$confirmpassword = $_POST['register_confirm_password'];

	$duplicate = mysqli_query($conn, "SELECT * FROM user WHERE email_add = '$email'");

	if(mysqli_num_rows($duplicate) > 0){
		echo "<script> alert('Email is Already used'); </script>";
	} else {
		if($password == $confirmpassword){
			// Hash the password before storing it in the database
			$hashed_password = password_hash($password, PASSWORD_DEFAULT);
// Hash the password before storing it in the database
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Your database insertion code would look something like this
$query = "INSERT INTO user (`user_fullname`, `email_add`, `username`, `password`) VALUES ('$name', '$email', '$username', '$hashed_password')";

mysqli_query($conn, $query);


			echo "<script> alert ('Registration Successful'); </script>";
			header("Location: login.php");
			exit(); // Make sure to exit after redirection
		} else {
			echo "<script> alert ('Password Does Not Match'); </script>";
			
		}
	}
}
?>
