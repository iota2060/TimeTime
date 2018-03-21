<?php  
  	include_once 'config.php';
  	$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  
	if (mysqli_connect_errno($con)){  
	   echo "Failed to connect to MySQL: " . mysqli_connect_error();  
	} 
	
	$id = $_POST['id'];  
	$password = $_POST['password'];  
	$name = $_POST['name']; 
	$phone = $_POST['phone']; 
	$birth = $_POST['birth']; 
	$gender = $_POST['gender'];
	$major = $_POST['major'];
	$subMajor = $_POST['subMajor'];
	$token= $_POST["token"];

	$result = mysqli_query($con,"
		INSERT INTO userjoin (id,password,name,phone,birth,gender,major,subMajor,token)
	    VALUES ('$id','$password','$name','$phone','$birth','$gender','$major','$subMajor','$token')
	");  

	if($result){  
		echo 'success';  
	}else{  
	    echo 'failure';  
	}  
  
	mysqli_close($con);  
?>
