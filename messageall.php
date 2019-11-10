<?php
	session_start();
	if(isset($_SESSION['username']))
	{
		echo "Logged in as :".$_SESSION['username'];
		
	}
	else{
		echo "Please Login to continue";
		header('location:index.php');
	}
	include('dbconn.php');
	if(isset($_POST['Reply']))
	{
		$mid=$_GET['mid'];
		$message_content=$_POST['message_content'];
		$date = new DateTime('now', new DateTimeZone("Asia/Kathmandu"));
		$datetime=$date->format('Y-m-d h:i:s');
		$usrn = $_SESSION['username'];
		$stat1 = $conn->prepare("SELECT * FROM `account` WHERE `username`='$usrn'");
		
		$stat1->execute();  
		$ro = $stat1->fetchAll();
		$uid2 = $ro['0']['ID'];
		$sql3 = "INSERT INTO messages (mID,userID,Mcontent,time) VALUES ('$mid','$uid2','$message_content','$datetime')";
		$result1= $conn->exec($sql3);
		if($result1)
		{
			$sql4 = "UPDATE messageslist SET lmessagecontent='$message_content' WHERE mID='$mid'";
			$result2= $conn->exec($sql4);	
			if($result2)
			{
				echo "Reply Sent";
			}
		}
	}

?>
<html>
<head>

	<link rel="stylesheet" type="text/css" href="styles/messageall.css">
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
				<?php
					$id = $_SESSION['username'];

						$userr=$conn->prepare("SELECT `ID` FROM account WHERE username='$id'");
						$userr->execute();
						while ($userid = $userr->fetch(PDO::FETCH_ASSOC))
						
						$uid=$userid['ID'];
						$per_page=6;
						
						$rid=$_GET['mid'];
						
						$query="SELECT * FROM messages WHERE mID='$rid' ORDER BY `time` ASC";
						$data = $conn->query($query);
						foreach($data as $query_row)
						{
							{	
								echo '<div class="content"><div class="leftcontent">';
								$pid=$query_row['userID'];
								
								$quer=$conn->prepare("SELECT `name`,`username`,`profilepic` FROM account where ID='$pid'");
								
								$quer->execute();
								if($quer_row=($quer->fetch(PDO::FETCH_ASSOC))){
									
									if($quer_row['profilepic']==""){echo '<img src="images\\profile.jpg" height=70 width=70>';
									}
									else{
									echo '<img src="'.$quer_row['profilepic'].'" height=70 width=70>';
									}
									echo '<p><font color=green>',$quer_row['name'],'</font>&nbsp<font color=green>(@',$quer_row['username'],')</font></p>';}
								else{
									echo '<img src="images\\profile.jpg" height=70 width=70><br/>';
									echo 'unknown user';
								}
								echo '</div><div class="rightcontent">';
								echo '<p>',$query_row['Mcontent'],'</p>';
								echo '<p>',$query_row['time'],'</p>';
								echo '</div></div>';
							}
						}
				?>
				<form method=post>
					<textarea name="message_content" rows=10 cols=175></textarea>
					<br/>  <br/>   
					<input type="submit" value="Reply" name="Reply"></input>
				</form>
		</div>
	</center>
</html>