<?php
    session_start();
    $con = mysqli_connect("localhost","root","","php");
    if(!$_SESSION['eMail']){
        header("location: index.php");
    }
    else {
        if(isset($_POST['cancel'])){

		    header("location: articleView.php");

	    }
        if(isset($_GET['id'])){
		    $edit_id = $_GET['id'];
            
		    $sel = "select * from article where art_id='$edit_id'";
    	    $run = mysqli_query($con,$sel);

    	    $row=mysqli_fetch_array($run);
            $id = $row['art_id'];
            $articleCategory = $row['art_category'];
            $articleTitle = $row['art_title'];
		    $articleCover =  $user_password = $row['art_cover'];
		    $articleDescription = $row['art_description'];
            $articleAttachment = $row['art_attachment'];

        }
 
?>
<!DOCTYPE html>
<html>
    <style>
    body {
        background: url('logo/elearn.jpg') no-repeat;
        background-size: cover;
    }
    td {
        color: #d41243;
    }
    select, input {
        padding: 6px;
    }
    </style>
<body>
    <h2 style="color: #d41243"><font face="helvetica">Upload your article here:</font></h2>
    <form action="editArticleUpload.php?id=<?php echo $id;?>" method="post" enctype="multipart/form-data">
        <table align="left">
            <tr>
                <td><strong>Article Category:&nbsp;&nbsp;</strong></td>
                <td>
                    <select name="artCat">
                        <option><?php echo $articleCategory;?></option>
                        <option>Electronics Engineering</option>
                        <option>Information Technology</option>
                        <option>Safety Engineering</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><strong>Article Title:&nbsp;&nbsp;</strong></td>
                <td><textarea name="artTitle" cols=70px rows=2><?php echo $articleTitle; ?></textarea></td>
            </tr>
            <tr>
                <td><strong>Article Description:&nbsp;&nbsp;</strong></td>
                <td><textarea name="artDesc" cols=70px rows=28><?php echo $articleDescription; ?></textarea></td>
            </tr>
            <tr>
                <td><strong>Cover Image:&nbsp;&nbsp;</strong></td>
                <td>
                    <input type="file" name="artImage"><br>
                    &nbsp;&nbsp;<img src="image/<?php echo $articleCover; ?>" width="50" height="50">
                </td>
            </tr>
            <tr>
                <td><strong>Article Attachment:&nbsp;&nbsp;</strong></td>
                <td>
                    <input type="file" name="artAttach"><br>
<!--                code for display of attachment -->
                    &nbsp;&nbsp;<?php echo $articleAttachment; ?>
                </td>
            </tr>
            <tr align="right">
                <td></td>
                <td>
                    <input type="submit" name="upDate" value="UPDATE">
                    <input type="submit" name="cancel" value="CANCEL">
                </td>
            </tr>
        </table>
    </form>
    <?php

        if(isset($_POST['upDate'])){
            //getting text information from table
            $articleCategory = mysqli_real_escape_string($con,$_POST['artCat']);
		    $articleTitle = mysqli_real_escape_string($con,$_POST['artTitle']);
		    $articleDescription =  mysqli_real_escape_string($con,$_POST['artDesc']);
            //getting image information and storing in local and temporary variables
            $coverImage = $_FILES['artImage']['name'];
            $tmpImage = $_FILES['artImage']['tmp_name'];

            $artAttachment = $_FILES['artAttach']['name'];
            $tmpAttach = $_FILES['artAttach']['tmp_name'];

            if($artAttachment!=''){
                move_uploaded_file($tmpAttach,"attachment/$artAttachment");

                if($coverImage!=''){
                    move_uploaded_file($tmpImage,"image/$coverImage");

                    $update = "update article set art_category='$articleCategory',art_title='$articleTitle',art_cover='$coverImage',art_description='$articleDescription',art_attachment='$artAttachment' where art_id='$edit_id'";
			        $run_update = mysqli_query($con,$update);
			        if($run_update){
				        echo "<script>alert('You have successfully updated. Thank you!')</script>";
				        echo "<script>window.open('articleView.php','_self')</script>";
			        }
                }else{
                    $update = "update article set art_category='$articleCategory',art_title='$articleTitle',art_description='$articleDescription',art_attachment='$artAttachment' where art_id='$edit_id'";
			        $run_update = mysqli_query($con,$update);
			        if($run_update){
				        echo "<script>alert('You have successfully updated. Thank you!')</script>";
				        echo "<script>window.open('articleView.php','_self')</script>";
			        }
                }
            }else{
                if($coverImage!=''){
                    move_uploaded_file($tmpImage,"image/$coverImage");

                    $update = "update article set art_category='$articleCategory',art_title='$articleTitle',art_cover='$coverImage',art_description='$articleDescription' where art_id='$edit_id'";
			        $run_update = mysqli_query($con,$update);
			        if($run_update){
				        echo "<script>alert('You have successfully updated. Thank you!')</script>";
				        echo "<script>window.open('articleView.php','_self')</script>";
			        }
                }else{
                    $update = "update article set art_category='$articleCategory',art_title='$articleTitle',art_description='$articleDescription' where art_id='$edit_id'";
			        $run_update = mysqli_query($con,$update);
			        if($run_update){
				        echo "<script>alert('You have successfully updated. Thank you!')</script>";
				        echo "<script>window.open('articleView.php','_self')</script>";
			        }
                }
            } 
        }
}    ?>
</body>
</html>
