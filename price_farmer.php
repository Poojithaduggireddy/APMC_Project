<?php
// update_price.php

// Database connection (replace with your credentials)
$conn = new mysqli('localhost','root','','groundnut');
if($conn->connect_error){
  echo "$conn->connect_error";
  die("Connection Failed : ". $conn->connect_error);
} else {
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Update price based on form submission
    $farmer_id = $_POST['farmer_id'];
    $price = $_POST['price'];
    $sql_update = "UPDATE farmer_data SET price='$price' WHERE farmer_id=$farmer_id";
    if ($conn->query($sql_update) === TRUE) {
      echo "Price updated successfully for Farmer_id: $farmer_id";
    } else {
      echo "Error updating price: " . $conn->error;
    }
  }

  $conn->close();
}
?>
