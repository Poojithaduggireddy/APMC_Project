<?php
	$lot_id = $_POST['lot_id'];
	$shop_id = $_POST['shop_id'];
	$mos = $_POST['mos'];
	$cos = $_POST['cos'];
	$wos = $_POST['wos'];
	$aos = $_POST['aos'];
	$was = $_POST['was'];
	$wbs = $_POST['wbs'];
	$tnb = $_POST['tnb'];

	// Database connection
	$conn = new mysqli('localhost','root','','groundnut');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		$stmt = $conn->prepare("insert into samples_data(lot_id,shop_id, mos, cos, wos, aos,was,wbs,tnb) values(?,?,?,?,?, ?, ?, ?, ?)");
		$stmt->bind_param("iiisiiiii", $lot_id,$shop_id, $mos, $cos, $wos, $aos,$was,$wbs, $tnb);
		$execval = $stmt->execute();
		if($execval) {
			header("Location: APMCAgent.html"); 
			exit();
		}
		//echo $execval;
		$stmt->close();
		$conn->close();
	}
?>