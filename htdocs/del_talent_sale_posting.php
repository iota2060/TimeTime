<?php
  include_once 'config.php';
  $con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  if (mysqli_connect_errno($con)){  
     echo "Failed to connect to MySQL: " . mysql_connect_error();
  }

  $boardNumber = $_POST['boardNumber'];

  $result = mysqli_query($con, "DELETE FROM talent_sale_posting WHERE boardNumber='$boardNumber'");

  if($result){
    echo 'success';
    $result = mysqli_query($con,"SELECT TABLE_ROWS FROM information_schema.tables WHERE table_name='talent_sale_posting'");
    $total_rows = mysqli_num_rows($result);
    mysqli_query($con,"ALTER TABLE talent_sale_posting AUTO_INCREMENT=1");
    mysqli_query($con,"SET @COUNT = 0");
    mysqli_query($con,"UPDATE talent_sale_posting SET talent_sale_posting.boardNumber = @COUNT:=@COUNT+1");
    mysqli_query($con,"ALTER TABLE talent_sale_posting AUTO_INCREMENT='$total_rows'");
  }else{
    echo 'failure';
  }

  mysqli_close($con);  
?>