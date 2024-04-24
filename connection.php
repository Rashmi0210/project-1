<?php

//lets make a connection with Addtocart database



 $con = mysqli_init();
// mysqli_ssl_set($con,NULL,NULL, "new", NULL, NULL);
 mysqli_real_connect($con, "agroserver.mysql.database.azure.com", "bhumi", "Agriculture1234", "bhumi", 3306, MYSQLI_CLIENT_SSL);


$mysqli = new mysqli('agroserver.mysql.database.azure.com', 'bhumi', 'Agriculture1234', 'bhumi');
 
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
 
// Set up SSL options
//$mysqli->ssl_set('path_to_client_key.pem', 'path_to_client_cert.pem', 'path_to_ca_cert.pem', NULL, NULL);
 
// Attempt to connect with SSL
$mysqli->real_connect('agroserver.mysql.database.azure.com', 'bhumi', 'Agriculture1234', 'bhumi');
 
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
 
echo "Connected successfully";
 
// Now you can proceed with your database queries


if(isset($_GET["id"])){
    $product_id = $_GET["id"];
    $sql = "SELECT * FROM cart WHERE product_id = $product_id";
    $result = $conn->query($sql);
    $total_cart = "SELECT * FROM cart";
    $total_cart_result = $conn->query($total_cart);
    $cart_num = mysqli_num_rows($total_cart_result);

    if(mysqli_num_rows($result) > 0){
        $in_cart = "already In cart";

        echo json_encode(["num_cart"=>$cart_num,"in_cart"=>$in_cart]);
    }else{
        $insert = "INSERT INTO cart(product_id) VALUES($product_id)";
        if($conn->query($insert) === true){
            $in_cart = "added into cart";
            echo json_encode(["num_cart"=>$cart_num,"in_cart"=>$in_cart]);
        }else{
            echo "<script>alert(It doesn't insert)</script>";
        }
    }
}

if(isset($_GET["cart_id"])){
    $product_id = $_GET["cart_id"];
    $sql = "DELETE FROM cart WHERE product_id=".$product_id;

    if($conn->query($sql) === TRUE){
        echo "Removed from cart";
    }
}

?>
