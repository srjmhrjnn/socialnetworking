<?php
	include 'header.php';
	$pic=$_GET['picpath'];
	include 'dbconn.php';
	$usrname=$_SESSION['username'];
	if($pic<>''){
	$sql = "UPDATE account SET profilepic='$pic' WHERE username='$usrname'";
	$conn->exec($sql);
		echo '<br><br><br><center><h1><font color="green">Profile picture updated Successfully</font></h1></center>';
	}
?>
