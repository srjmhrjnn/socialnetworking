<?php
	$id=$_SESSION['username'];
	$userr=$conn->prepare("SELECT `ID` FROM account WHERE username='$id'");
	$userr->execute();
	while ($userid = $userr->fetch(PDO::FETCH_ASSOC))
	$uid=$userid['ID'];

	$query="SELECT * FROM `friends` WHERE (ID1='$uid' OR ID2='$uid')";
	$data = $conn->query($query);
	$x=0;
	foreach($data as $query_row)
	{
		$x=$x+1;
	}
	echo '<a href="friendlist.php">View Friends (',$x,')</a><br><br>';
	echo '<a href="images.php">View Photos</a><br><br>';
?>