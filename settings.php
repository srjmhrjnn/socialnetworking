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
if(isset($_POST["Update"]))
{
	$name=$_POST['name'];
	$password=$_POST['password'];
	$dob=$_POST['dob'];
	$gender=$_POST['gender'];
	$usrn = $_SESSION['username'];
	$stat1 = $conn->prepare("SELECT * FROM `account` WHERE `username`='$usrn'");
	$stat1->execute();  
	$ro = $stat1->fetchAll();
	$uid = $ro['0']['ID'];
	if($name<>''){
	$sql = "UPDATE account SET name='$name' WHERE ID='$uid'";
	$conn->exec($sql);
	}
	if($password<>''){
	$sql = "UPDATE account SET password='$password' WHERE ID='$uid'";
	$conn->exec($sql);
	}
	if($dob<>''){
	$sql = "UPDATE account SET dob='$dob' WHERE ID='$uid'";
	$conn->exec($sql);
	}

}
?>
	
<html>
<head>

	<link rel="stylesheet" type="text/css" href="styles/settings.css">
	<title>Settings</title>
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


    <div class="loginbox">
	<center>
        <font size=4 color="green"><br><br><br>Please Enter the Fields you want to Update<br><br></font>
        <form method="POST">
			
            <input type="text" name="name" placeholder="Name"><br>
            <input type="password" name="password" placeholder="Password"><br>
			
            <input type="text" name="dob" placeholder="Date of Birth(yyyy-mm-dd)"><br><br><br><br>
			
            <input type="submit" name="Update" value="Update"><br><br>
        </form>
       </center>
    </div>
	</center>
</body>