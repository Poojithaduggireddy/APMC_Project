<?php
	$name = $_POST['name'];
	$lot_id = $_POST['lot_id'];
	$wos = $_POST['wos'];
	$price = $_POST['price'];

	// Database connection
	$conn = new mysqli('localhost','root','','groundnut');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		$stmt = $conn->prepare("insert into winners_data(name,lot_id,wos,price) values(?, ?, ?, ?)");
		$stmt->bind_param("siii",$name, $lot_id,$wos, $price);
		$execval = $stmt->execute();
		if($execval) {
			header("Location: manager.html"); 
			exit();
		}
		//echo $execval;
		$stmt->close();
		$conn->close();
	}
?>