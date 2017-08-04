<?php
session_start();
    if(!$_SESSION['eMail']){
        header("location: index.php");
    }
    else{
        $con=mysqli_connect("localhost","root","","php");

        $title = $_SESSION['title'];
        $cover = $_SESSION['cover'];
        $description = $_SESSION['desc'];
        $id = $_SESSION['id'];





        if(isset($_GET['download'])){
            $sel = "select * from article where art_id=$id";
            $run = mysqli_query($con,$sel);

            $row=mysqli_fetch_array($run);

            $attach = $row['art_attachment'];

            header('Content-Type: application/octet-stream');
	        header('Content-Disposition: attachment; filename='.$attach);

            echo $attach;

        }

?>
<!DOCTYPE html>
<html>
<head>
<link href="welcome.css" rel="stylesheet" type = "text/css"/>
<title>Welcome Member</title>
<style>
.download {
    position: absolute;
    top: 100px;
    left: 130px;
    border: 2px solid #28397f;
    height: 70px;  
}
.container {
    position: absolute;
    top: 100px;
    left: 350px;
}
h2 {
    color: #28397f;
}
.downLoad {
    height: 70px;
}
</style>
</head>
<body>
    
    <ul>
        <li><a href="welcome.php">Home</a></li>
        <li><a href="logout.php">Log Out</a></li>
    </ul>

    <di class="container">
        <h2>Your download is ready.. Please click DOWNLOAD NOW!!!</h2>
    </div>

    <form class="download" action="download.php?id=<?php echo $id;?>" method="get" enctype="multipart/form-data">
        <input class="downLoad" type="submit" name="download" value="DOWNLOAD NOW!" style="font-weight: bold; font-size: 40px; color: #28397f">
    </form>
    
</body>
</html>
    <?php } ?>