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

	<link rel="stylesheet" type="text/css" href="styles/search.css">
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
						<div class="search-container">
							<form method="GET">
							<p>
							  <input type="text" placeholder="Search people you know.." name="search">
							  <button type="submit"><center>Find</center></button>
								<?php
									$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
									$query=$conn->prepare("SELECT `account`.`username`,`account`.`ID`,`account`.`name`,`account`.`profilepic` from `account` WHERE `account`.`username` LIKE :search");
									if(isset($_GET['search'])){
										$search=$_GET['search'];
										//(isset($_GET['search'])===true) ? $_GET['search'] : '';
										$query->bindValue(':search','%'.$search.'%',PDO::PARAM_STR);
											$query->execute();
											$rows=$query->fetchAll(PDO::FETCH_ASSOC);
											foreach($rows as $names){
												$pic=$names['ID'];
												if(!empty($names['profilepic']))
												{
													$imgadd=$names['profilepic'];
													echo '<img src="'.$imgadd.'" height=70 width=70 align="center" class="circle">';
												}
												else{
													echo '<img src="images/profile.jpg" height=70 width=60 align="center" class="circle">';
												}
											echo '<p><font color=green>',$names['name'],'</font>&nbsp<font color=green>(@',$names['username'],')</font><br/><br/>';
											echo '<a href="viewprofile.php?uid=',$pic,'">View Profile</a>','&nbsp&nbsp&nbsp&nbsp&nbsp';
											echo '<a href="addfriend.php?uid=',$pic,'">Send Friend Request</a></p><br/>';
											}
										
										
									}
								?>
							</p>
							</form>
						</div>
					</div>
			
		</div>
	</center>
</html>
