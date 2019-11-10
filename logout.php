<?php
	session_start();
	session_destroy();
	include('dbconn.php');
?>
<html>
<head>
<title>Login</title>
     <link rel="stylesheet" type="text/css" href="index.css">
	 <script>function validateForm() {
	var name = document.forms["login"]["username"];
   var password = document.forms["login"]["password"];  
	if (name.value == "")                                  
    { 
        window.alert("Please enter your username."); 
        name.focus(); 
        return false; 
    } 
       if (password.value == "")                        
    { 
        window.alert("Please enter your password"); 
        password.focus(); 
        return flase; 
    } 
}
</script>
</head>
<body>
    <div class="loginbox">
    <center>
	<img src="images/avatar.png" class="avatar">
	<font color="red">PLEASE VISIT US AGAIN!</font>
        <h1>Welcome to <font color='green'>Online Social Networking Site</font></h1>
        <form name="login" method="post" onsubmit="return validateForm()">
         
            <input type="text" name="username" placeholder="Enter Username">
        
            <input type="password" name="password" placeholder="Enter Password"><br><br><br>
            <input type="submit" name="login" value="Login"><br><br>
            <a href="signup.php">Don't have an account?</a>
        </form>
     <center>   
    </div>

</body>
</head>

<?php
session_start();
if(isset($_POST["login"]))
{
	$username=$_POST['username'];
	$password=$_POST['password'];
	$sql = "SELECT count(*) FROM `account` WHERE `username`='$username' and `password`='$password'";	
	$result= $conn->prepare($sql);
	$result->execute();
	$rows=$result->fetchColumn();
	
	if($rows==1)
	{
		$_SESSION['username']=$username;
		header('Location:homepage.php');
	}
	else{
		echo '<script>
			window.alert("Login Username or Password is incorrect!");
		</script>';
	}
}
?>
</html>