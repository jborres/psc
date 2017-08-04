<?php
    session_start();
    if(!$_SESSION['eMail']){
        header("location: index.php");
    }
    else{
        $con=mysqli_connect("localhost","root","","php");

        if(isset($_GET['id'])){
            $get_id = $_GET['id'];

            $delete = "delete from article where art_id='$get_id'";
            $run_delete = mysqli_query($con,$delete);

            if(run_delete){
                echo "<script>alert('You have successfully deleted the article. Thank you!')</script>";
				echo "<script>window.open('articleView.php','_self')</script>";
            }
        }
?>
<!DOCTYPE html>
<html>
<link href='welcome.css' rel='stylesheet'>
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
/*    width: 400px;*/
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
            <font face='HELVETICA' style="font-size: 50px;" color="28397f">UPLOADED ARTICLES</font><br><br>
        </header>
        <table align='center'>
            <tr>
                <th>S.N.</th>
                <th>CATEGORY</th>
                <th>TITLE</th>
                <th>COVER IMAGE</th>
                <th>DESCRIPTION</th>
                <th>ATTACHMENT</th>
                <th>EDIT</th>
                <th>DELETE</th>
                <th>PUBLISH</th>
            </tr>
            <?php
                $sel = "select * from article";
                $run = mysqli_query($con,$sel);

                $i = 0;
                while($row=mysqli_fetch_array($run)){
                    $id = $row['art_id'];
                    $art_cat = $row['art_category'];
                    $art_title = $row['art_title'];
                    $art_image = $row['art_cover'];
                    $art_attach = $row['art_attachment'];
                    $art_desc = $row['art_description'];
                    $i++;

                    $imagepath = "../image/";
                    $attachpath = "../attachment/";

            ?>            
                <tr align='center'>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $art_cat; ?></td>
                    <td><?php echo $art_title; ?></td>
<!--                    <td><img src="image/<?php // echo $art_image; ?>" width="50" height="50"/></td> -->
<!--                    <td><?php //echo "<img src='" .$imagepath . $row['art_cover'] . "' width='100' height='100'>"; ?></td> -->
                    <td style="width: 120px"><?php echo "<img src='image/" . $row['art_cover'] . "' width='70' height='70'>"; ?></td>
                    <td style="width: 350px"><?php echo $art_desc; ?></td>
                    <td style="width: 200px"><?php echo $art_attach;?></td>                    
                    <td style="width: 80px"><a href="editArticleUpload.php?id=<?php echo $id;?>"><img src="logo/edit.png" width="30" height="30"></a></td>
                    <td style="width: 80px"><a href="articleView.php?id=<?php echo $id;?>"><img src="logo/delete.png" width="30" height="30"></a></td>
                    <td style="width: 80px"><a href="adminPage.php"><img src="logo/publish.png" width="30" height="30"></a></td>
<!--                <td><a href="adminUser.php" style="text-decoration:none">Edit</a></td>
                <td><a href="adminUser.php" style="text-decoration:none">Delete</a></td>
                <td>Move</td> -->
                </tr>
             <?php   }
             ?>
        </table>
        <h4 align="right"><a href="adminPage.php"><font color="#d41243">BACK</font></a></h4>
    </div>
</body>
</html>
    <?php } ?>