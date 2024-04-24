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
 
// Now you can proceed with your database queries

if(isset($_GET["id"])){
    $product_id = $_GET["id"];
    $sql = "SELECT * FROM cart WHERE product_id = $product_id";
    $result = $con->query($sql);
    $total_cart = "SELECT * FROM cart";
    $total_cart_result = $con->query($total_cart);
    $cart_num = mysqli_num_rows($total_cart_result);

    if(mysqli_num_rows($result) > 0){
        $in_cart = "already In cart";

        echo json_encode(["num_cart"=>$cart_num,"in_cart"=>$in_cart]);
    }else{
        $insert = "INSERT INTO cart(product_id) VALUES($product_id)";
        if($con->query($insert) === true){
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

    if($con->query($sql) === TRUE){
        echo "Removed from cart";
    }
}

?>
