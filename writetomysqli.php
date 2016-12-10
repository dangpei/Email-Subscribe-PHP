<?php
	$email = $_GET["email"];
	date_default_timezone_set('PRC');
	$time = time();
	$formateTime = date("Y-m-d H:i:s",$time);
	$con=mysqli_connect("localhost","root","","kedaoindex"); 
	$results = $con->query("select COUNT(*) from `subscribe_email` where `email`='{$email}'");
	$row = $results->fetch_array();
	if(intval($row[0])==0)
		$results = $con->query("INSERT INTO `subscribe_email` (email,datetime,other) VALUES ('{$email}','{$formateTime}','null')");
	mysqli_close($con);
	echo "Good ".$row[0];
?>