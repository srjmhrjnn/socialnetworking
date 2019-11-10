<?php
	
	$id=$_SESSION['username'];

	$userr=$conn->prepare("SELECT `ID` FROM account WHERE username='$id'");
	$userr->execute();
	while ($userid = $userr->fetch(PDO::FETCH_ASSOC))
	
	$uid=$userid['ID'];
	$per_page=6;
	$query="SELECT * FROM messageslist WHERE (`userID1`='$uid' OR `userID2`='$uid') ORDER BY `lasttime` DESC";
	$data = $conn->query($query);
	foreach($data as $query_row)
	{
		{	
			echo '<div class="content"><div class="leftcontent">';
			if($uid==$query_row['userID1'])
			{
				$posterid=$query_row['userID2'];
			}
			else{
				$posterid=$query_row['userID1'];	
			}
			$quer=$conn->prepare("SELECT `name`,`username`,`profilepic` FROM account where ID='$posterid'");
			$quer->execute();
			if($quer_row=($quer->fetch(PDO::FETCH_ASSOC))){
				echo '<br/>Message to/from:<br/>';
			if($quer_row['profilepic']==""){
				echo '<img src="images\\profile.jpg" height=70 width=70>';
			}
			else{
			echo '<img src="'.$quer_row['profilepic'].'" height=70 width=70>';
			}
			echo '<p><font color=green>',$quer_row['name'],'</font>&nbsp<font color=green>(@',$quer_row['username'],')</font></p>';
			}
			else{
				echo '<br/>Message to/from:<br/><br/>';
				echo '<img src="images\\profile.jpg" height=70 width=70><br/>';
				echo 'unknown user';
			}
			echo '</div><div class="rightcontent">';
		
		
			echo '<p>',$query_row['lmessagecontent'],'</p>';
			echo '<p>',$query_row['lasttime'],'</p>';
			echo '<a href="messageall.php?mid=',$query_row['mID'],'">View all messages with ',$quer_row['name'],'</a>';
			echo '</div></div>';
		}
	}
?>			