<?php
  	include_once 'config.php';
  	$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (mysqli_connect_errno($con)){  
	   echo "Failed to connect to MySQL: " . mysql_connect_error();
	}

	function han($s){ return reset(json_decode('{"s":"'.$s.'"}')); }
	function to_han($str) { return preg_replace('/(\\\u[a-f0-9]+)+/e','han("$0")',$str); }

	$num = $_POST['boardNumber'];

	$res = mysqli_query($con, "SELECT * FROM review WHERE num = '$num'");

	$result = array();

	while($row = mysqli_fetch_array($res)){
	   array_push($result,  
	   array('id'=>$row[0],'writeDate'=>$row[1],'score'=>$row[2], 'contents'=>$row[3]));
	}

	if($result){
	   //echo json_encode(array("result"=>$result));

	   $encode = json_encode(array("reviewResult"=>$result));
	   print(to_han($encode)); 
	   mysqli_close($con);
	}else{  
	   echo '리뷰가 없습니다.';
	}  

  	mysqli_close($con);
?>