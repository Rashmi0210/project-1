<?php
$servername = "agroserver.mysql.database.azure.com"; // Replace with your server name
$username = "bhumi@agroserver"; // Replace with your username
$password = "Agriculture1234"; // Replace with your password
$dbname = "bhumi"; // Replace with your database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM details"; // Replace 'details' with your actual table name
$result = mysqli_query($conn, $sql);
echo ' <span style="font-family: verdana, geneva, sans-serif;"><!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8" />
      <link rel="stylesheet" href="orders_list.css">
      <title>Users</title>
      <link rel="stylesheet" href="admin.css" />
      <!-- Font Awesome Cdn Link -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    </head>
    <body>
      <div class="container">
        <nav>
          <ul>
            <li><a href="#" class="logo">
              <img src="https://i.imgur.com/oRhEAUj.jpg">
              <span class="nav-item">Products</span>
            </a></li>
            <li><a href="admin.html">
              <i class="fas fa-menorah"></i>
              <span class="nav-item">Dashboard</span>
            </a></li>
            <li><a href="admin_products.php">
              <i class="fas fa-comment"></i>
              <span class="nav-item">products</span>
            </a></li>
            <li><a href="orders_list.php">
              <i class="fas fa-database"></i>
              <span class="nav-item">orders</span>
            </a></li>
            <li><a href="admin_users.php">
              <i class="fas fa-chart-bar"></i>
              <span class="nav-item">Users</span>
            </a></li>
            <li><a href="#">
              <i class="fas fa-cog"></i>
              <span class="nav-item">Add Products</span>
            </a></li>
          </ul>
        </nav>
    
    
        <section class="main">
          <div class="main-top">
            <h1>Users</h1>
            <i class="fas fa-user-cog"></i>
          </div>
          <div class="users">';
          echo "<p></p>";
          echo "<p></p>";
          echo '<table border="1" cellpadding="10" cellspacing="0">';
echo '<thead>';
echo '<tr>';
echo '<th>name</th>';
echo '<th>number</th>';
echo '<th>address</th>';
echo '<th>area</th>';
echo '<th>pincode</th>';
echo '<th>email</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';

if (mysqli_num_rows($result) >  0) {
    // Output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row["name"] . '</td>';
        echo '<td>' . $row["number"] . '</td>';
        echo '<td>' . $row["address"] . '</td>';
        echo '<td>' . $row["area"] . '</td>';
        echo '<td>' . $row["pincode"] . '</td>';
        echo '<td>' . $row["email"] . '</td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="5">No results found.</td></tr>';
}
echo "</div>";
echo '</body>';
echo '</table>';
echo '</body>';
echo '</html>';

mysqli_close($conn);
?>
