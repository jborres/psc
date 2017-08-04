<?php
	session_start();
	$con=mysqli_connect("localhost","root","","php");

	if(isset($_POST['login'])){
		$passWord =  mysqli_real_escape_string($con,$_POST['passWord']);
		$eMail = mysqli_real_escape_string($con,$_POST['email']);
		
		$sel = "select * from memberRegistry where eMail='$eMail' AND passWord='$passWord'";
		$run = mysqli_query($con,$sel);
		$check = mysqli_num_rows($run);
		if($check == 0){
			echo "<script>alert('Invalid email or password.')</script>";
			echo "<script>window.open('index.php','_self')</script>";
		}
		else{
			$_SESSION['eMail'] = $eMail;
			echo "<script>window.open('welcome.php','_self')</script>";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>Member Registration</title>
<style>
div.container {
    width: 100%;
    <!--border: 1px solid gray;-->
}
header, footer {
    padding: 1em;
    color: white;
    background-color: #28397f;
    clear: left;
    <!-- text-align: center -->
}
font {
	font-size:50px;
	font-weight: bold;
	type: verdana;
}
nav {
    float: right;
    <!-- max-width: 400px; -->
	margin: 0;
    padding: 1em;
}
article {
    margin-right: 350px;
	border-right: 10px solid #28397f;
	padding: 0;
    <!-- overflow: hidden; -->
}
</style>
</head>
<body>

<div class="container">

<header align='left'>
<nav align='right' width=800px>
    <form action="memRegister.php" method="post" enctype="multipart/form-data">
		Email:
		<input type="text" name="email" placeholder="Enter Email">
		Password:
		<input type="password" name="passWord" placeholder="Enter Password">
		
		<input type="submit" name="login" value="Log In"><br><br>
		Forgot password?
	</form>
	
</nav>
  	<font face="dodge">PILGRADES Solutions Co.</font><br><br>
		
</header>
  
<article align='center'>
	<img src="logo/banner.jpg" alt="london" style="width:720px;height:480px;">
</article>
<footer align='center'>Copyright &copy; www.pilgrades.com</footer>
</div>
</body>
</html>