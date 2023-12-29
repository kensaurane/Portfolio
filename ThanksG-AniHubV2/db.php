<?php
$host= 'localhost';
$dbname= 'sample1';
$username= 'root';
$password= '';

$conn = mysqli_connect($host, $username, $password, $dbname);

if(!$conn){
    die();
}
else{
    //echo "connection established." . "<br>";
}

if (isset($_POST['submit'])) {
    // Your registration code here...
}
?>
