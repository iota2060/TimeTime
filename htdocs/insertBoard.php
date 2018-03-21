<?php  
  include_once 'config.php';
  $con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  
  if (mysqli_connect_errno($con)){  
     echo "Failed to connect to MySQL: " . mysqli_connect_error();  
  }  

  $id = urldecode($_POST['id']); 
  $title = urldecode($_POST['title']);
  $dayResult = urldecode($_POST['dayResult']); 
  $writeDate = urldecode($_POST['writeDate']); 
  $type = urldecode($_POST['type']); 
  $startHour = urldecode($_POST['startHour']);
  $endHour = urldecode($_POST['endHour']);
  $category = urldecode($_POST['category']);
  $talent = urldecode($_POST['talent']);
  $contents = urldecode($_POST['contents']);

  $imgCheck;
  $file_path = "uploads/"; 
  $file_path = $file_path . basename( $_FILES['uploaded_file']['name']);

  if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $file_path)) {
    $imageCheck = 1;
  }else{
    $imageCheck = 0;
  }

  if($imageCheck){
    $result = mysqli_query($con,"
      INSERT INTO talent_sale_posting (
        id, title, dayResult, gender, writeDate, type, major, subMajor, 
        startHour, endHour, category, talent, contents, filePath
      ) 
    VALUES (
      '$id', '$title', '$dayResult', (SELECT gender FROM userjoin WHERE userjoin.id = '$id'),
      '$writeDate', '$type', (SELECT major FROM userjoin WHERE userjoin.id = '$id'),
      (SELECT subMajor FROM userjoin WHERE userjoin.id = '$id'),
      '$startHour', '$endHour', '$category', '$talent', '$contents', '$file_path')
    ");
  }else{
    $result = mysqli_query($con,"
      INSERT INTO talent_sale_posting (
        id, title, dayResult, gender, writeDate, type, major, subMajor,
        startHour, endHour, category, talent, contents
      ) 
    VALUES (
      '$id', '$title', '$dayResult', (SELECT gender FROM userjoin WHERE userjoin.id = '$id'),
      '$writeDate', '$type', (SELECT major FROM userjoin WHERE userjoin.id = '$id'),
      (SELECT subMajor FROM userjoin WHERE userjoin.id = '$id'),
      '$startHour', '$endHour', '$category', '$talent', '$contents')
    ");
  }

  if($result){  
    echo 'success'; 
    $result = mysqli_query($con,"SELECT TABLE_ROWS FROM information_schema.tables WHERE table_name='talent_sale_posting'");
    $total_rows = mysqli_num_rows($result); 
    mysqli_query($con,"ALTER TABLE talent_sale_posting AUTO_INCREMENT = 1");
    mysqli_query($con,"SET @COUNT = 0");
    mysqli_query($con,"UPDATE talent_sale_posting SET talent_sale_posting.boardNumber = @COUNT:=@COUNT+1");
    mysqli_query($con,"ALTER TABLE talent_sale_posting AUTO_INCREMENT='$total_rows'");
  }else{  
    echo 'failure';  
  }
    
  mysqli_close($con);
?>
