<?php
    session_start();
    $con = mysqli_connect("localhost","root","","php");
    if(!$_SESSION['eMail']){
        header("location: index.php");
    }
    else {
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
    <form action="articleUpload.php" method="post" enctype="multipart/form-data">
        <table align="left">
            <tr>
                <td><strong>Article Category:&nbsp;&nbsp;</strong></td>
                <td>
                    <select name="artCat">
                        <option>Select a Category</option>
                        <option>Electronics Engineering</option>
                        <option>Information Technology</option>
                        <option>Safety Engineering</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><strong>Article Title:&nbsp;&nbsp;</strong></td>
                <td><textarea name="artTitle" cols=70px rows=2><?php if(isset($_POST['artTitle'])) { echo $_POST['artTitle']; } ?></textarea></td>
            </tr>
            <tr>
                <td><strong>Article Description:&nbsp;&nbsp;</strong></td>
                <td><textarea name="artDesc" cols=70px rows=20><?php if(isset($_POST['artDesc'])) { echo $_POST['artDesc']; } ?></textarea></td>
            </tr>
            <tr>
                <td><strong>Cover Image:&nbsp;&nbsp;</strong></td>
                <td>
                    <input type="hidden" name="MAX_FILE_SIZE" value="25000000">
                    <input type="file" name="artImage">
                </td>
            </tr>
            <tr>
                <td><strong>Article Attachment:&nbsp;&nbsp;</strong></td>
                <td>
                    <input type="hidden" name="MAX_FILE_SIZE" value="50000000">
                    <input type="file" name="artAttach">
                </td>
            </tr>
            <tr align="right">
                <td></td>
                <td>
                    <input type="submit" name="upload" value="UPLOAD">
                    <input type="submit" name="cancel" value="CANCEL">
                </td>
            </tr>
        </table>
    </form>
    <?php
//        $articleCategory = isset($_POST['artCat']) ? $_POST['artCat'] : '';
//		$articleTitle = isset($_POST['artTitle']) ? $_POST['artTitle'] : '';
//		$articleDescription = isset($_POST['artDesc']) ? $_POST['artDesc'] : '';

        if(isset($_POST['cancel'])){

		    header("location: adminPage.php");

	    }
        if(isset($_POST['upload'])){
            //getting text information from table
            $articleCategory = mysqli_real_escape_string($con,$_POST['artCat']);
		    $articleTitle = mysqli_real_escape_string($con,$_POST['artTitle']);
		    $articleDescription =  mysqli_real_escape_string($con,$_POST['artDesc']);
            //getting image information and storing in local and temporary variables
            $coverImage = $_FILES['artImage']['name'];
            $tmpImage = $_FILES['artImage']['tmp_name'];

            $artAttachment = $_FILES['artAttach']['name'];
            $tmpAttach = $_FILES['artAttach']['tmp_name'];

            if($articleCategory=='' OR $articleTitle=='' OR $articleDescription=='' OR $coverImage=='' OR $artAttachment==''){
             echo "<script>alert('Please fill all fields or attach cover image.')</script>";
//			    $articleCategory = isset($_POST['artCat']) ? $_POST['artCat'] : '';
//			    $articleTitle = isset($_POST['artTitle']) ? $_POST['artTitle'] : '';
//			    $articleDescription =  isset($_POST['artDesc']) ? $_POST['artDesc'] : '';
            }
            else {
                if($articleCategory=="Electronics Engineering"){
                    $key = 001;
                }
                if($articleCategory=="Information Technology"){
                    $key = 002;
                }
                if($articleCategory=="Safety Engineering"){
                    $key = 003;
                }
                move_uploaded_file($tmpImage,"image/$coverImage");
                move_uploaded_file($tmpAttach,"attachment/$artAttachment");
                //insert attachment code
                $ins = "insert into article (art_key,art_category,art_title,art_cover,art_description,art_attachment,upload_date) values ('$key','$articleCategory','$articleTitle','$coverImage','$articleDescription','$artAttachment',NOW())";
			    $run_ins = mysqli_query($con,$ins);
			    if($run_ins){
				    echo "<script>alert('You have successfully uploaded. Thank you!')</script>";
				    echo "<script>window.open('articleView.php','_self')</script>";
			    } 
            }
        }
}    ?>
</body>
</html>
