<?php
	function mysqli_result($res,$row=0,$col=0){ 
    $numrows = mysqli_num_rows($res); 
    if ($numrows && $row <= ($numrows-1) && $row >=0){
        mysqli_data_seek($res,$row);
        $resrow = (is_numeric($col)) ? mysqli_fetch_row($res) : mysqli_fetch_assoc($res);
        if (isset($resrow[$col])){
            return $resrow[$col];
        }
    }
    return false;
}
	$conn=mysqli_connect('localhost','root','');
	mysqli_select_db($conn,'socialdb');
	$per_page=6;
	
	$pages_query=mysqli_query($conn,"SELECT COUNT(`postcontent`)FROM `posts`");
	$pages=ceil(mysqli_result($pages_query)/$per_page);
	
	$page=(isset($_GET['page'])) ? (int)$_GET['page'] : 1;
	$start=($page -1)* $per_page;
	
	$query=mysqli_query($conn,"SELECT `ID`,`postcontent`,`time`,`picadd` FROM posts ORDER BY `time` DESC LIMIT $start,$per_page");
	while($query_row=mysqli_fetch_assoc($query)){
		echo '<div class="leftposts">';
		$posterid=$query_row['ID'];
		$quer=mysqli_query($conn,"SELECT `name`,`username`,`profilepic` FROM account where ID='$posterid'");
		if($quer_row=mysqli_fetch_assoc($quer)){
			if($quer_row['profilepic']==""){echo '<img src="images\\profile.jpg" height=70 width=70>';
			}
			else{
			echo '<img src="'.$quer_row['profilepic'].'" height=70 width=70>';
			}
			echo '<p><font color=green>',$quer_row['name'],'</font>&nbsp<font color=green>(@',$quer_row['username'],')</font></p>';
		}
		else{
			echo '<img src="images\\profile.jpg" height=70 width=70>';
			echo '<p>','<font color=red>unknown user</font><font color=green>(@unknown username)</font></p>';
		}
		if($query_row['picadd']!=""){
		echo '<p>','<img src="';
		echo $query_row['picadd'];
		echo '" height=500 width=auto></p>';
		}
		echo '<p>',$query_row['postcontent'],'</p>';
		echo '<p>Posted on:',$query_row['time'],'</p>';
		echo '</div>';
		
		
		}
		echo '</br></br></br></br>Pages: ';
		if($pages>=1 && $page <= $pages){
			for($x=1;$x<=$pages;$x++){
				echo ($x==$page) ? '<strong><a href="?page='.$x.'">'.$x.'</a></strong> ' : '<a href="?page='.$x.'">'.$x.'</a> ';
			}
			
			echo '</br></br></br></br>';
	}
?>