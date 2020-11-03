
<html>

<form action="#" method="post" enctype="multipart/form-data">
	<input type="file" name="fileToUpload" id="fileToUpload">
	<input type="submit" value="Upload">
</form>
</html>

<?php
$target_dir = "uploads";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'],"$target_dir/test")==false){
		echo "we had an error";
}

?>
