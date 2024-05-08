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
    $lot_id = $_POST['lot_id'];
    $price = $_POST['price'];
    $sql_update = "UPDATE samples_data SET price='$price' WHERE lot_id=$lot_id";
    if ($conn->query($sql_update) === TRUE) {
      echo "Price updated successfully for LOTID: $lot_id";
    } else {
      echo "Error updating price: " . $conn->error;
    }
  }

  $conn->close();
}
?>
