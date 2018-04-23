<?php
	require 'connection.php';
	session_destroy();
	header("Refresh:.5; index.php");
?>