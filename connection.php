<?php

// Initialize MySQLi
$con = mysqli_init();

// Connect to MySQL server without SSL/TLS
mysqli_real_connect(
    $con,
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

// Check if 'id' parameter is set in the URL
if(isset($_GET["id"])){
    // Sanitize the input
    $product_id = mysqli_real_escape_string($con, $_GET["id"]);

    // Prepare and execute SELECT query
    $sql = "SELECT * FROM cart WHERE product_id = '$product_id'";
    $result = mysqli_query($con, $sql);
    $total_cart_result = mysqli_query($con, "SELECT * FROM cart");
    $cart_num = mysqli_num_rows($total_cart_result);

    // Check if product exists in cart
    if(mysqli_num_rows($result) > 0){
        $in_cart = "already In cart";
        echo json_encode(["num_cart"=>$cart_num,"in_cart"=>$in_cart]);
    }else{
        // Prepare and execute INSERT query
        $insert = "INSERT INTO cart(product_id) VALUES('$product_id')";
        if(mysqli_query($con, $insert)){
            $in_cart = "added into cart";
            echo json_encode(["num_cart"=>$cart_num,"in_cart"=>$in_cart]);
        }else{
            echo "<script>alert('It doesn't insert');</script>";
        }
    }
}

// Check if 'cart_id' parameter is set in the URL
if(isset($_GET["cart_id"])){
    // Sanitize the input
    $product_id = mysqli_real_escape_string($con, $_GET["cart_id"]);

    // Prepare and execute DELETE query
    $sql = "DELETE FROM cart WHERE product_id='$product_id'";
    if(mysqli_query($con, $sql)){
        echo "Removed from cart";
    }
}

?>
