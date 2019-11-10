<?php
	$id=$_SESSION['username'];
	$userr=$conn->prepare("SELECT `ID` FROM account WHERE username='$id'");
	$userr->execute();
	while ($userid = $userr->fetch(PDO::FETCH_ASSOC))
	
	$uid=$userid['ID'];
	$per_page=6;
	$query="SELECT * FROM friendreq WHERE `ID2`='$uid'";
	$data = $conn->query($query);
	foreach($data as $query_row)
	{	echo '<div class="contents">';
		$IDS=$query_row['ID1'];
		$quer="SELECT `name`,`profilepic` FROM account where ID='$IDS'";
		$quer1=$conn->query($quer);
		foreach($quer1 as $query){
			if($query['profilepic']=="")
			{
			echo '<img src="images/profile.jpg" height=70 width=70><br/>';	
			}
			else{
			echo '<img src="'.$query['profilepic'].'" height=70 width=70><br/>';
			}
			echo $query['name'],' sent you a friend request</p>';
			echo '<a href="viewprofile.php?uid=',$IDS,'">View Profile</a>','&nbsp&nbsp&nbsp&nbsp&nbsp';
			echo '<a href="acceptfriend.php?uid=',$IDS,'">Accept Friend Request</a></p><br/>';	
		}
		echo '</div>';
	}
?>