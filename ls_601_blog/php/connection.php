<?php 
	session_start();
	$con = new mysqli('127.0.0.1','root','','ls_601');
	function accnoGenerator(){
		srand();
		$generated="";
		$str = "abcdefghijklmzopqrstuvwxyz1234567890";
		$shuff = str_shuffle($str);
		$generated = $shuff.date('ymd');
		return 'ls_601'.substr($generated,rand(10,10),10);
	}
 ?>