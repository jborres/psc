<?php
session_start();
    if(!$_SESSION['eMail']){
        header("location: index.php");
    }
    else{
        $con=mysqli_connect("localhost","root","","php");
        
        $key = $_SESSION['artKey'];
        $artCategory = $_SESSION['artCategory'];

?>
<!DOCTYPE html>
<html>
<head>
<link href="welcome.css" rel="stylesheet" type = "text/css"/>
<title>Welcome Member</title>
<style>

.Article {
    position: relative;
    right: 15px;
    float: right;  
    color: #28397f;
    font-size: 14px;  
}
table {
    position: relative;
    top: 80px;
    left: 70px;
    border: 1px solid #d41243;
    color:  #d41243;
}
th,td {
    border: 1px solid #d41243;
/*    width: 400px;*/
    height: 40px;
}
font {
    font-size: 40px;
}

</style>
</head>
<body>
    
    <ul>
        <li><a href="welcome.php">Home</a></li>
        <li><a href="logout.php">Log Out</a></li>
    </ul>
    <form class="Article" action="welcome.php" method="post" enctype="multipart/form-data">
        Select Article:&nbsp;
        <select name="myArticle">
            <option><?php echo $artCategory; ?></option>
            <option>Electronics Engineering</option>
            <option>Information Technology</option>
            <option>Safety Engineering</option>
        </select>
        <input type="submit" name="go" value="GO" style="font-weight: bold;">
    </form>
    <table align='center'>
        <tr>
            <th colspan="3"><font>Available e-Books</font></th>

        </tr>
        <tr>
            <th width="80px">S.N.</th>
            <th width="600px">TITLE</th>
            <th width="120px">DOWNLOAD</th>
        </tr>
        <?php
            $sel = "select * from article where art_key=$key";
            $run = mysqli_query($con,$sel);

            $i = 0;

            while($row=mysqli_fetch_array($run)){
                $id = $row['art_id'];
                $art_title = $row['art_title'];
                $_SESSION['title'] = $art_title;
                $_SESSION['cover'] = $row['art_cover'];
                $_SESSION['desc'] = $row['art_description'];
                $_SESSION['id'] = $id;
                $i++;
        ?>
         <tr>
            <td align='center'><?php echo $i; ?></td>
            <td align='left'><?php echo $art_title; ?></td>
            <td align='center'><a href="download.php?id=<?php echo $id; ?>"><img src="logo/download.png" width="30" height="30"></a></td>  
        </tr> 
        <?php } ?>

</body>
</html>
    <?php } ?>