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
?>

<html>
<head>

	<link rel="stylesheet" type="text/css" href="styles/profile.css">
	<title>Profile</title>
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
						<p><h3><?php 
						$s = $_SESSION['username'];
						$stmt = $conn->prepare("SELECT * FROM `account` WHERE `username`='$s'");
						$stmt->execute();
						$reads = $stmt->fetchAll();
						$pic=$reads['0']['ID'];
																		
						if(!empty($reads['0']['profilepic']))
						{
							$imgadd=$reads['0']['profilepic'];
							
							echo '<img src="'.$imgadd.'"  height=200 width=auto align="center">';
							
						}
						else{
							echo '<img src="images/profile.jpg"  height=200 width=auto align="center" class="img-circle">';
						}
						
						echo '<br><br>';
						
						
						$statement = $conn->prepare("SELECT * FROM `account` WHERE `username`='$s'");
						$statement->execute();      
						$rows = $statement->fetchAll();
					
						echo '<h1><font color=#A9A9A9>',$rows['0']['name'],'</font>&nbsp<font color=#A9A9A9>(@',$rows['0']['username'],')</font></h1>';
						?>
						</h3></p>
							<h4 align=left>Details Of User</h4>
						
						<div class="leftcontent">						

							<p><h3><font color="#FF4500">About</font></h3></p>
							<?php 
						$s = $_SESSION['username'];
						
						$statement = $conn->prepare("SELECT * FROM `account` WHERE `username`='$s'");
						$statement->execute();      
						$rows = $statement->fetchAll();
					
						echo "Date of Birth:",$rows['0']['dob'],"<br><br>";
						echo "Gender:",$rows['0']['gender'],"<br><br>";
						$profileid=$rows['0']['ID'];
						?>
						</div>
						<div class="rightcontent">
							
							<p><h3><font color="#FF4500">Overview</font></h3></p>
							<?php
								include 'prcontent.php';
							?>
						</div>
						<div class="friends">
							<?php 
							
							
							
							
							?>
						</div>
						
						<?php
							include 'uprofile.php';
						?>
													
						
											
					</div>
				
			
		</div>
	</center>
</html>