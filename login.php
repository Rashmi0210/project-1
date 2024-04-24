<?php
// Enable error reporting
ini_set('display_errors',  1);
ini_set('display_startup_errors',  1);
error_reporting(E_ALL);

// Include connection.php
include 'connection.php';

// Initialize MySQLi
$mysqli = mysqli_init();

// Connect to MySQL server without SSL/TLS
mysqli_real_connect(
    $mysqli,
    "agroserver.mysql.database.azure.com",
    "bhumi",
    "Agriculture1234",
    "bhumi",
    3306
);

// Check connection
if (mysqli_connect_errno()) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "Connected successfully";

// Check if the form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username and password from the form
    $username = $mysqli -> real_escape_string($conn,$_POST['username']); // Issue might be here
    $password = $mysqli -> real_escape_string($conn,$_POST['password']); // Issue might be here

    // Query to check if the username and password exist in the database
    $sql = "SELECT * FROM users WHERE username = '$username' and password = '$password'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    // If user exists, set session and redirect to home page
    if($count == 1) {
        $_SESSION['username']=$username;
        header("Location: ../project/Home Page.php");
        exit(); // It's good practice to exit after redirection to prevent further execution
    } else {
        echo "Your Login Name or Password is invalid";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Log In</title>
<link rel="stylesheet" href="login1.css">
</head>
<body>
<div class="main">
<div class="container">
<div class="heading">Sign In</div>
<form class="form" action="login.php" method="post">
<input
                    placeholder="E-mail"
                    id="username"
                    name="username"
                    type="username"
                    class="input"
                    required=""
                />
<input
                    placeholder="Password"
                    id="password"
                    name="password"
                    type="password"
                    class="input"
                    required=""
                />
<span class="forgot-password"><a href="#">Forgot Password ?</a></span>
<input value="Sign In" type="submit" class="login-button" />
</form>
<span class="agreement"><a href="regis1.html">Don't have an account</a></span>
</div>
</div> 
</body>
</html>
