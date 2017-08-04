<?php
	session_start();
	if(!$_SESSION['eMail']){
        header("location: index.php");
    }
    else{
	
	$con=mysqli_connect("localhost","root","","php");

	
	if(isset($_GET['id'])){
		$edit_id = $_GET['id'];

		$sel = "select * from memberRegistry where user_id='$edit_id'";
    	$run = mysqli_query($con,$sel);

    	$row=mysqli_fetch_array($run);
        $first_name = $row['firstName'];
        $family_name = $row['familyName'];
		$user_password = $row['passWord'];
		$user_confirmPassword = $row['confirmPassword'];
		$user_email = $row['eMail'];
		$user_age = $row['aGe'];
        $user_gender = $row['genDer'];
        $user_birthday = $row['birthDay'];
		$regDate = $row['registerDate'];

		$sel_email = "select * from adminRegister where eMail='$user_email'";
		$run_email = mysqli_query($con,$sel_email);
		$check_email = mysqli_num_rows($run_email);

		if($check_email<1){
			$insertInto = "insert into adminRegister (firstName,familyName,passWord,confirmPassword,eMail,aGe,genDer,birthDay,registerDate) values ('$first_name','$family_name','$user_password','$user_confirmPassword','$user_email','$user_age','$user_gender','$user_birthday','$regDate')";
			$run_insertInto = mysqli_query($con,$insertInto);

			$delete = "delete from memberRegistry where user_id='$edit_id'";
            $run_delete = mysqli_query($con,$delete);

			if($run_insertInto){
				echo "<script>alert('You have successfully made member user as ADMIN.')</script>";
				echo "<script>window.open('memberUser.php','_self')</script>";
			}
		}else{
			echo "<script>alert('The member you move is already an ADMIN.')</script>";
			echo "<script>window.open('memberUser.php','_self')</script>";

		}	
	}	
	}
?>