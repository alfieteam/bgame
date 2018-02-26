<?php
include_once "lib/uploadimage_class.php";
if(isset($_POST['upload'])){
	$succes_image = UploadImage::uploadFile($_FILES["image"]);
}
if($_POST["upload"]){
	if($succes_image) echo "Изображение успешно загруженно";
	else echo "Ошибка загрузки изображения";
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>upload</title>
</head>
<body>
<form name="myform" action="img.php" method="post" enctype="multipart/form-data">
	
<input type="file" name="image">
<br>
<input type="submit" name="upload" value="Загрузить">

</form>
</body>
</html>