<?php
session_start();
    if(!$_SESSION['eMail']){
        header("location: index.php");
    }
    else{
        $con=mysqli_connect("localhost","root","","php");

?>
<!DOCTYPE html>
<html>
<head>
<link href="welcome.css" rel="stylesheet" type = "text/css"/>
<title>Welcome Member</title>
<style>
/*body {
    background: url('logo/ecommerce.jpg') no-repeat center center fixed;
    background-size: cover;
    font-family: Helvetica;
    color: white;
}
div.container {
    width: 100%;
    <!--border: 1px solid gray;-->
}
a {
    font-size: 14px;
}
ul {
    margin: 0;
    padding: 0;
    list-style-type: none;
}
ul li {
    float: left;
    width: 70px;
    height: 15px;
    opacity: 0.8;
    text-align: center;
}
ul li a {
    text-decoration: none;
    display: block;
    color: #28397f;
}
ul li a:hover {
    background-color: #110bc1;
    color: white;
}
ul li ul li {
    display: none;
}
ul li:hover ul li {
    display: block;
    height: 18px;
    width: 150px;
    text-align: left;
}
ul li:hover ul li a {
    color: white;
}*/
.container {
    position: relative;
    top: 70px;
    left: 250px;
    height: 400px;
    width: 800px;
    color: #28397f;
    
}
img {
    position: relative;
    left:10px;
    top: -15px;
}
p {
    position: relative;
    left: 10px;
    top: -15px;
}
h2 {
    position: relative;
    left: -271px;
}

</style>
</head>
<body>
    
    <ul>
        <li><a href="welcome.php">Home</a></li>
        <li><a>Articles</a>
            <ul>
                <li><a href="#">Electronics Engineering</a></li>
                <li><a href="#">Information Technology</a></li>
                <li><a href="#">Safety Engineering</a></li>
            </ul>
        </li>
        <li><a href="#contact">Contact</a></li>
        <li><a href="logout.php">Log Out</a></li>
    </ul>
    
    <div class="container">
        <?php
            if(isset($_GET['id'])){
            $get_id = $_GET['id'];

            $sel = "select * from article where art_id='$get_id'";
    	    $run = mysqli_query($con,$sel);
            $row=mysqli_fetch_array($run);

            $title = $row['art_title'];
            $cover = $row['art_cover'];
            $description = $row['art_description'];
        ?>

        <h2><?php echo $title; ?></h2>
        <?php echo "<img src='image/" . $row['art_cover'] . "' width='200' height='220'>"; ?>
        <p align="justify"><?php echo $description; ?></p>

        <?php
            }
        ?>
    </div>

</body>
</html>
    <?php } ?>