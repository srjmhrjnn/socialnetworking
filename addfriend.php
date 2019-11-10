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
	<title>Search</title>
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
						$usname1=$_SESSION['username'];
						$statement1 = $conn->prepare("SELECT * FROM `account` WHERE `username`='$usname1'");
						$statement1->execute();  
						$rows1 = $statement1->fetchAll();
						$usid1 = $rows1['0']['ID'];
						$pic=$_GET['uid'];
						if($pic<>''){
							$sql = "INSERT INTO friendreq (ID1,ID2) VALUES ('$usid1','$pic')";
							$conn->exec($sql);
						
						echo '<h3><font color="green">Friend request sent</font></h3>';
						}
						$statement = $conn->prepare("SELECT `profilepicture`.`profilepic` FROM `profilepicture` WHERE `ID`='$pic'");
						$statement->execute();      
						$row = $statement->fetchAll(PDO::FETCH_ASSOC);
												
						if(!empty($row['profilepic']))
						{
							$imgadd=$row['profilepic'];
							echo '<img src="$imgadd"  height=200 width=auto align="center" class="circle">';
						}
						else{
							echo '<img src="images/profile.jpg"  height=200 width=auto align="center" class="circle">';
						}
						
						echo '<br><br>';
						
						
						$statement = $conn->prepare("SELECT * FROM `account` WHERE `id`='$pic'");
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
								echo "View Friends<br><br>";
								echo "View Photos","<br><br>";
							?>
						</div>
						<div class="friends">
							<?php 
							
							
							
							
							?>
						</div>											
					</div>
			</div>
		</div>
	</center>
</html>
