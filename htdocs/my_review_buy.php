<?php
	include_once 'config.php';
	$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (mysqli_connect_errno($con)){  
	   echo "Failed to connect to MySQL: " . mysql_connect_error();  
	}

	function han($s){ return reset(json_decode('{"s":"'.$s.'"}')); }
	function to_han($str) { return preg_replace('/(\\\u[a-f0-9]+)+/e','han("$0")',$str); }

	$id = $_POST['id'];

	$res = mysqli_query($con, "SELECT * FROM review_buy WHERE id='$id'");

	$result = array();

	while($row = mysqli_fetch_array($res)){
	   array_push($result,  
	   array('id'=>$row[0],'writeDate'=>$row[1],'score'=>$row[2], 'contents'=>$row[3], 'num'=>$row[4]
	   ));
	}

	if($result){
	   //echo json_encode(array("result"=>$result));
	   $encode = json_encode(array("reviewResult"=>$result));
	   print(to_han($encode)); 
	}else{  
	   echo '작성한 후기가 없습니다.';
	}  

	mysqli_close($con);  
?>