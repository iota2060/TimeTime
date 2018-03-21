<?php  
  	include_once 'config.php';
  	$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  
	if (mysqli_connect_errno($con)){  
	   echo "Failed to connect to MySQL: " . mysqli_connect_error();  
	}  

	$id = $_POST['id'];  
	$password = $_POST['password'];  

	$result = mysqli_query($con,"SELECT * FROM userjoin WHERE id = '$id' AND password = '$password';");  
	$check = mysqli_fetch_array($result);
			
	if(isset($check)){
		echo "success";
	}else{
		echo "Invalid Username or Password";
	}
	  
	mysqli_close($con);  
?>
