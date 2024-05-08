<?php
    $farmer_id= $_POST['farmer_id'];
	$farmer_name= $_POST['farmer_name'];
    $village_name= $_POST['village_name'];
    $man_dis= $_POST['man_dis'];
    $phn= $_POST['phn'];
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
		$stmt = $conn->prepare("insert into farmer_data(farmer_id,farmer_name,village_name,man_dis,phn, mos, cos, wos, aos,was,wbs, tnb) values(?,?,?,?,?, ?, ?, ?, ?, ?,?,?)");
		$stmt->bind_param("isssiisiiiii", $farmer_id,$farmer_name,$village_name,$man_dis,$phn, $mos, $cos, $wos, $aos,$was,$wbs, $tnb);
		$execval = $stmt->execute();
		if($execval) {
			header("Location: Farmer.html"); 
			exit();
		}
		//echo $execval;
		$stmt->close();
		$conn->close();
	}
?>