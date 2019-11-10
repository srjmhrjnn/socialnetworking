<?php
	session_start();
	if(isset($_SESSION['username']))
	{
		echo "Logged in as :".$_SESSION['username'];
		
	}
	else{echo "Please Login to continue";
	
	header('location:index.php');
	}
	include('dbconn.php');
	
	if(isset($_POST["Send"]))
{

	$username=$_POST['username'];
	$message_content=$_POST['message_content'];
	$statement = $conn->prepare("SELECT * FROM `account` WHERE `username`='$username'");
	$statement->execute();  
	$rows = $statement->fetchAll();
	$uid1 = $rows['0']['ID'];
	
	$date = new DateTime('now', new DateTimeZone("Asia/Kathmandu"));
	$datetime=$date->format('Y-m-d h:i:s');
	$usrn = $_SESSION['username'];
	$stat1 = $conn->prepare("SELECT * FROM `account` WHERE `username`='$usrn'");
	
	$stat1->execute();  
	$ro = $stat1->fetchAll();
	$uid2 = $ro['0']['ID'];
	
	$sql = "SELECT count(*) FROM `messageslist` WHERE (`userID1`='$uid1' and `userID2`='$uid2') or (`userID1`='$uid2' and `userID2`='$uid1')";	
	$result= $conn->prepare($sql);
	$result->execute();
	$rows=$result->fetchColumn();
	if($rows==1)
	{
		$stat1 = $conn->prepare("SELECT * FROM `messageslist` WHERE (`userID1`='$uid1' and `userID2`='$uid2') or (`userID1`='$uid2' and `userID2`='$uid1')");
		$stat1->execute();  
		$ro = $stat1->fetchAll();
		$mid = $ro['0']['mID'];
		$sql2 = "UPDATE messageslist SET lasttime='$datetime' WHERE mID='$mid'";		
	}
	else
	{
		$sql1 = "INSERT INTO messageslist (userID1,userID2,lasttime) VALUES ('$uid2','$uid1','$datetime')";	
		$result=$conn->exec($sql1);
		$stat3 = $conn->prepare("SELECT * FROM `messageslist` WHERE (`userID1`='$uid1' and `userID2`='$uid2') or (`userID1`='$uid2' and `userID2`='$uid1')");
		$stat3->execute();  
		$ro = $stat3->fetchAll();
		$mid = $ro['0']['mID'];
		
	}
		$sql3 = "INSERT INTO messages (mID,userID,Mcontent,time) VALUES ('$mid','$uid2','$message_content','$datetime')";
		$result1= $conn->exec($sql3);
		if($result1)
		{
			$sql4 = "UPDATE messageslist SET lmessagecontent='$message_content' WHERE mID='$mid'";
			$result2= $conn->exec($sql4);	
			if($result2)
			{
				echo "Message Sent";
			}
		}

}

?>
<html>
<head>

	<link rel="stylesheet" type="text/css" href="styles/messages.css">
	<title>Messages</title>
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
<p>
					<form method="POST">
						<h4>Send message to</h4>
						<input type="text" name="username" placeholder="Enter Username"><br><br>
						<h4>Message content</h4>
						<textarea name="message_content" rows="20" cols="150"></textarea><br><br><br>
						<input type="submit" name="Send" value="Send"><br><br>
					</form>
						</p>
			
		</div>
	</center>
</html>