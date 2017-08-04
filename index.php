<!DOCTYPE html>
<?php
	session_start();
	$con=mysqli_connect("localhost","root","","php");

	if(isset($_POST['login'])){
		$passWord =  mysqli_real_escape_string($con,$_POST['passWord']);
		$eMail = mysqli_real_escape_string($con,$_POST['email']);
		
		$sel = "select * from memberRegistry where eMail='$eMail' AND passWord='$passWord'";
		$run = mysqli_query($con,$sel);
		$check = mysqli_num_rows($run);

		$sel_mail = "select * from adminRegister where eMail='$eMail' AND passWord='$passWord'";
		$run_mail = mysqli_query($con,$sel_mail);
		$check_mail = mysqli_num_rows($run_mail);

		if($check == 0){
			if($check_mail == 0){
				echo "<script>alert('Invalid email or password.')</script>";
				echo "<script>window.open('index.php','_self')</script>";
			}else
			goto a;
		}
		else{
			a:
			$_SESSION['eMail'] = $eMail;
			if($check){
				echo "<script>window.open('welcome.php','_self')</script>";
			}
			if($check_mail){
				echo "<script>window.open('adminPage.php','_self')</script>";
			}else
				echo "<script>window.open('index.php','_self')</script>";
		}
	}
?>
<html>
<head>
<title>PILGRADES Solutions</title>
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
a {
	text-decoration: none;
}
</style>
</head>
<body>
<div class="container">
<header align='left'>
	<nav align='right' width=800px>
		<form action="index.php" method="post" enctype="multipart/form-data">
			Email:&nbsp;
			<input type="text" name="email" placeholder="Enter Email">&nbsp;&nbsp;
			Password:&nbsp;
			<input type="password" name="passWord" placeholder="Enter Password">
			&nbsp;&nbsp;
			<input type="submit" name="login" value="Log In"><br><br>
<!-- redirect to password reset page -->			
			<a href="forgotPassword.php" style="color: white">Forgot Password?</a>
			&nbsp;&nbsp;&nbsp;
			Not yet a member?&nbsp;&nbsp; Register <a href="memberRegistry.php" style="color: white">HERE</a>:
		</form>
	</nav>
  <font face="dodge">PILGRADES Solutions Co.</font><br><br>
</header>
<nav align='right' width=800px>
	<form action="mailto:info.pilgrades@gmail.com" method="post" enctype="text/plain">
		<table>
			<tr>
				<td colspan=2 align="left"><h3>Message Us:</h3></td>
			</tr>
		
			<tr>
				<td align="right">Name:</td>
				<td align="left"><input type="text" name="email" size=28px></td>
			</tr>
		
			<tr>
				<td align="right">Email:</td>
				<td align="left"><input type="text" name="email" size=28px></td>
			</tr>
		
			<tr>
				<td>Message:</td>
				<td><textarea name="message" cols=30px rows=15></textarea></td>
			</tr>
		
		</table>
		<br>
		<input type="submit" name="sub" value="Submit" style="float: right">
	
	</form>
</nav>

<article align='center'>
	<img src="logo/pilgrades.jpg" alt="london" style="width:500px;height:480px;">
</article>
<footer align='center'>Copyright &copy; www.pilgrades.com</footer>
</div>
</body>
</html>
