<?php
	session_start();
	if(!$_SESSION['eMail']){
        header("location: index.php");
    }
	if(isset($_POST['cancel'])){
		header("location: adminUser.php");
	}
    else{
	
	$con=mysqli_connect("localhost","root","","php");

	$firstName = isset($_POST['user_firstName']) ? $_POST['user_firstName'] : '';
	$familyName = isset($_POST['user_familyName']) ? $_POST['user_familyName'] : '';
	$passWord =  isset($_POST['user_password']) ? $_POST['user_password'] : '';
	$confirmPass = isset($_POST['user_conPass']) ? $_POST['user_conPass'] : '';
	$eMail = isset($_POST['user_email']) ? $_POST['user_email'] : '';
	$aGe = isset($_POST['user_age']) ? $_POST['user_age'] : '';
	$birthDay = isset($_POST['user_birthDay']) ? $_POST['user_birthDay'] : '';
	$genDer = isset($_POST['user_gender']) ? $_POST['user_gender'] : '';

	if(isset($_GET['id'])){
		$edit_id = $_GET['id'];

		$sel = "select * from adminRegister where user_id='$edit_id'";
    	$run = mysqli_query($con,$sel);

    	$row=mysqli_fetch_array($run);
        $id = $row['user_id'];
        $firstName = $first_name = $row['firstName'];
        $familyName = $family_name = $row['familyName'];
		$passWord =  $user_password = $row['passWord'];
		$confirmPass = $user_confirmPassword = $row['confirmPassword'];
		$eMail = $user_email = $row['eMail'];
		$aGe = $user_age = $row['aGe'];
        $genDer = $user_gender = $row['genDer'];
        $birthDay = $user_birthday = $row['birthDay'];

	}
?>
<!DOCTYPE html>
<html>
<head>
<title>Edit Member Details</title>
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

<header align='center'>

  	<font face="dodge">PILGRADES Solutions Co.</font><br><br>
			
</header>
  
<nav>
	<h3>Update member details here.</h3><br>

	<form action="editAdminRegistry.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
		<table align="center">
			<tr>
				<td align="right"><strong>First Name:</strong></td>
				<td><input type='text' name='user_firstName' value="<?php echo $firstName;?>"></td>
			</tr>
	
			<tr>
				<td align="right"><strong>Family Name:</strong></td>
				<td><input type='text' name='user_familyName' value="<?php echo $familyName;?>"></td>
			</tr>
	
			<tr>
				<td align="right"><strong>Password:</strong></td>
				<td><input type='password' name='user_password' value="<?php echo $passWord;?>"></td>
			</tr>
	
			<tr>
				<td align="right"><strong>Confirm Password:</strong></td>
				<td><input type='password' name='user_conPass' value="<?php echo $confirmPass;?>"></td>
			</tr>
	
			<tr>
				<td align="right"><strong>Email:</strong></td>
				<td><input type='text' name='user_email' value="<?php echo $eMail;?>"></td>
			</tr>
	
			<tr>
				<td align="right"><strong>Age:</strong></td>
				<td><input type='text' name='user_age' value="<?php echo $aGe;?>"></td>
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
				<td><input type='date' name='user_birthDay' value="<?php echo $birthDay;?>"></td>
			</tr>
    	</table>
		<br>
		<input type='submit' name='upDate' value='UPDATE' style="float: right"><br><br>
		<input type='submit' name='cancel' value='CANCEL' style="float: right"/>
		<br><br>
	</form>
</nav>
<article align='center'>
	<img src="logo/edit.png" alt="edit" style="width:600px;height:480px;">
</article>
<footer align='center'>Copyright &copy; www.pilgrades.com</footer>
</div>

<?php

	if(isset($_POST['upDate'])){
		$firstName = mysqli_real_escape_string($con,$_POST['user_firstName']);
		$familyName = mysqli_real_escape_string($con,$_POST['user_familyName']);
		$passWord =  mysqli_real_escape_string($con,$_POST['user_password']);
		$confirmPass = mysqli_real_escape_string($con,$_POST['user_conPass']);
		$eMail = mysqli_real_escape_string($con,$_POST['user_email']);
		$aGe = mysqli_real_escape_string($con,$_POST['user_age']);
		$birthDay = mysqli_real_escape_string($con,$_POST['user_birthDay']);
		$genDer = mysqli_real_escape_string($con,$_POST['user_gender']);

		$sel_email = "select * from adminRegister where eMail='$eMail'";
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
			$_SESSION['eMail']=$eMail;
			$update = "update adminRegister set firstName='$firstName',familyName='$familyName',passWord='$passWord',confirmPassword='$confirmPass',eMail='$eMail',aGe='$aGe',genDer='$genDer',birthDay='$birthDay' where user_id='$edit_id'";
			$run_update = mysqli_query($con,$update);
			if($run_update){
				echo "<script>alert('You have successfully updated. Thank you!')</script>";
				echo "<script>window.open('adminUser.php','_self')</script>";
			}
		}	
	}
?>
</body>
</html>
	<?php }	?>