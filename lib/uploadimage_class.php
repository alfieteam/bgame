<?php
	include_once "upload_class.php";

	class UploadImage extends Upload{

		protected static $dir = "img/users";
		protected static $mime_types = array("image/jpeg","image/jpg","image/png","image/gif");
	}


?>