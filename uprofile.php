<?php
	$conn=mysqli_connect('localhost','root','');
	mysqli_select_db($conn,'socialdb');
	$id=$_SESSION['username'];

	$userr=mysqli_query($conn,"SELECT `ID` FROM account WHERE username='$id'");
	
	$userid=mysqli_fetch_assoc($userr);
	$uid=$userid['ID'];
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
				echo '<div class="image-cropper">';
				echo '<img src="'.$quer_row['profilepic'].'" height=70 width=70>';
				echo '</div>';
			}
			echo '<p><font color=green>',$quer_row['name'],'</font>&nbsp<font color=green>(@',$quer_row['username'],')</font></p>';
		}
		else{
			echo '<img src="images\\profile.jpg" height=70 width=70>';
			echo '<p>','<font color=red>unknown user</font><font color=red>(@unknown username)</font></p>';
		}
		echo '<p>',$query_row['postcontent'],'</p>';
		echo '<p>',$query_row['time'],'</p>';
		echo '</div>';
	}
?>