<form method="post" enctype="multipart/form-data">
	File ZIP : <input type="file" name="file">
	<input type="submit" name="upload">
</form>

<?php
	include "../library/function_unzip.php";

	if(isset($_POST['upload'])){
		unzip_file($_FILES['file']['name'], $_FILES['file']['tmp_name'], "upload/");
	}