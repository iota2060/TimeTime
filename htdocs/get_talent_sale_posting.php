<?php
  	include_once 'config.php';
  	$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (mysqli_connect_errno($con)){  
	   echo "Failed to connect to MySQL: " . mysqli_connect_error();  
	}  

	mysqli_set_charset($con,"utf8");

	$category=$_POST['category'];
	$talent=$_POST['talent'];

	function han($s){ return reset(json_decode('{"s":"'.$s.'"}')); }
	function to_han($str) { return preg_replace('/(\\\u[a-f0-9]+)+/e','han("$0")',$str); }

	$res = mysqli_query($con,"
		SELECT * 
		FROM talent_sale_posting 
		WHERE category='$category' AND talent='$talent' 
		ORDER BY writeDate DESC
	");

	$result = array();

	while($row = mysqli_fetch_array($res)){  
	  array_push($result,  
	    array('boardNumber'=>$row[0],'id'=>$row[1],'title'=>$row[2],'dayResult'=>$row[3],'gender'=>$row[4],'writeDate'=>$row[5],'type'=>$row[6],'major'=>$row[7],'subMajor'=>$row[8],'startHour'=>$row[9],'endHour'=>$row[10],'category'=>$row[11],'talent'=>$row[12],'contents'=>$row[13],'filePath'=>$row[14]));  
	}
	 
	$encode = json_encode(array("result"=>$result));
	print(to_han($encode)); 

	mysqli_close($con);
?>