<?php
    session_start();
    if(!$_SESSION['eMail']){
        header("location: index.php");
    }
    else{
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

</style>
</head>
<body>
    <div class="container">

        <a style="float: left">Welcome &nbsp;&nbsp;<?php echo $_SESSION['eMail']; ?> </a>
        <ul>
            <li><a href="logout.php">Log Out</a></li>
            <li style="border-right: 1px solid gray"><a>View Users</a>
                <ul>
                    <li><a href="adminUser.php">Admin Users</a></li><br>
                    <li><a href="memberUser.php">Member Users</a></li>
                </ul>
            </li>
            <li style="border-right: 1px solid gray"><a>Articles</a>
                <ul>
                    <li><a href="articleUpload.php">Upload</a></li><br>
                    <li><a href="articleView.php">View</a></li>
                </ul>
            </li>
            <li><a href="welcome.php" style="border-right: 1px solid gray">Home</a></li>
        </ul>
    </div>
</body>
</html>
    <?php } ?>