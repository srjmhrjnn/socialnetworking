<?php
	session_start();
	if(isset($_SESSION['username']))
	{
		echo "Logged in as :".$_SESSION['username'];
		
	}
	else{echo "Please Login";
	header('location:index.php');
	}
?>
<center>
<html>
<head>

	<link rel="stylesheet" type="text/css" href="styles/images.css">
	<title>Images</title>
	</head>
<body>
	<center>
		<div id="wrapper">
			<div class="header">
				
					<a href="homepage.php"><img src='images/sn.jpg' height=70 width=400 align="left" class="circle"></a>
					<a href="logout.php"><img src='images/logout.jpg' height=70 width=60 align="right" class="circle"></a>
					<a href="settings.php"><img src='images/settings.jpg' height=70 width=60 align="right" class="circle"></a>
					<a href="search.php"><img src='images/search.jpg' height=70 width=60 align="right" class="circle"></a>
					<img src='images/line.jpg' height=70 width=10 align="right" class="circle">
					<a href="notification.php"><img src='images/notification.png' height=70 width=60 align="right" class="circle"></a>
					<a href="messages.php"><img src='images/messages.jpg' height=70 width=60 align="right" class="circle"></a>
					<a href="profile.php"><img src='images/profile.jpg' height=70 width=60 align="right" class="circle"></a>
					
			</div>
<?php
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
		$dire="uploads/".$_SESSION['username']."/";
		if (!is_dir($dire)) {
			mkdir($dire);         
		}
         move_uploaded_file($file_tmp,$dire.$file_name);
         echo '<br><br><h3><font color="green">Image Uploaded Successfully</font></h3>';
      }else{
         print_r($errors);
      }
   }
?>

      <div class="gallery">
      <form action="" method="POST" enctype="multipart/form-data">
		<br>
		<br>
		<h3 align="center">Pick the image you want to Upload</h3><br><br>
         <input type="file" name="image" />
         <input type="submit" value="Upload"/>
      </form>
	  </div>
      
   </body>
</html>