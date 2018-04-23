<?php 
	if(isset($_SESSION['blog_name'])){
		$create_dir = $_SESSION['blog_name'];
		if(!file_exists($create_dir)){
			$dir = createDir($create_dir);
			if($dir == true){
				$myfile = fopen($create_dir.'/index.php', "w");
				$myAjax = fopen($create_dir.'/viewcomments.php',"w");
				$ajaxContent = file_get_contents('dircreate_ajax.php');
				$content = file_get_contents('dircreate.php');
				fwrite($myfile, $content);
				fclose($myfile);
				fwrite($myAjax, $ajaxContent);
				fclose($myAjax);
			}
			else{
				echo "FALSE";
			}
		}
	}
	else{
		header("Location:page.404.php");
	}
	function createDir($dir){
		$create = mkdir($dir);
		if($create == true){
			return true;
		}
		else{
			return false;
		}
	}
 ?>