<!DOCTYPE html>
<html>
<head>
<title>Registration Here</title>
<style>
div.container {
    width: 100%;
    <!--border: 1px solid gray;-->
}

div.reg{
	align: center;
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
    max-width: 250px;
    margin: 0;
    padding: 1em;
	<!-- text-align: left; -->
	
}

article {
	
	margin: 5px;
	<!-- border-right: 1px solid #28397f; -->
    padding: 1px;
    overflow: hidden;
	
}
</style>
</head>
<body>

<div class="container">

<header align='center'>

  <font>PILGRADES Solutions Co.</font><br><br>
  
</header>
  
<article align='center'>

   <form action="regHere.php" method="post" enctype="multipart/form-data">
	<table align="center">
	<tr>
		<td colspan=2><h2>Register Here:</h2></td>
	</tr>
	<tr>
		<td align="right"><strong>First Name:</strong></td>
		<td><input type='text' name='user_firstName'/></td>
	</tr>
	
	<tr>
		<td align="right"><strong>Family Name:</strong></td>
		<td><input type='text' name='user_familyName'/></td>
	</tr>
	
	<tr>
		<td align="right"><strong>Password:</strong></td>
		<td><input type='password' name='user_password'/></td>
	</tr>
	
	<tr>
		<td align="right"><strong>Confirm Password:</strong></td>
		<td><input type='password' name='user_conPass'/></td>
	</tr>
	
	<tr>
		<td align="right"><strong>Email:</strong></td>
		<td><input type='text' name='user_email'/></td>
	</tr>
	
	<tr>
		<td align="right"><strong>Age:</strong></td>
		<td><input type='text' name='user_age'/></td>
	</tr>
	
	<tr>
		<td align="right"><strong>Gender:</strong></td>
		<td>
		Male<input type="radio" name='user_gender' value="male"/>
		Female<input type="radio" name='user_gender' value="female"/>
		</td>
	</tr>
	
	<tr>
		<td align="right"><strong>Birthday:</strong></td>
		<td><input type='date' name='user_birthDay'/></td>
	</tr>
    </table>
	<br><br>
	<input type='submit' name='subMit' value='Register'/>
	<input type='submit' name='cancel' value='Cancel'/>
	<br><br>
  </form>
</article>

<?php
if(isset($_POST['cancel'])){

	header("location: index.php");

}
?>
<?php



//get value and store in a variable
if(isset($_POST['subMit'])){
	
	$firstName = $_POST['user_firstName'];
	$familyName = $_POST['user_familyName'];
	$passWord = $_POST['user_password'];
	$confirmPass = $_POST['user_conPass'];
	$eMail = $_POST['user_email'];
	$aGe = $_POST['user_age'];
	$birthDay = $_POST['user_birthDay'];
	$genDer = $_POST['user_gender'];
	
	echo $genDer;
}
//check if all fields had been filled

//check if set password and confirmed password is the same
//if($passWord!=$confirmPass){
//		echo "<script>alert('Confirmed password is not the same with set password!')</script>";
	
//	}
	
//check if First Name and Family Name is already registered

//check if email is valid and already registered	
	
?>
<footer align='center'>Copyright &copy; www.pilgrades.com</footer>

</div>


</body>
</html>
