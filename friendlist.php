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
						$statement = $conn->prepare("SELECT `profilepicture`.`profilepic` FROM `profilepicture` WHERE `ID`='$pic'");
						$statement->execute();      
						$row = $statement->fetchAll(PDO::FETCH_ASSOC);
												
						
						?>
						</h3></p>
													
						<?php
							$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
											$uid=$pic;
											
											$query2=$conn->prepare("SELECT `ID1`,`ID2` from `friends` WHERE `ID1`=$uid OR `ID2`=$uid");
											$query2->execute();
											$rows3=$query2->fetchAll(PDO::FETCH_ASSOC);
											echo '<div class="friends">';
												echo '<br><br><h2 align=center><font color="purple">Your Friend\'s List</font></h2>';
											echo '</div>';
											foreach($rows3 as $names5)
											{
												echo '<div class="friends">';
												if($uid==$names5['ID1']){
													$pick=$names5['ID2'];
												}
												else{
													$pick=$names5['ID1'];
												}
											
												$statement = $conn->prepare("SELECT `account`.`profilepic` FROM `account` WHERE `ID`='$pick'");
												$statement->execute();      
												$row = $statement->fetchAll(PDO::FETCH_ASSOC);
												
												if(!empty($row['0']['profilepic']))
												{
													$imgadd=$row['0']['profilepic'];
													echo '<img src="'.$imgadd.'" height=70 width=70 align="center" class="circle">';
												}
												else{
													echo '<img src="images/profile.jpg" height=70 width=60 align="center" class="circle">';
												}
												$query1=$conn->prepare("SELECT * from `account` WHERE `ID`=$pick");
												$query1->execute();
												$rows1=$query1->fetchAll(PDO::FETCH_ASSOC);
												foreach($rows1 as $name)
												echo '<p><font color=green>',$name['name'],'</font>&nbsp<font color=green>(@',$name['username'],')</font><br/><br/>';
												echo '<a href="viewprofile.php?uid=',$pick,'">View Profile</a>','<br/><br/><br/>';
												echo '</div>';
											}
						?>
													
						
											
					</div>
				
			
		</div>
	</center>
</html>