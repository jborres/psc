<?php
session_start();
    if(!$_SESSION['eMail']){
        header("location: index.php");
    }
    else{
        $con=mysqli_connect("localhost","root","","php");

        if(isset($_POST['go'])){
            $artCategory = mysqli_real_escape_string($con,$_POST['myArticle']);

            if($artCategory=='-----'){
                echo "<script>alert('Please select article')</script>";
                header("location: welcome.php");
            }
            else {
            if($artCategory=="Electronics Engineering"){
                $key = 001;
            }
            if($artCategory=="Information Technology"){
                $key = 002;
            }
            if($artCategory=="Safety Engineering"){
                $key = 003;
            }

            $_SESSION['artKey'] = $key;
            $_SESSION['artCategory'] = $artCategory;
            
            header("location: article.php");
            }
        }

?>
<!DOCTYPE html>
<html>
<head>
<link href="welcome.css" rel="stylesheet" type = "text/css"/>
<title>Welcome </title>
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
ul li a {
    position: relative;
    top: -20px;
}
.container {
    position: relative;
    top: 70px;
    left: 245px;
    height: 400px;
    width: 855px;
    color: #28397f;   
    text-align: center; 
}
p {
    position: relative;
    top: 20px;    
    text-indent: 50px;
    text-align: justify;
}
h1 {
    position: relative;
    left: -60px;
}
.Article {
    position: relative;
    top: -20px;
    right: 15px;
    float: right;  
    color: #28397f;
    font-size: 14px;  
}

</style>
</head>
<body>
    
    <ul>
        <li><a href="welcome.php">Home</a></li>
<!--        <li><a href="#editProfile">Edit Profile</a></li>
        <li><a href="#contact">Contact</a></li> -->
        <li><a href="logout.php">Log Out</a></li>
    </ul>
    <form class="Article" action="welcome.php" method="post" enctype="multipart/form-data">
        Select Article:&nbsp;
        <select name="myArticle">
            <option>-----</option>
            <option>Electronics Engineering</option>
            <option>Information Technology</option>
            <option>Safety Engineering</option>
        </select>
        <input type="submit" name="go" value="GO" style="font-weight: bold;">
    </form>
    <div class="container">
        <font style="font-size: 20px"><h1>PILGRADES Solutions Co.</h1></font>
         <p>
            THIS IS A TEST SAMPLE ONLY...
        </p>
        <p>
            The company aims to provides ebooks in a variety of categories like Electronics Engineering, Information Technology and Safety Engineering.
            &nbsp;Ebooks contains principles, theories, best practices and project compilations to name a few.
            &nbsp;
        </p>
        <p>
            The company aims to provides ebooks in a variety of categories like Electronics Engineering, Information Technology and Safety Engineering.
            &nbsp;Ebooks contains principles, theories, best practices and project compilations to name a few.
            &nbsp;
        </p>
        <p>
            The company aims to provides ebooks in a variety of categories like Electronics Engineering, Information Technology and Safety Engineering.
            &nbsp;Ebooks contains principles, theories, best practices and project compilations to name a few.
            &nbsp;
        </p>
        <p>
            THIS IS A TEST SAMPLE ONLY...
        </p>

    </div>

</body>
</html>
    <?php } ?>