<?php
	include 'header.php';
	include 'dbconn.php';
   if(isset($_FILES['image'])){
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
	  $a=explode('.',$_FILES['image']['name']);
      $imgi=end($a);
	  $file_ext=strtolower($imgi);
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if(empty($errors)==true){
		$dire="postsimg/";
		if (!is_dir($dire)) {
			mkdir($dire);         
		}
         move_uploaded_file($file_tmp,$dire.$file_name);
		 $status=$_POST['status_content'];
		$usname=$_SESSION['username'];
		$statement = $conn->prepare("SELECT * FROM `account` WHERE `username`='$usname'");
						$statement->execute();  
						$rows = $statement->fetchAll();
						$uid = $rows['0']['ID'];
						$date = new DateTime('now', new DateTimeZone("Asia/Kathmandu"));
						$datetime=$date->format('Y-m-d h:i:s');
			try{
				$conn->beginTransaction();
				$picfulladd=$dire.$file_name;
				$sql = "INSERT INTO posts (ID,postcontent,time,picadd) VALUES ('$uid','$status','$datetime','$picfulladd')";	
				$result= $conn->exec($sql);
				if($result)
				{
					echo '<center><h1><font color="green">Status Posted</font></h1></center>';
				}
				$conn->commit();
			}
			catch(PDOException $e)
			{
				$conn->rollback();
				echo "Connection failed:",$e->getMessage();
			}
		 
      }else{
         print_r($errors);
      }
   }
?>
<center>
      <div class="gallery">
      <form action="" method="POST" enctype="multipart/form-data">
		<br>
		<br>
		<p><h1>What's on your mind?</h1></p>
		<textarea name="status_content" rows=12 cols=100></textarea>
			</br>  </br>   
								
			<input type="file" name="image" /><br><br><br><br>
			<input type="submit" value="Upload and Post"/>
      </form>
	  </div>
	  </center>
