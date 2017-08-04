<?php
	session_start();
	
	$con=mysqli_connect("localhost","root","","php");
		
	$eMail = isset($_POST['user_email']) ? $_POST['user_email'] : '';

	if(isset($_POST['cancel'])){

		header("location: index.php");

	}

	if(isset($_POST['reset'])){
		$eMail = mysqli_real_escape_string($con,$_POST['user_email']);
		$passWord =  mysqli_real_escape_string($con,$_POST['user_password']);
		$confirmPass = mysqli_real_escape_string($con,$_POST['user_conPass']);

		if($eMail=='' OR $passWord=='' OR $confirmPass==''){
			echo "<script>alert('Please fill up all fields.')</script>";
			$eMail = isset($_POST['user_email']) ? $_POST['user_email'] : '';
		}
		if(!filter_var($eMail,FILTER_VALIDATE_EMAIL)){
			echo "<script>alert('Not a valid email. Please try another one.')</script>";
		}
		if(strlen($passWord)<8 OR $passWord!=$confirmPass){
			echo "<script>alert('No set password, password does not match or password does not meet minimum 8-character length')</script>";
		}

		$sel_email = "select * from memberRegistry where eMail='$eMail'";
		$run_email = mysqli_query($con,$sel_email);
		$check_email = mysqli_num_rows($run_email);	

		$sel_email1 = "select * from adminRegister where eMail='$eMail'";
		$run_email1 = mysqli_query($con,$sel_email1);
		$check_email1 = mysqli_num_rows($run_email1);	
		
		if($check_email==1 AND $check_email1==0){
			$row = mysqli_fetch_assoc($run_email);
			$email = $row['eMail'];
			
			$update = "update memberRegistry set passWord='$passWord',confirmPassword='$confirmPass' where eMail='$email'";
			$run_update = mysqli_query($con,$update);

			if($run_update){
				echo "<script>alert('You have successfully updated. Thank you!')</script>";
				echo "<script>window.open('index.php','_self')</script>";
			}
		}

		if($check_email==0 AND $check_email1==1){
			$row = mysqli_fetch_assoc($run_email1);
			$email = $row['eMail'];
			
			$update = "update adminRegister set passWord='$passWord',confirmPassword='$confirmPass' where eMail='$email'";
			$run_update = mysqli_query($con,$update);

			if($run_update){
				echo "<script>alert('You have successfully updated. Thank you!')</script>";
				echo "<script>window.open('index.php','_self')</script>";
			}
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

  	<font face="dodge">PILGRADES Solutions Co.</font><br><br>
		
</header>
  
<nav>
	<h3>Reset your password HERE.</h3><br>

	<form action="forgotPassword.php" method="post" enctype="multipart/form-data">
		<table align="center">
			<tr>
				<td align="right"><strong>Email:</strong></td>
				<td><input type='text' name='user_email' value="<?php echo $eMail; ?>"></td>
			</tr>

			<tr>
				<td align="right"><strong>Password:</strong></td>
				<td><input type='password' name='user_password'></td>
			</tr>
	
			<tr>
				<td align="right"><strong>Confirm Password:</strong></td>
				<td><input type='password' name='user_conPass'></td>
			</tr>
	
    	</table>
		<br>
		<input type='submit' name='reset' value='Reset Password' style="float: right"><br><br>
		<input type='submit' name='cancel' value='Cancel' style="float: right"/>
		<br><br>
	</form>
    
</nav>
<article align='center'>
	<img src="logo/banner.jpg" alt="pilgrades" style="width:720px;height:480px;">
</article>
<footer align='center'>Copyright &copy; www.pilgrades.com</footer>
</div>

</body>
</html>