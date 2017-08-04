<?php
	session_start();
	
	$con=mysqli_connect("localhost","root","","php");
		
	$firstName = isset($_POST['user_firstName']) ? $_POST['user_firstName'] : '';
	$familyName = isset($_POST['user_familyName']) ? $_POST['user_familyName'] : '';
	$passWord =  isset($_POST['user_password']) ? $_POST['user_password'] : '';
	$confirmPass = isset($_POST['user_conPass']) ? $_POST['user_conPass'] : '';
	$eMail = isset($_POST['user_email']) ? $_POST['user_email'] : '';
	$aGe = isset($_POST['user_age']) ? $_POST['user_age'] : '';
	$birthDay = isset($_POST['user_birthDay']) ? $_POST['user_birthDay'] : '';
	$genDer = isset($_POST['user_gender']) ? $_POST['user_gender'] : '';

	if(isset($_POST['cancel'])){

		header("location: index.php");

	}
	//log in session if user is already registered
	if(isset($_POST['log_in'])){
		$passWord =  mysqli_real_escape_string($con,$_POST['pass_Word']);
		$eMail = mysqli_real_escape_string($con,$_POST['e_mail']);
		//echo $pass_Word;
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
<nav align='right' width=800px>
    <form action="memberRegistry.php" method="post" enctype="multipart/form-data">
		Email:&nbsp;
		<input type="text" name="e_mail" placeholder="Enter Email">&nbsp;&nbsp;
		Password:&nbsp;
		<input type="password" name="pass_Word" placeholder="Enter Password">
		&nbsp;&nbsp;
		<input type="submit" name="log_in" value="Log In"><br><br>
		<a href="forgotPassword.php" style="text-decoration: none; color: white">Forgot password?</a>
	</form>
</nav>
  	<font face="dodge">PILGRADES Solutions Co.</font><br><br>
		
</header>
  
<nav>
	<h3>Please fill out the form to register.</h3><br>

	<form action="memberRegistry.php" method="post" enctype="multipart/form-data">
		<table align="center">
			<tr>
				<td align="right"><strong>First Name:</strong></td>
				<td><input type='text' name='user_firstName' value="<?php echo $firstName?>"></td>
			</tr>
	
			<tr>
				<td align="right"><strong>Family Name:</strong></td>
				<td><input type='text' name='user_familyName' value="<?php echo $familyName?>"></td>
			</tr>
	
			<tr>
				<td align="right"><strong>Password:</strong></td>
				<td><input type='password' name='user_password' value="<?php echo $passWord?>"></td>
			</tr>
	
			<tr>
				<td align="right"><strong>Confirm Password:</strong></td>
				<td><input type='password' name='user_conPass' value="<?php echo $confirmPass?>"></td>
			</tr>
	
			<tr>
				<td align="right"><strong>Email:</strong></td>
				<td><input type='text' name='user_email' value="<?php echo $eMail?>"></td>
			</tr>
	
			<tr>
				<td align="right"><strong>Age:</strong></td>
				<td><input type='text' name='user_age' value="<?php echo $aGe?>"></td>
			</tr>
	
			<tr>
				<td align="right"><strong>Gender:</strong></td>
				<td>
					Male<input type="radio" name='user_gender' value="male">
					Female<input type="radio" name='user_gender' value="female">
				</td>
			</tr>
	
			<tr>
				<td align="right"><strong>Birthday:</strong></td>
				<td><input type='date' name='user_birthDay' value="<?php echo $birthDay?>"></td>
			</tr>
    	</table>
		<br>
		<input type='submit' name='subMit' value='Register' style="float: right"><br><br>
		<input type='submit' name='cancel' value='Cancel' style="float: right"/>
		<br><br>
	</form>
    
</nav>
<article align='center'>
	<img src="logo/banner.jpg" alt="pilgrades" style="width:720px;height:480px;">
</article>
<footer align='center'>Copyright &copy; www.pilgrades.com</footer>
</div>
<?php
	if(isset($_POST['subMit'])){
		$firstName = mysqli_real_escape_string($con,$_POST['user_firstName']);
		$familyName = mysqli_real_escape_string($con,$_POST['user_familyName']);
		$passWord =  mysqli_real_escape_string($con,$_POST['user_password']);
		$confirmPass = mysqli_real_escape_string($con,$_POST['user_conPass']);
		$eMail = mysqli_real_escape_string($con,$_POST['user_email']);
		$aGe = mysqli_real_escape_string($con,$_POST['user_age']);
		$birthDay = mysqli_real_escape_string($con,$_POST['user_birthDay']);
		$genDer = mysqli_real_escape_string($con,$_POST['user_gender']);

		$sel_email = "select * from memberRegistry where eMail='$eMail'";
		$run_email = mysqli_query($con,$sel_email);
		
		$check_email = mysqli_num_rows($run_email);
		if($passWord=='' OR $confirmPass=='' OR $passWord!=$confirmPass OR strlen($passWord)<8){
			echo "<script>alert('No set password, password does not match or password does not meet minimum 8-character length')</script>";
			$firstName = isset($_POST['user_firstName']) ? $_POST['user_firstName'] : '';
			$familyName = isset($_POST['user_familyName']) ? $_POST['user_familyName'] : '';
			$passWord =  isset($_POST['user_password']) ? $_POST['user_password'] : '';
			$confirmPass = isset($_POST['user_conPass']) ? $_POST['user_conPass'] : '';
			$eMail = isset($_POST['user_email']) ? $_POST['user_email'] : '';
			$aGe = isset($_POST['user_age']) ? $_POST['user_age'] : '';
			$birthDay = isset($_POST['user_birthDay']) ? $_POST['user_birthDay'] : '';
			$genDer = isset($_POST['user_gender']) ? $_POST['user_gender'] : '';
			//header("location: memberRegistry.php");
		}elseif(!filter_var($eMail,FILTER_VALIDATE_EMAIL)){
			echo "<script>alert('Invalid email address.  Please try again.')</script>";
			$firstName = isset($_POST['user_firstName']) ? $_POST['user_firstName'] : '';
			$familyName = isset($_POST['user_familyName']) ? $_POST['user_familyName'] : '';
			$passWord =  isset($_POST['user_password']) ? $_POST['user_password'] : '';
			$confirmPass = isset($_POST['user_conPass']) ? $_POST['user_conPass'] : '';
			$eMail = isset($_POST['user_email']) ? $_POST['user_email'] : '';
			$aGe = isset($_POST['user_age']) ? $_POST['user_age'] : '';
			$birthDay = isset($_POST['user_birthDay']) ? $_POST['user_birthDay'] : '';
			$genDer = isset($_POST['user_gender']) ? $_POST['user_gender'] : '';
		}elseif($check_email>=1){
			echo "<script>alert('Email address you entered already in use. Please try another.')</script>";
			$firstName = isset($_POST['user_firstName']) ? $_POST['user_firstName'] : '';
			$familyName = isset($_POST['user_familyName']) ? $_POST['user_familyName'] : '';
			$passWord =  isset($_POST['user_password']) ? $_POST['user_password'] : '';
			$confirmPass = isset($_POST['user_conPass']) ? $_POST['user_conPass'] : '';
			$eMail = isset($_POST['user_email']) ? $_POST['user_email'] : '';
			$aGe = isset($_POST['user_age']) ? $_POST['user_age'] : '';
			$birthDay = isset($_POST['user_birthDay']) ? $_POST['user_birthDay'] : '';
			$genDer = isset($_POST['user_gender']) ? $_POST['user_gender'] : '';
		}elseif($firstName == '' OR $familyName == '' OR $passWord == '' OR $confirmPass == '' OR $eMail == '' OR $aGe == '' OR $genDer == '' OR $birthDay == ''){
			echo "<script>alert('Please fill all fields.')</script>";
			$firstName = isset($_POST['user_firstName']) ? $_POST['user_firstName'] : '';
			$familyName = isset($_POST['user_familyName']) ? $_POST['user_familyName'] : '';
			$passWord =  isset($_POST['user_password']) ? $_POST['user_password'] : '';
			$confirmPass = isset($_POST['user_conPass']) ? $_POST['user_conPass'] : '';
			$eMail = isset($_POST['user_email']) ? $_POST['user_email'] : '';
			$aGe = isset($_POST['user_age']) ? $_POST['user_age'] : '';
			$birthDay = isset($_POST['user_birthDay']) ? $_POST['user_birthDay'] : '';
			$genDer = isset($_POST['user_gender']) ? $_POST['user_gender'] : '';
		}else{
//			insert code here if you want to send verification email after sucessful registration
			$_SESSION['eMail']=$eMail;
			$insert = "insert into memberRegistry (firstName,familyName,passWord, confirmPassword,eMail,aGe,genDer,birthDay,registerDate) values ('$firstName','$familyName','$passWord','$confirmPass','$eMail','$aGe','$genDer','$birthDay',NOW())";
			$run_insert = mysqli_query($con,$insert);
			if($run_insert){
				echo "<script>alert('You have successfully registered. Thank you!')</script>";
				echo "<script>window.open('welcome.php','_self')</script>";
			}
		}
		
	}
?>
</body>
</html>