<?php
    session_start();
    if(!$_SESSION['eMail']){
        header("location: index.php");
    }
    else{
        $con=mysqli_connect("localhost","root","","php");

        if(isset($_GET['id'])){
            $get_id = $_GET['id'];

            $delete = "delete from adminRegister where user_id='$get_id'";
            $run_delete = mysqli_query($con,$delete);

            if(run_delete){
                echo "<script>alert('You have delete the user successfully. Thank you!')</script>";
				echo "<script>window.open('adminUser.php','_self')</script>";
            }
        }
?>
<!DOCTYPE html>
<html>
<link href='style.css' rel='stylesheet'>
<head>
<title>Welcome Admin</title>
<style>
div.container {
    width: 100%;
    <!--border: 1px solid gray;-->
}
header {
    padding: 0;
    margin: 0;
    color: white;
    <!-- background-color: #28397f; -->
    clear: left;
    <!-- text-align: center -->
}
font {
	font-weight: bold;
}
nav {
    float: right;
    <!-- max-width: 400px; -->
	margin: 0;
    padding: 1em;
}
article {
    margin-right: 0px;
<!--	border-right: 20px solid #28397f; -->
<!--	border-left: 20px solid #28397f; -->
    padding: 0;
    <!-- overflow: hidden; -->
}
table {
    border: 1px solid #d41243;
    color:  #d41243;
}
th,td {
    border: 1px solid #d41243;
    width: 400px;
    height: 40px;
}
/*td a {
    color: #d41243;
} */
</style>
</head>
<body>
    <div class="container">
        <header align='center'>
            <font face="HELVETICA" style="font-size: 50px;">ADMIN USERS</font><br><br>
        </header>
        <table align='center'>
            <tr>
                <th>S.N.</th>
                <th>FIRST NAME</th>
                <th>FAMILY NAME</th>
                <th>GENDER</th>
                <th>EMAIL ADRESS</th>
                <th>MEMBERSHIP DATE</th>
                <th>EDIT</th>
                <th>DELETE</th>
                <th>MAKE MEMBER</th>
            </tr>
            <?php
                $sel = "select * from adminRegister";
                $run = mysqli_query($con,$sel);

                $i = 0;
                while($row=mysqli_fetch_array($run)){
                    $id = $row['user_id'];
                    $first_name = $row['firstName'];
                    $family_name = $row['familyName'];
                    $user_gender = $row['genDer'];
                    $user_email = $row['eMail'];
                    $reg_date = $row['registerDate'];
                    $i++;
                
            ?>
            <tr align='center'>
                <td><?php echo $i; ?></td>
                <td><?php echo $first_name; ?></td>
                <td><?php echo $family_name; ?></td>
                <td><?php echo $user_gender; ?></td>
                <td><?php echo $user_email; ?></td>
                <td><?php echo $reg_date; ?></td>
                <td><a href="editAdminRegistry.php?id=<?php echo $id;?>"><img src="logo/edit.png" width="30" height="30"></a></td>
                <td><a href="adminUser.php?id=<?php echo $id;?>"><img src="logo/delete.png" width="30" height="30"></a></td>
                <td><a href="makeMember.php?id=<?php echo $id;?>"><img src="logo/move_01.png" width="30" height="30"></a></td>
<!--                <td><a href="adminUser.php" style="text-decoration:none">Edit</a></td>
                <td><a href="adminUser.php" style="text-decoration:none">Delete</a></td> -->
            </tr>
            <?php } ?>
        </table>
        <h4 align="right"><a href="adminPage.php"><font color="#d41243">BACK</font></a></h4>
    </div>
</body>
</html>
    <?php } ?>