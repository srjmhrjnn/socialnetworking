<?php
	session_start();
	if(isset($_SESSION['username']))
	{
		echo "Logged in as :".$_SESSION['username'];
		
	}
	else{echo "Please Login";
	header('location:index.php');
	}
?>
<html>
<head>

	<link rel="stylesheet" type="text/css" href="styles/images.css">
	<title>Images</title>
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
			<div class="gallery cf">
				<?php
					echo "<table>";
					$dir_path="uploads/".$_SESSION['username']."/";
					$extensions_array=array('jpg','png','jpeg');
					if(is_dir($dir_path))
					{
						$files=scandir($dir_path);
						echo '<tr>';
						for($i=0;$i<count($files);$i++)
						{
							
							
							echo '<div class="gallery-item">';
							$file=pathinfo($files[$i]);
							$extension = $file['extension'];
							
							if(in_array($extension,$extensions_array))
							{
								echo '<td>';
								echo "<center><a href=".$dir_path.$files[$i]."><img src='$dir_path$files[$i]' style='width:150px;height:150px;'></a></center><br>";
								echo "<center><a href="."makeprofilepic.php?picpath=".$dir_path.$files[$i].">Make profile Picture</a></center><br>";
								echo '</td>';
							}
							echo '</div>';
							if(($i%6)==0){echo '</tr><tr>';}
						}
						echo '</tr>';
					}
					echo "</table>";

				?>
					<a href="imgpost.php"><h1>Upload a new Photo</h1></a>
				</div>
		</div>
</center>
</body>
</html>