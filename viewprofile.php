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
						$pic=$_GET['uid'];
						$statement = $conn->prepare("SELECT `profilepic` FROM `account` WHERE `ID`='$pic'");
						$statement->execute();      
						$row = $statement->fetchAll(PDO::FETCH_ASSOC);	
						if($row['0']['profilepic']!="")
						{
							$imgadd=$row['0']['profilepic'];
							echo '<img src="'.$imgadd.'" height=200 width="auto" align="center" class="circle">';
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
						
						<?php
							$conn=mysqli_connect('localhost','root','');
							mysqli_select_db($conn,'socialdb');
							
							$uid=$_GET['uid'];
							$per_page=6;
							$query=mysqli_query($conn,"SELECT `ID`,`postcontent`,`time` FROM posts WHERE `ID`='$uid' ORDER BY `time` DESC");
							while($query_row=mysqli_fetch_assoc($query)){
								echo '<div class="posts">';
								$posterid=$query_row['ID'];
								$quer=mysqli_query($conn,"SELECT `name`,`username`,`profilepic` FROM account where ID='$posterid'");
								if($quer_row=mysqli_fetch_assoc($quer)){
									if($quer_row['profilepic']==""){echo '<img src="images\\profile.jpg" height=70 width=70>';
									}
									else{
									echo '<img src="'.$quer_row['profilepic'].'" height=70 width=70>';
									}
									echo '<p><font color=green>',$quer_row['name'],'</font>&nbsp<font color=green>(@',$quer_row['username'],')</font></p>';}
								else{
									echo '<img src="images\\profile.jpg" height=70 width=70>';
									echo '<p>','<font color=red>unknown user</font><font color=red>(@unknown username)</font></p>';
								}
								echo '<p>',$query_row['postcontent'],'</p>';
								echo '<p>',$query_row['time'],'</p>';
								echo '</div>';
	}
						?>
													
						
											
					</div>
			</div>
		</div>
	</center>
</html>
