<?php
	include_once 'config.php';
	$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (mysqli_connect_errno($con)){
	   echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	function han($s){ return reset(json_decode('{"s":"'.$s.'"}')); }
	function to_han($str) { return preg_replace('/(\\\u[a-f0-9]+)+/e','han("$0")',$str); }

	$num = $_POST['num'];

	$result = mysqli_query($con, "UPDATE notes SET read_recv='읽음' WHERE num='$num'");

	if($result){  
	  	echo 'success';
	}else{  
	    echo 'failure';  
	}  

	mysqli_close($con);  
?>