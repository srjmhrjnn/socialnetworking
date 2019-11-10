<?php
	session_start();
	if(isset($_SESSION['username']))
	{
		echo "Logged in as :".$_SESSION['username'];
		
	}
	else{echo "Please Login";
	header('location:index.php');
	}
	include('dbconn.php');
	if(isset($_POST['Post'])){
		
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
				$sql = "INSERT INTO posts (ID,postcontent,time) VALUES ('$uid','$status','$datetime')";	
				$result= $conn->exec($sql);
				if($result)
				{
					echo "Status Posted";
				}
				$conn->commit();
			}
			catch(PDOException $e)
			{
				$conn->rollback();
				echo "Connection failed:",$e->getMessage();
			}
						
	}
?>
<html>
<head>

	<link rel="stylesheet" type="text/css" href="styles/homepagestyle.css">
	<title>Homepage</title>

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

					<div class="content">
					
						<div class="leftcontent">
											
							<div class="leftsubcontent">
							<form action="homepage.php" method="post">
							<p><h1>What's on your mind?</h1></p>
							<textarea name="status_content"></textarea>
								</br>  </br>   
								
								<input type="submit" value="Post" name="Post"/></br>	
								<p align="right"><a href="picpost.php">Post image?</a></p>							
							</form>
							</div>
							
							<?php							
							include 'homeposts.php';
							?>
							
							
							
							
						</div>
						<div class="rightcontent">
						<br>
							<h4><font color="green">Social Networking Site Welcomes you. Browse new contents and feeds. Explore the new amazing world.</font></h4>
							  <img src="images/welcome.jpg" width="300px" height="150px">
							
							
						</div>
					
					</div>
				
			
		</div>
	</center>
</body>
</html>