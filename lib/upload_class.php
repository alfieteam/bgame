<?php
		abstract class Upload{

			protected static $dir;
			protected static $mime_type;

			public static function uploadFile($file){
				if(!self::isSecurity($file)) return false;
				$uploadfile = self::dir."/".$file["name"];
				return move_uploaded_file($file["tmp_name"], $uploadfile);

			}

			protected static function isSecurity($file){
				$blacklist = array(".php",".phtml",".php3",".php4",".html",".htm");
				foreach($blacklist as $item){
					if(preg_match("/$item\s/i",$file["name"])) return false;
				}
				$type = $file["type"];
				for($i = 0; $i < count(self::mime_types); $i++){
					if($type == self::mime_types[$i]) break;
					if($i + 1 == count(self::mime_types)) return false;
				}
				$size = $file["size"];
				if($size > 2048000) return false;
				return true;
			}
		}


?>