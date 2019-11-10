<?php
	include('dbconn.php');
?>
<html>
<head>
<title>Sign Up</title>
	<link rel="stylesheet" type="text/css" href="index.css">
	<script> 
function validate()                                    
{ 
    var name = document.forms["signup"]["Name"]; 
	var username = document.forms["signup"]["username"];    
    var password = document.forms["signup"]["password"];  
    var dob =  document.forms["signup"]["dob"];  
	
	if (name.value == "")                                  
    { 
        window.alert("Please enter your Full Name."); 
        name.focus(); 
        return false; 
    } 
	if (username.value == "")                                  
    { 
        window.alert("Please enter Username."); 
        name.focus(); 
        return false; 
    } 
	if(username.toString().length < 5)
	{
		window.alert("Please enter at least 5 character long username."); 
        name.focus(); 
        return false; 
	}
	if (password.value == "")                                  
    { 
        window.alert("Please enter password."); 
        name.focus(); 
        return false; 
    } 
		if(password.toString().length < 8)
	{
		window.alert("Please enter at least 8 character long password."); 
        name.focus(); 
        return false; 
	}
	if (dob.value == "")                                  
    { 
        window.alert("Please enter your Date Of Birth."); 
        name.focus(); 
        return false; 
    } 

	
}
</script>
</head>
<body>
    <div class="loginbox">
	<center>
    <img src="images/avatar.png" class="avatar">
        <font size=4 color="green">Please Enter the Following Details</font>
        <form name="signup" method="GET" onsubmit="return validate()">
			
            <input type="text" name="Name" placeholder="Full Name">
            
            <input type="text" name="username" placeholder="Username">
            
            <input type="password" name="password" placeholder="Password">
			
            <input type="text" name="dob" placeholder="Date of Birth(yyyy-mm-dd)">
			<p>Gender</p>
			<input type="radio" name="gender" value="male" checked>Male
			<input type="radio" name="gender" value="female">Female<br><br>
            <input type="submit" name="signup" value="Sign Up"><br><br>
            <a href="index.php">Have an account?</a>
        </form>
       </center>
    </div>

</body>

<?php
session_start();
try{
	$conn->beginTransaction();
	
if(isset($_GET["signup"]))
{
	$name=$_GET['Name'];
	$username=$_GET['username'];
	$password=$_GET['password'];
	$dob=$_GET['dob'];
	$gender = $_GET['gender'];
	$sql = "INSERT INTO account (name,username,password,dob,gender) VALUES ('$name','$username','$password','$dob','$gender')";	
	$result= $conn->exec($sql);
	if($result)
	{
		echo "account created";
	}
	else{
			echo '
	<script>
		window.alert("Error! Username might have already been taken.");
	</script>';
	}
	$conn->commit();
	
}
}
catch(PDOException $e)
{
	$conn->rollback();

}
?>
</html>